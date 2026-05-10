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
        $query = Order::with(['accounts', 'statuses', 'receivers', 'bills']);

        // 1. Xử lý tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                ->orWhereHas('receivers', function($sq) use ($search) {
                    $sq->where('fullname', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                });
            });
        }

        // 2. Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status_id', $request->status);
        }

        // 3. Lọc theo ngày đặt
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        $statuses = Status::all();

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show($id)
    {
        $order = Order::with(['receivers', 'orderDetails.products', 'statuses', 'bills'])->findOrFail($id);
        return view('admin.orders.show', compact('order')); // Trả về trang chi tiết
    }

    public function invoice($id)
    {
        $order = Order::with(['receivers', 'bills'])->findOrFail($id);
        return view('admin.orders.invoice', compact('order')); // Trả về trang hóa đơn
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status_id = $request->status_id;
        $order->save();

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Nếu bạn muốn xóa vĩnh viễn (Force Delete) hoặc xóa mềm (Soft Delete) tùy vào Model
        $order->delete(); 

        return back()->with('success', 'Đã xóa đơn hàng thành công!');
    }

    // hàm xử lý tự động hủy đơn hàng quá hạn (chưa thanh toán/ thanh toán thất bại sau 24h)
    public function cleanupExpiredOrders()
    {
        $expiryTime = now()->subHours(24); // Quy định 24 giờ

        // Giả sử ID trạng thái 'Chờ xác nhận' là 1 và 'Đã hủy' là 5
        $expiredOrders = Order::where('status_id', 1)
            ->where('created_at', '<', $expiryTime)
            ->whereDoesntHave('bills') // Chỉ hủy những đơn chưa có hóa đơn (thanh toán thất bại/chưa thanh toán)
            ->get();

        foreach ($expiredOrders as $order) {
            $order->update(['status_id' => 5]);
            // Có thể thêm log hoặc gửi mail thông báo cho khách tại đây
        }

        return "Đã hủy " . $expiredOrders->count() . " đơn hàng quá hạn.";
    }
}