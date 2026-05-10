@vite('resources/css/app.css')
<x-layout>

<div class="bg-gray-100 min-h-screen py-6">
    <div class="max-w-[1200px] mx-auto flex gap-6">
        <x-account-sidebar />
        <div class="flex-1">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="page-header mb-6">
                    <h2 class="text-2xl font-bold"><i class="fa-solid fa-circle-info mr-2"></i> Chi tiết đơn hàng #{{ $order->id }}</h2>
                    <a href="{{ route('user.purchase') }}" class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-arrow-left mr-1"></i> Quay lại</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-lg font-semibold mb-3"><i class="fa-solid fa-user mr-2"></i> Thông tin người nhận</h4>
                        <div class="space-y-2">
                            <div><label class="font-medium">Họ tên:</label> <span>{{ $order->receivers->fullname }}</span></div>
                            <div><label class="font-medium">Số điện thoại:</label> <span>{{ $order->receivers->phone }}</span></div>
                            <div>
                                <label class="font-medium">Địa chỉ:</label>
                                <span>{{ $order->receivers->full_address }}, {{ $order->receivers->ward }}, {{ $order->receivers->district }}, {{ $order->receivers->province }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-lg font-semibold mb-3"><i class="fa-solid fa-truck mr-2"></i> Ghi chú & Trạng thái</h4>

                        <div class="mb-3">
                            <label class="font-medium">Ghi chú:</label>
                            <div class="mt-1 p-2 bg-white rounded border">{{ $order->note ?? "Không có ghi chú từ khách hàng" }}</div>
                        </div>

                        <div class="space-y-2">
                            <p><span class="font-medium">Trạng thái đơn:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($order->statuses->name == 'Đã giao')
                                        bg-green-100 text-green-800
                                    @elseif($order->statuses->name == 'Đang xử lý')
                                        bg-yellow-100 text-yellow-800
                                    @elseif($order->statuses->name == 'Đã hủy')
                                        bg-red-100 text-red-800
                                    @else
                                        bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $order->statuses->name }}
                                </span>
                            </p>

                            <p><span class="font-medium">Ngày đặt hàng:</span> <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong></p>

                            <p>
                                <span class="font-medium">Thanh toán:</span>
                                @if($order->bills->count() > 0)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800"><i class="fa-solid fa-check-circle mr-1"></i> Đã thanh toán</span>
                                    <a href="{{ route('user.purchase.invoice', $order->id) }}" class="text-green-600 hover:text-green-800 ml-2">
                                        <i class="fa-solid fa-file-invoice-dollar mr-1"></i> Xem hóa đơn
                                    </a>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800"><i class="fa-solid fa-circle-xmark mr-1"></i> Chưa thanh toán</span>
                                @endif
                            </p>

                            <p><span class="font-medium">Phương thức:</span> {{ $order->payment_method ?? 'Thanh toán Online' }}</p>
                        </div>
                    </div>
                </div>

                <h4 class="text-lg font-semibold mb-3">Danh sách sản phẩm</h4>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Sản phẩm</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Số lượng</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Đơn giá</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($order->orderDetails as $detail)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 text-sm text-gray-900 border border-gray-300">{{ $detail->products->name ?? 'Sản phẩm đã xóa' }}</td>
                                <td class="px-4 py-4 text-sm text-gray-900 border border-gray-300">{{ $detail->quantity }}</td>
                                <td class="px-4 py-4 text-sm text-gray-900 border border-gray-300">{{ number_format($detail->total_price / $detail->quantity) }}đ</td>
                                <td class="px-4 py-4 text-sm font-bold text-gray-900 border border-gray-300">{{ number_format($detail->total_price) }}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50">
                                <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-900 border border-gray-300"><strong>Tổng cộng:</strong></td>
                                <td class="px-4 py-3 text-sm font-bold text-red-600 border border-gray-300">{{ number_format($order->total_price) }}đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout>