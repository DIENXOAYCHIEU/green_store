@extends('admin.home.homepage')

@section('title', 'Thêm người dùng mới')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')
<div class="user-management-container">
    <div class="content-header">
        <div class="header-title">
            <h2><i class="fa-solid fa-user-plus"></i> Thêm người dùng mới</h2>
            <p>Nhập thông tin tài khoản để thêm người dùng vào hệ thống.</p>
        </div>
        <div class="header-btns">
            <a href="{{ route('admin.users') }}" class="btn-add"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" class="form-card">
        @csrf
        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input id="username" name="username" type="text" value="{{ old('username') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required>
        </div>
        <div class="form-group">
            <label for="role_id">Vai trò</label>
            <select id="role_id" name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input id="password" name="password" type="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-add"><i class="fa-solid fa-check"></i> Lưu tài khoản</button>
        </div>
    </form>
</div>
@endsection