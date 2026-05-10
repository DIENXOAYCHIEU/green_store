@extends('admin.home.homepage')

@section('title', 'Chi tiết sản phẩm - ' . $product->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products.css') }}">
@endpush

@section('content')
<div class="user-management-container">
    <div class="user-detail-card">
        <div class="user-profile-section">
            <div class="user-avatar">
                <img src="{{ $product->picture_url }}" alt="{{ $product->name }}">
            </div>
            <div class="user-basic-info">
                <h3>{{ $product->name }}</h3>
                <p class="user-email">Giá bán: <b style="color: var(--primary-color)">{{ number_format($product->price) }}đ</b></p>
                <span class="badge-role">Danh mục: {{ $product->categories->name ?? 'Chưa có danh mục' }}</span>
            </div>
        </div>

        <div class="user-details-grid">
            <div class="detail-section">
                <h4><i class="fa-solid fa-circle-info"></i> Thông số cơ bản</h4>
                <div class="detail-grid">
                    <div class="detail-item"><label>Tồn kho:</label> <span>{{ $product->inventory_quantity }}</span></div>
                    <div class="detail-item"><label>Đã bán:</label> <span>{{ $product->sold_quantity }}</span></div>
                </div>
            </div>
        </div>

        <div class="detail-section">
            <h4><i class="fa-solid fa-align-left"></i> Mô tả chi tiết</h4>
            <div class="review-item" style="background: #f8fafc; padding: 1.5rem; border-radius: 16px;">
                <p class="review-content">{{ $product->description }}</p>
            </div>
        </div>

        <div class="form-actions" style="margin-top: 2rem;">
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action edit" style="background:#ffedd5; color:#d97706; border:1px solid #fed7aa;" title="Sửa">
                <i class="fa-solid fa-pen-to-square"></i> Sửa thông tin sản phẩm
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn-export" style="text-decoration:none">
                <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>
</div>
@endsection