@vite('resources/css/app.css')
<x-layout>

<div class="bg-gray-100 min-h-screen py-6">
    <div class="max-w-[1200px] mx-auto flex gap-6">
        <x-account-sidebar />
        <div class="flex-1">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="no-print mb-4">
                    <a href="{{ route('user.purchase.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 mr-4">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Quay lại
                    </a>
                    <button onclick="window.print()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        <i class="fa-solid fa-print mr-1"></i> In hóa đơn (PDF)
                    </button>
                </div>

                <div class="invoice-content" style="padding: 40px; background: #fff; border: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; border-bottom: 2px solid #22c55e; padding-bottom: 20px; margin-bottom: 30px;">
                        <div>
                            <h1 style="color: #22c55e; margin-bottom: 5px;"><i class="fa-solid fa-leaf"></i> GREEN LIFE STORE</h1>
                            <p style="font-size: 0.9rem; color: #666;">Địa chỉ: 123 Đường ABC, Quận X, TP. Hồ Chí Minh</p>
                            <p style="font-size: 0.9rem; color: #666;">Hotline: 0123.456.789 - Website: greenlifestore.vn</p>
                        </div>
                        <div style="text-align: right;">
                            <h2 style="margin: 0; color: #333;">HÓA ĐƠN BÁN HÀNG</h2>
                            <p style="margin: 5px 0;">Mã đơn: <strong>#{{ $order->id }}</strong></p>
                            <p style="margin: 0; color: #666;">Ngày lập: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 30px; line-height: 1.6;">
                        <div style="width: 60%;">
                            <h4 style="border-bottom: 1px solid #eee; padding-bottom: 5px; margin-bottom: 10px;">THÔNG TIN KHÁCH HÀNG</h4>
                            <p>Khách hàng: <strong>{{ $order->receivers->fullname }}</strong></p>
                            <p>Điện thoại: {{ $order->receivers->phone }}</p>
                            <p>Địa chỉ: {{ $order->receivers->full_address }}, {{ $order->receivers->ward }}, {{ $order->receivers->district }}, {{ $order->receivers->province }}</p>
                        </div>
                        <div style="width: 35%; text-align: right;">
                            <h4 style="border-bottom: 1px solid #eee; padding-bottom: 5px; margin-bottom: 10px;">GHI CHÚ</h4>
                            <p style="font-style: italic;">{{ $order->note ?? 'Không có ghi chú' }}</p>
                        </div>
                    </div>

                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 2px solid #eee;">
                                <th style="padding: 12px; text-align: left;">Sản phẩm</th>
                                <th style="padding: 12px; text-align: center;">Số lượng</th>
                                <th style="padding: 12px; text-align: right;">Đơn giá</th>
                                <th style="padding: 12px; text-align: right;">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $detail)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 12px;">{{ $detail->products->name ?? 'Sản phẩm không tồn tại' }}</td>
                                <td style="padding: 12px; text-align: center;">{{ $detail->quantity }}</td>
                                <td style="padding: 12px; text-align: right;">{{ number_format($detail->total_price / $detail->quantity) }}đ</td>
                                <td style="padding: 12px; text-align: right;">{{ number_format($detail->total_price) }}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div style="display: flex; justify-content: flex-end;">
                        <div style="width: 300px;">
                            <div style="display: flex; justify-content: space-between; padding: 5px 0;">
                                <span>Tạm tính (giá gốc):</span>
                                <span>{{ number_format($order->price) }}đ</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 5px 0; color: #e03131;">
                                <span>Giảm giá:</span>
                                <span>-{{ number_format($order->price - $order->total_price) }}đ</span>
                            </div>
                            <hr>
                            <div style="display: flex; justify-content: space-between; padding: 10px 0; font-weight: bold; font-size: 1.2rem;">
                                <span>TỔNG CỘNG:</span>
                                <span style="color: #e03131;">{{ number_format($order->total_price) }} VNĐ</span>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 50px; display: flex; justify-content: space-between; text-align: center;">
                        <div style="width: 200px;">
                            <p><strong>Người lập hóa đơn</strong></p>
                            <p style="font-size: 0.8rem; color: #999;">(Ký và ghi rõ họ tên)</p>
                        </div>
                    </div>

                    <div style="margin-top: 60px; text-align: center; color: #999; font-size: 0.85rem; border-top: 1px solid #eee; padding-top: 20px;">
                        <p>Cảm ơn quý khách đã tin tưởng lựa chọn sản phẩm xanh tại Green Life Store!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print { display: none !important; }
    .invoice-content { box-shadow: none !important; border: none !important; }
}
</style>

</x-layout>