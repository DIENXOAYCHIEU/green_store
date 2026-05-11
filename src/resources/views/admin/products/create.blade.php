@extends('admin.home.homepage')

@section('title', 'Thêm sản phẩm mới')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products.css') }}">
@endpush

@section('content')
<div class="user-management-container">
    <div class="page-header">
        <h2><i class="fa-solid fa-plus-circle"></i> Thêm sản phẩm mới</h2>
        <p>Tạo sản phẩm mới cho hệ thống cửa hàng Green Life</p>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label><i class="fa-solid fa-leaf"></i> Tên sản phẩm</label>
                    <input type="text" name="name" placeholder="Nhập tên cây hoặc sản phẩm..." required>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-layer-group"></i> Danh mục</label>
                    <select name="category_id">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-money-bill-wave"></i> Giá gốc (VNĐ)</label>
                    <input type="number" name="price" placeholder="Ví dụ: 150000">
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-boxes-stacked"></i> Số lượng tồn kho</label>
                    <input type="number" name="inventory_quantity" value="0" min="0" required>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fa-solid fa-image"></i> Ảnh đại diện sản phẩm</label>
                <div class="file-upload-wrapper" style="position: relative;">
                    <input type="file" name="picture" id="imageInput" accept="image/*">
                    <div id="preview-container" style="margin-top: 15px; display: none;">
                        <img id="imagePreview" src="#" alt="Preview" style="max-width: 150px; border-radius: 12px; border: 2px solid #10b981;">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fa-solid fa-align-left"></i> Mô tả sản phẩm</label>
                <textarea name="description" rows="4" placeholder="Viết vài dòng giới thiệu về sản phẩm này..."></textarea>
            </div>

            <div class="form-actions" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9; display: flex; gap: 15px;">
                <button type="submit" class="btn-add">
                    <i class="fa-solid fa-check"></i> Lưu sản phẩm
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn-export" style="text-decoration: none;">
                    <i class="fa-solid fa-xmark"></i> Hủy bỏ
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Script nhỏ để xem trước ảnh ngay khi chọn
    document.getElementById('imageInput').onchange = evt => {
        const [file] = document.getElementById('imageInput').files
        if (file) {
            document.getElementById('preview-container').style.display = 'block';
            document.getElementById('imagePreview').src = URL.createObjectURL(file)
        }
    }
</script>
@endsection