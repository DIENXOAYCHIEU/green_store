<!-- resources/views/admin/dashboard/dashboard.blade.php -->
@extends('admin.home.homepage')

@section('title', 'Dashboard')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/styleadmin.css') }}">
@endpush
<div class="page-container">
    <div class="page-header">
        <h2 class="page-title">Báo cáo & Dashboard</h2>
    </div>

    <div class="dashboard-filter">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="filter-form">
            <div class="filter-row">
                <div class="filter-item">
                    <label>Từ ngày</label>
                    <input type="date" name="from" value="{{ $from ?? '' }}">
                </div>
                <div class="filter-item">
                    <label>Đến ngày</label>
                    <input type="date" name="to" value="{{ $to ?? '' }}">
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn-add">Áp dụng</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn-export">Đặt lại</a>
                </div>
            </div>
        </form>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>{{ number_format($totalOrders) }}</h3>
                <p>Tổng số đơn hàng</p>
            </div>
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>{{ number_format($totalRevenue, 0, ',', '.') }}đ</h3>
                <p>Doanh thu</p>
            </div>
            <i class="fa-solid fa-sack-dollar"></i>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>{{ number_format($uniqueCustomers) }}</h3>
                <p>Khách hàng</p>
            </div>
            <i class="fa-solid fa-users"></i>
        </div>
    </div>

    <div class="dashboard-section">
        @if(count($statusItems) > 0)
        <div class="stats-grid">
            @foreach($statusItems as $item)
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>{{ number_format($item['count']) }}</h3>
                        <p>{{ $item['status'] }}</p>
                    </div>
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
            @endforeach
        </div>
        @else
            <p>Không có dữ liệu đơn hàng trong khoảng thời gian này.</p>
        @endif
    </div>

    <div class="dashboard-section">
        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Trạng thái</th>
                        <th>Số đơn</th>
                        <th>Doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statusItems as $item)
                        <tr>
                            <td>{{ $item['status'] }}</td>
                            <td>{{ number_format($item['count']) }}</td>
                            <td>{{ number_format($item['revenue'], 0, ',', '.') }}đ</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Không có dữ liệu để hiển thị.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection