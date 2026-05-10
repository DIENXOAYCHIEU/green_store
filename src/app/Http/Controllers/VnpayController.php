<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Bill;
use App\Services\VnpayService;

use Illuminate\Http\Request;

class VnpayController extends Controller{

    protected $vnpayService;

    public function __construct(VnpayService $vnpayService){

        $this->vnpayService = $vnpayService;
    }

    public function payment($orderId){
        $order = Order::findOrFail($orderId);

        Bill::create([
            'order_id' => $order->id,
            'method' => 'vnpay',
            'bank_code' => $request->vnp_BankCode,
            'transaction_no' => $request->vnp_TransactionNo,
            'amount' => $request->vnp_Amount / 100,
            'paid_at' => now(),
        ]);

        $paymentUrl = $this->vnpayService->createPaymentUrl($order);
        return redirect($paymentUrl);
    }

    public function return(Request $request){
        $isValid = $this->vnpayService->verify($request->all());

        if(!$isValid)
            return "Invalid signature";

        if($request->vnp_ResponseCode == "00")
            return "Thanh toán thành công";

        return "Thanh toán thất bại";
    }

    public function ipn(Request $request){
        $isValid = $this->vnpayService->verify($request->all());

        if(!$isValid){
            return response()->json([
                'RspCode' => '97',
                'Message' => 'Invalid signature'

            ]);
        }

        $orderId = $request->vnp_TxnRef;
        $payment = Bill::where(
            'order_id',
            $orderId
        )->first();

        if(!$payment){
            return response()->json([
                'RspCode' => '01',
                'Message' => 'Payment not found'
            ]);
        }

        if($request->vnp_ResponseCode == "00"){
            $payment->update([
                'status' => 'paid',
                'transaction_no' =>
                    $request->vnp_TransactionNo,

                'response_code' =>
                    $request->vnp_ResponseCode,

                'raw_data' =>
                    json_encode($request->all())

            ]);

            $payment->order->update([
                'status_id' => 2
            ]);
        }

        return response()->json([
            'RspCode' => '00',
            'Message' => 'Confirm Success'
        ]);
    }
}