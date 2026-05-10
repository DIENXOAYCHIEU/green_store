@extends('admin.home.homepage')

@section('title', 'Chỉnh sửa sản phẩm - ' . $product->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products.css') }}">
@endpush

@section('content')
<div class="user-management-container">
    <div class="page-header">
        <h2><i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa sản phẩm</h2>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="name" value="{{ $product->name }}" required>
                </div>

                <div class="form-group">
                    <label>Danh mục</label>
                    <select name="category_id">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Giá bán (VNĐ)</label>
                    <input type="number" name="price" value="{{ $product->price }}">
                </div>

                <div class="form-group">
                    <label>Số lượng tồn kho</label>
                    <input type="number" name="inventory_quantity" value="{{ $product->inventory_quantity }}">
                </div>
            </div>

            <div class="form-group">
                <label>Mô tả sản phẩm</label>
                <textarea name="description" rows="4" style="width: 100%; border-radius: 16px; border: 1px solid #e2e8f0; padding: 1rem; background: #f8fafc;">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Ảnh sản phẩm hiện tại</label>
                <div style="margin-bottom: 10px;">
                    <img src="{{ $product->picture_url }}" width="150" class="img-thumbnail" style="border-radius: 12px;">
                </div>
                <label>Thay đổi ảnh (Nếu có)</label>
                <input type="file" name="picture">
            </div>

            <div class="form-actions" style="display: flex; gap: 10px; justify-content: flex-start;">
                <button type="submit" class="btn-add">Cập nhật sản phẩm</button>
                <a href="{{ route('admin.products.index') }}" class="btn-export" style="text-decoration: none; display: flex; align-items: center;">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
@endsection