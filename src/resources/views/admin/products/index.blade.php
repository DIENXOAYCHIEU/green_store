@extends('admin.home.homepage')

@section('title', 'Quản lý sản phẩm -')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products.css') }}">
@endpush

@section('content')
<div class="user-management-container">
    <div class="content-header">
        <div class="header-title">
            <h2><i class="fa-solid fa-box"></i> Quản lý sản phẩm</h2>
            <p>Danh sách sản phẩm hiện có trong kho</p>
        </div>
        <div class="header-btns">
            <a href="{{ route('admin.products.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Thêm sản phẩm mới
            </a>
        </div>
    </div>

    <div class="filter-section">
        <form action="{{ route('admin.products.index') }}" method="GET" class="filter-wrapper">
            <div class="search-group">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Tìm tên sản phẩm..." value="{{ request('search') }}">
            </div>

            <div class="select-group">
                <select name="category_id" class="filter-select" onchange="this.form.submit()">
                    <option value="">Tất cả danh mục</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <a href="{{ route('admin.products.index') }}" class="btn-reset">
                <i class="fa-solid fa-rotate-left"></i> Reset
            </a>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="styled-table">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá bán</th>
                <th>Tồn kho</th>
                <th style="text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    <div class="user-info">
                        <img src="{{ $product->picture_url }}" alt="{{ $product->name }}">
                    </div>
                </td>
                <td>
                    <div class="user-name">
                        <strong>{{ $product->name }}</strong>
                        <span>ID: #{{ $product->id }}</span>
                    </div>
                </td>
                <td><span class="badge-role">{{ $product->categories->name ?? 'N/A' }}</span></td>
                <td><span class="text-bold">{{ number_format($product->price) }}đ</span></td>
                <td>
                    <span class="{{ $product->inventory_quantity > 0 ? 'status-active' : 'status-inactive' }}">
                        <i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $product->inventory_quantity }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn-action view" title="Xem">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action edit" style="background:#ffedd5; color:#d97706; border:1px solid #fed7aa;" title="Sửa">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf 
                            @method('DELETE')
                            <button class="btn-action delete" title="Xóa" onclick="return confirm('Xác nhận xóa?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container">
        <div class="page-numbers">
            {{-- Sử dụng bootstrap-4 hoặc simple-bootstrap-4 để dễ custom CSS hơn --}}
            {{ $products->appends(request()->all())->links('pagination::bootstrap-4') }}
        </div>

        <div class="pagination-info">
            Hiển thị <b>{{ $products->firstItem() }}</b> - <b>{{ $products->lastItem() }}</b> 
            trên tổng <b>{{ $products->total() }}</b> sản phẩm
        </div>
    </div>
</div>
@endsection