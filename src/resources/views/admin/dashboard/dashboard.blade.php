@extends('admin.home.homepage')

@section('title', 'Dashboard - ')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <p>Đơn hàng mới</p>
                <h3>1,284</h3>
                <div style="color: #10b981; font-size: 0.85rem; font-weight: bold;">
                    <i class="fa-solid fa-arrow-up"></i> +12% hôm nay
                </div>
            </div>
            <i class="fa-solid fa-leaf"></i>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>Doanh thu tháng</p>
                <h3>45.2M <small style="font-size: 1rem;">VND</small></h3>
                <div style="color: #10b981; font-size: 0.85rem; font-weight: bold;">
                    <i class="fa-solid fa-arrow-up"></i> +8.5%
                </div>
            </div>
            <i class="fa-solid fa-seedling"></i>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>Khách hàng mới</p>
                <h3>852</h3>
                <div style="color: #64748b; font-size: 0.85rem; font-weight: bold;">
                    <i class="fa-solid fa-user-plus"></i> Đang tăng trưởng
                </div>
            </div>
            <i class="fa-solid fa-earth-americas"></i>
        </div>
    </div>
@endsection