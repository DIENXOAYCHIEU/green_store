<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Status;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $search = $request->search;
        $size = $request->size;

        $orders = $this->getOrdersQuery($size, $status, $search);

        return view('user.purchase.index', [
            'orders' => $orders,
            'statuses' => Status::all(),
            'selected_status' => $status
        ]);
    }

    private function getOrdersQuery($size=5, $selected_status_option_id, $search)
    {
        $orders = Order::query();

        $orders = $this->getOrdersQueryByStatusId($selected_status_option_id, $orders);

        $orders = $orders->with('orderDetails.products');

        if (!empty($search)) {

            $orders->where(function ($query) use ($search) {

                $query->where('id', 'like', "%$search%")

                    ->orWhereHas('orderDetails.products', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });

            });
        }

        return $orders->latest()->paginate($size);
    }

    private function getOrdersQueryByStatusId($selected_status_option_id, $orders)
    {
        $orders->where('account_id', auth()->id());

        if (!empty($selected_status_option_id)) {
            $orders->where('status_id', $selected_status_option_id);
        }

        return $orders;
    }

    public function ordersApi(Request $request)
    {
        $size = $request->size ?? 5;      
        $query = Order::query()
            ->where('account_id', auth()->id());

        $query = $query->with(['orderDetails.products', 'statuses']);

        if ($request->status) {
            $query->where('status_id', $request->status);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {

                $q->where('id', 'like', '%' . $request->search . '%')
                    ->orWhereHas('orderDetails.products', function ($q2) use ($request) {
                        $q2->where('name', 'like', '%' . $request->search . '%');
                    });

            });
        }

        $orders = $query->latest()->paginate($size);
        return response()->json($orders);
    }
}
