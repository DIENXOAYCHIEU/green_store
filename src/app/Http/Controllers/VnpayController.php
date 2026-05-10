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
        if ($order->status_id == 4) {
            return redirect()->route('user.cart')->with('success', 'Đơn hàng đã được thanh toán');
        }

        $paymentUrl = $this->vnpayService->createPaymentUrl($order);
        return redirect($paymentUrl);
    }

    public function return(Request $request){
        $isValid = $this->vnpayService->verify($request->all());
        $orderId = $request->vnp_TxnRef;
        $order = Order::findOrFail($orderId);

        if(!$isValid) {
            $order->delete();
            return redirect()->route('user.cart')->with('error', 'Đã xảy ra lỗi trong quá trình thanh toán. Vui lòng thử lại.');
        }

        if($request->vnp_ResponseCode == "00")
            return redirect()->route('user.cart')->with('success', 'Thanh toán thành công!');
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

        $orderId = $request->vnp_TxnRef;
        $order = Order::findOrFail($orderId);

        $bill = Bill::where('order_id', $orderId)->first();
        if($request->vnp_ResponseCode == "00"){
            if (!$bill) {
                // Create bill record
                Bill::create([
                    'order_id' => $order->id,
                    'method' => 'vnpay',
                    'bank_code' => $request->vnp_BankCode,
                    'transaction_no' => $request->vnp_TransactionNo,
                    'amount' => $request->vnp_Amount / 100,
                    'paid_at' => now(),
                ]);
            }

            // Update order status
            $order->update(['status_id' => 4]); // Paid

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