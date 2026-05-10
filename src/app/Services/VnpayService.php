<?php

namespace App\Services;

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
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac(
            'sha512',
            $hashData,
            $vnp_HashSecret
        );

        return $secureHash === $vnp_SecureHash;
    }
}