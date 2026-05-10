@extends('admin.home.homepage')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="user-management-container">
    <div class="content-header">
        <div class="header-title">
            <h2><i class="fa-solid fa-users-gear"></i> Danh sách tài khoản</h2>
            <p>Quản lý thông tin khách hàng và phân quyền hệ thống</p>
        </div>
        <div class="header-btns">
            <a href="{{ route('admin.users.create') }}" class="btn-add"><i class="fa-solid fa-user-plus"></i> Thêm người dùng mới</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="filter-section">
        <form method="GET" action="{{ route('admin.users') }}" class="filter-form">
            <div class="search-box">
                <input type="text" name="q" placeholder="Tìm theo tên, email hoặc SĐT..." value="{{ request('q') }}">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <select class="filter-select" name="role" onchange="this.form.submit()">
                <option value="">Tất cả vai trò</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="table-responsive">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Người dùng</th>
                    <th>Liên hệ</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $account)
                    <tr>
                        <td>#{{ $account->id }}</td>
                        <td>
                            <div class="user-info">
                                <img src="{{ $account->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($account->username) . '&background=dcfce7&color=166534' }}" alt="avatar">
                                <div class="user-name">
                                    <strong>{{ $account->username }}</strong>
                                    <span>{{ $account->email }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-contact">
                                <div><i class="fa-solid fa-envelope"></i> {{ $account->email }}</div>
                                <div><i class="fa-solid fa-phone"></i> {{ $account->phone }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-role">{{ ucfirst($account->roles?->name ?? 'Chưa phân quyền') }}</span>
                        </td>
                        <td>
                            @if($account->deleted_at)
                                <span class="status-inactive"><i class="fa-solid fa-circle"></i> Đã xóa</span>
                            @else
                                <span class="status-active"><i class="fa-solid fa-circle"></i> Đang hoạt động</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.users.show', $account->id) }}" class="btn-icon view" title="Xem chi tiết"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('admin.users.edit', $account->id) }}" class="btn-icon edit" title="Chỉnh sửa"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('admin.users.destroy', $account->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản này?');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon delete" title="Xóa"><i class="fa-solid fa-user-slash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Không có tài khoản nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection