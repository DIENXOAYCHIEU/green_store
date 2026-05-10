@extends('admin.home.homepage')
@section('title', 'Chi tiết đơn hàng #' . $order->id)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/orders.css') }}">
@endpush

@section('content')
<div class="page-container">
    <div class="page-header">
        <h2><i class="fa-solid fa-circle-info"></i> Chi tiết đơn hàng #{{ $order->id }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn-export" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
    </div>

    <div class="user-details-grid">
        <div class="detail-section">
            <h4><i class="fa-solid fa-user"></i> Thông tin người nhận</h4>
            <div class="detail-grid">
                <div class="detail-item"><label>Họ tên:</label> <span>{{ $order->receivers->fullname }}</span></div>
                <div class="detail-item"><label>Số điện thoại:</label> <span>{{ $order->receivers->phone }}</span></div>
                <div class="detail-item">
                    <label>Địa chỉ:</label> 
                    <span>{{ $order->receivers->full_address }}, {{ $order->receivers->ward }}, {{ $order->receivers->district }}, {{ $order->receivers->province }}</span>
                </div>
            </div>
        </div>

        <div class="detail-section order-status-card">
            <h4><i class="fa-solid fa-truck"></i> Ghi chú & Trạng thái</h4>
            
            <div class="info-group">
                <label>Ghi chú:</label>
                <div class="note-box">{{ $order->note ?? "Không có ghi chú từ khách hàng" }}</div>
            </div>

            <div class="status-info-list">
                <p><span>Trạng thái đơn:</span> <strong class="badge-status">{{ $order->statuses->name }}</strong></p>
                
                <p><span>Ngày đặt hàng:</span> <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong></p>
                
                <p class="payment-status-row">
                    <span>Thanh toán:</span>
                    @if($order->bills->count() > 0)
                        <span class="status-badge status-paid"><i class="fa-solid fa-check-circle"></i> Đã thanh toán</span>
                        <a href="{{ route('admin.orders.invoice', $order->id) }}" class="btn-invoice-link">
                            <i class="fa-solid fa-file-invoice-dollar"></i> Xem hóa đơn
                        </a>
                    @else
                        <span class="status-badge status-unpaid"><i class="fa-solid fa-circle-xmark"></i> Chưa thanh toán</span>
                    @endif
                </p>

                <p>
                    <span>Phương thức:</span> {{ $order->payment_method ?? 'Thanh toán Online' }}
                </p>
            </div>
        </div>
    </div>

    <h4 style="margin: 20px 0 10px 0;">Danh sách sản phẩm</h4>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
            <tr>
                <td>{{ $detail->products->name ?? 'Sản phẩm đã xóa' }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->total_price / $detail->quantity) }}đ</td>
                <td class="text-bold">{{ number_format($detail->total_price) }}đ</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background: #f8fafc;">
                <td colspan="4" style="text-align: right; padding: 15px;"><strong>Tổng cộng:</strong></td>
                <td class="text-red" style="font-size: 1.2rem;">{{ number_format($order->total_price) }}đ</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection