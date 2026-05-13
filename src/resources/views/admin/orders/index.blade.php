@extends('admin.home.homepage')
@section('title', 'Quản lý đơn hàng -')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/orders.css') }}">
@endpush

@section('content')
<div class="order-management">
    <div class="page-header">
        <h2 class="page-title">Quản lý danh sách đơn hàng</h2>
    </div>

    <div class="filter-card" style="margin-bottom: 20px; background: #fff; padding: 20px; border-radius: 15px;">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="filter-form" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
            <div class="search-group">
                <label><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Mã đơn, tên khách, SĐT..." class="form-control">
            </div>

            <div class="select-group">
                <label><i class="fa-solid fa-filter"></i> Trạng thái đơn</label>
                <select name="status" class="form-control">
                    <option value="">-- Tất cả --</option>
                    @foreach($statuses as $st)
                        <option value="{{ $st->id }}" {{ request('status') == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="date-group">
                <label><i class="fa-solid fa-calendar-days"></i> Ngày đặt</label>
                <input type="date" name="date" value="{{ request('date') }}" class="form-control">
            </div>

            <div class="button-group">
                <button type="submit" class="btn-filter">
                    <i class="fa-solid fa-magnifying-glass"></i> Lọc
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn-reset">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </a>
            </div>
        </form>
    </div>

    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Mã Đơn</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái đơn</th>
                    <th>Ngày đặt</th>
                    <th>Thanh toán</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>
                        <p>{{ $order->receivers->fullname ?? 'N/A' }}</p>
                        <small>{{ $order->receivers->phone ?? '' }}</small>
                    </td>
                    <td class="text-bold">{{ number_format($order->total_price) }}đ</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf @method('PATCH')

                            <select
                                name="status_id"
                                onchange="this.form.submit()"
                                style="
                                        padding: 5px 10px;
                                        border-radius: 6px;
                                        color: white;
                                        font-size: 0.85rem;
                                        font-weight: bold;
                                        background: {{
                                            $order->status_id == 3 || $order->status_id == 7 ? '#da1919' :
                                            ($order->status_id == 6 ? '#36ca29' : '#2c2c2c')
                                        }};
                                    "
                                {{ $order->status_id == 6 || $order->status_id == 3 || $order->status_id == 5 || $order->status_id == 7 ? 'disabled' : '' }}
                            >
                                @foreach($statuses as $st)
                                    @if(!in_array($st->id, [3,5,7]) || in_array($order->status_id, [3,5,7]))
                                        <option value="{{ $st->id }}"
                                            {{ $order->status_id == $st->id ? 'selected' : '' }}>
                                            {{ $st->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if($order->payment_method === 'cod')
                            <small>Thanh toán khi nhận</small>
                        @elseif($order->payment_method === 'vnpay' && $order->bills->count() > 0)
                            <small>Đã thanh toán</small>
                        @else
                            <small>Chưa thanh toán</small>
                        @endif
                    </td>
                    <td class="actions">
                        <div class="action-buttons">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-action view" title="Xem chi tiết">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                            
                            {{-- Chỉ hiện nút hóa đơn nếu đây là đơn VNPay đã thanh toán --}}
                            @if($order->payment_method === 'vnpay' && $order->bills->count() > 0)
                            <a href="{{ route('admin.orders.invoice', $order->id) }}" class="btn-action invoice" title="Xem hóa đơn">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </a>
                            @endif

                            {{-- Nút xóa đơn hàng --}}
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action delete" title="Xóa đơn">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px;">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection