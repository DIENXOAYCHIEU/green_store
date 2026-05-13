<?php

namespace App\Services;

use App\Models\VnpayPaymentRequest;

class VnpayService{

    public function createPaymentUrl($order){
        $vnp_Url = config('vnpay.url');
        $vnp_TmnCode = config('vnpay.tmn_code');
        $vnp_HashSecret = config('vnpay.hash_secret');
        $returnUrl = config('vnpay.return_url');

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $order->total_price * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Thanh toan don hang #" . $order->id,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $returnUrl,
            "vnp_TxnRef" => $order->id,
        ];

        ksort($inputData);

        $query = "";
        $hashData = "";

        foreach ($inputData as $key => $value){
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $hashData = ltrim($hashData, '&');
        $vnpSecureHash = hash_hmac(
            'sha512',
            $hashData,
            $vnp_HashSecret
        );
        $paymentUrl = $vnp_Url . "?" . $query .
            'vnp_SecureHash=' . $vnpSecureHash;
        return $paymentUrl;
    }

    public function verify(array $inputData){
        $vnp_HashSecret = config('vnpay.hash_secret');
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        unset($inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= '&' . urlencode($key) . '=' . urlencode($value);
        }
        $hashData = ltrim($hashData, '&');

        $secureHash = hash_hmac(
            'sha512',
            $hashData,
            $vnp_HashSecret
        );

        return hash_equals($secureHash, $vnp_SecureHash);
    }

    public function storePaymentRequest(array $data)
    {
        return VnpayPaymentRequest::firstOrCreate(
            [
                'vnp_txn_ref' => $data['vnp_TxnRef'],
                'vnp_response_code' => $data['vnp_ResponseCode'],
            ],
            [
                'order_id' => $data['vnp_TxnRef'],
                'vnp_amount' => $data['vnp_Amount'],
                'vnp_bank_code' => $data['vnp_BankCode'] ?? null,
                'vnp_transaction_no' => $data['vnp_TransactionNo'] ?? null,
                'vnp_data' => $data,
                'processed' => false,
            ]
        );
    }

    public function finalizePayment(VnpayPaymentRequest $paymentRequest)
    {
        if ($paymentRequest->processed) {
            return;
        }

        $order = $paymentRequest->order;

        if ($paymentRequest->vnp_response_code == "24") 
            $order->update(['status_id' => 3]);
        else if ($paymentRequest->vnp_response_code != "00") 
            $order->update(['status_id' => 7]);

        if ($paymentRequest->vnp_response_code == "00") {
            if (!$order->bills()->where('transaction_no', $paymentRequest->vnp_transaction_no)->exists()) {
                $order->bills()->create([
                    'method' => 'vnpay',
                    'bank_code' => $paymentRequest->vnp_bank_code,
                    'transaction_no' => $paymentRequest->vnp_transaction_no,
                    'amount' => $paymentRequest->vnp_amount / 100,
                    'paid_at' => now(),
                ]);
            }
            $order->update(['status_id' => 4]);
        }

        $paymentRequest->update(['processed' => true]);
    }
}