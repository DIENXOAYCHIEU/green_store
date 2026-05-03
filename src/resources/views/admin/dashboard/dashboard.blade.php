<!-- resources/views/admin/dashboard/dashboard.blade.php -->
@extends('admin.home.homepage')

@section('title', 'Dashboard')

@section('content')
    <!-- Chỉ giữ lại phần Stats Grid ở đây -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>1,284</h3>
                <p>Đơn hàng mới</p>
            </div>
            <i class="fa-solid fa-leaf"></i>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>VND 45M</h3>
                <p>Doanh thu tháng</p>
            </div>
            <i class="fa-solid fa-seedling"></i>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>852</h3>
                <p>Khách hàng mới</p>
            </div>
            <i class="fa-solid fa-earth-americas"></i>
        </div>
    </div>
@endsection