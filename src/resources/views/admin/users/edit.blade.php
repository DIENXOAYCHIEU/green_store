@extends('admin.home.homepage')

@section('title', 'Chỉnh sửa người dùng')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')
<div class="user-management-container">
    <div class="content-header">
        <div class="header-title">
            <h2><i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa người dùng</h2>
            <p>Cập nhật thông tin tài khoản khách hàng hoặc nhân viên.</p>
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

    <form action="{{ route('admin.users.update', $account->id) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input id="username" name="username" type="text" value="{{ old('username', $account->username) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $account->email) }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone', $account->phone) }}" required>
        </div>
        <div class="form-group">
            <label for="role_id">Vai trò</label>
            <select id="role_id" name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $account->role_id) == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-add"><i class="fa-solid fa-check"></i> Lưu thay đổi</button>
        </div>
    </form>
</div>
@endsection