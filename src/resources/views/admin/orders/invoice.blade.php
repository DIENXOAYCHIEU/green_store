@extends('admin.home.homepage')
@section('title', 'Hóa đơn #' . $order->id)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/orders.css') }}">
@endpush

@section('content')
<div style="max-width: 850px; margin: 0 auto;">
    <div class="no-print">
        <a href="{{ url()->previous() }}" class="btn-export">
            <i class="fa-solid fa-arrow-left"></i> Quay lại
        </a>
        <button onclick="window.print()" class="btn-add">
            <i class="fa-solid fa-print"></i> In hóa đơn (PDF)
        </button>
    </div>

    <div class="user-detail-card" style="padding: 40px; background: #fff; border: 1px solid #eee;">
        <div style="display: flex; justify-content: space-between; border-bottom: 2px solid var(--primary-color); padding-bottom: 20px; margin-bottom: 30px;">
            <div>
                <h1 style="color: var(--primary-color); margin-bottom: 5px;"><i class="fa-solid fa-leaf"></i> GREEN LIFE STORE</h1>
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

<style>
@media print {
    /* Ẩn các thành phần không cần thiết khi in */
    .sidebar, .header, .no-print, .nav-tabs, .footer { display: none !important; }
    
    /* Reset layout để chiếm toàn bộ trang in */
    .main-content { margin-left: 0 !important; padding: 0 !important; width: 100% !important; }
    body { background: #fff !important; }
    
    /* Đảm bảo bảng hiển thị đẹp khi in */
    .user-detail-card { box-shadow: none !important; border: none !important; width: 100% !important; padding: 0 !important; }
    
    /* Tránh ngắt trang giữa hóa đơn */
    .user-detail-card { page-break-inside: avoid; }
}
</style>
@endsection