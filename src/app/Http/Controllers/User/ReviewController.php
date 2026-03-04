<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Bill;
use App\Models\Order;
use App\Models\OrderDetail;

class ReviewController{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $content = $request->input('review');
        $product_id = $request->input('product_id');
        $account_id = Auth::id();

        $hasBill = Bill::whereHas('orders.orderDetails',
            function ($query) use ($product_id, $account_id){
                $query->where('product_id', $product_id)
                    ->whereHas('orders',
                        function ($q) use ($account_id){
                            $q->where('account_id', $account_id);
                        }
                );
            }
        )->exists();

        if ($hasBill){
            Review::create([
                'content'=>$content,
                'account_id' => $account_id,
                'product_id' => $product_id,
            ]);
            return back()
                    ->with('success', 'Đánh giá đã được gửi');
        }
        return back()->with('error', 'Bạn chưa mua sản phẩm này, không thể đánh giá');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
