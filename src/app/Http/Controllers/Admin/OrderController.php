<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; 
use App\Models\Status;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Cập nhật tên quan hệ khớp với Model (accounts, statuses, receivers, bills, promotions)
        $query = Order::with(['accounts', 'statuses', 'receivers', 'bills', 'promotions']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('id', 'like', "%$search%")
                ->orWhereHas('receivers', function($q) use ($search) { // Đổi thành receivers
                    $q->where('fullname', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                });
        }

        if ($request->filled('status')) {
            $query->where('status_id', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        $statuses = Status::all();

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show($id)
    {
        // Nạp tất cả quan hệ cần thiết cho cả Detail và Bill
        // Cần khớp chính xác tên hàm đã định nghĩa trong Model Order
        $order = Order::with([
            'receivers', 
            'orderDetails.products', // Chú ý: products là quan hệ trong Model OrderDetail
            'statuses', 
            'bills',
            'promotions'
        ])->findOrFail($id);

        return response()->json($order);
    }
    public function destroy($id) {
        Order::findOrFail($id)->delete();
        return back()->with('success', 'Đã hủy đơn hàng thành công!');
    }
}