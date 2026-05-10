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

    public function payment(Request $request, $orderId){
        $order = Order::findOrFail($orderId);

        // Check if order belongs to authenticated user
        if ($order->account_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Check if order is already paid
        if ($order->bills()->exists()) {
            return redirect()->route('user.purchase')->with('success', 'Đơn hàng đã được thanh toán');
        }

        $paymentUrl = $this->vnpayService->createPaymentUrl($order);
        return redirect($paymentUrl);
    }

    public function return(Request $request){
        $isValid = $this->vnpayService->verify($request->all());
        $orderId = $request->vnp_TxnRef;
        $order = Order::findOrFail($orderId);

        if(!$isValid) {
            return redirect()->route('user.cart')->with('error', 'Đã xảy ra lỗi trong quá trình thanh toán. Vui lòng thử lại.');
        }

        if($request->vnp_ResponseCode == "00" && !empty($request->vnp_TransactionNo) && $request->vnp_Amount == $order->total_price * 100) {
            $paymentRequest = $this->vnpayService->storePaymentRequest($request->all());
            $this->vnpayService->finalizePayment($paymentRequest);
            session()->forget('cart');
            return redirect()->route('user.purchase', ['clear_cart' => 1])->with('success', 'Thanh toán thành công! Đơn hàng đang được xử lý.');
        }

        return redirect()->route('user.cart')->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
    }

    public function ipn(Request $request){
        $isValid = $this->vnpayService->verify($request->all());

        if(!$isValid){
            return response()->json([
                'RspCode' => '97',
                'Message' => 'Invalid signature'
            ]);
        }

        // Store the payment request
        $paymentRequest = $this->vnpayService->storePaymentRequest($request->all());

        // Finalize the payment
        $this->vnpayService->finalizePayment($paymentRequest);

        if($request->vnp_ResponseCode == "00"){
            return response()->json([
                'RspCode' => '00',
                'Message' => 'Confirm Success'
            ]);
        }

        return response()->json([
            'RspCode' => '01',
            'Message' => 'Payment failed'
        ]);
    }
}