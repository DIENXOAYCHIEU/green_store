@extends('admin.home.homepage')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="user-management-container">
    <!-- Header của trang con -->
    <div class="content-header">
        <div class="header-title">
            <h2><i class="fa-solid fa-users-gear"></i> Danh sách tài khoản</h2>
            <p>Quản lý thông tin khách hàng và phân quyền hệ thống</p>
        </div>
        <div class="header-btns">
            <button class="btn-export"><i class="fa-solid fa-file-export"></i> Xuất file</button>
            <button class="btn-add"><i class="fa-solid fa-user-plus"></i> Thêm người dùng mới</button>
        </div>
    </div>

    <!-- Bộ lọc tìm kiếm nhanh -->
    <div class="filter-section">
        <div class="search-box">
            <input type="text" placeholder="Tìm theo tên, email hoặc SĐT...">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <select class="filter-select">
            <option value="">Tất cả vai trò</option>
            <option value="1">Quản trị viên</option>
            <option value="2">Khách hàng</option>
            <option value="3">Nhân viên</option>
        </select>
    </div>

    <!-- Bảng danh sách người dùng -->
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
                <!-- Dữ liệu mẫu dựa trên DB accounts -->
                <tr>
                    <td>#0124</td>
                    <td>
                        <div class="user-info">
                            <img src="https://ui-avatars.com/api/?name=Nguyen+Van+A&background=dcfce7&color=166534" alt="avatar">
                            <div class="user-name">
                                <strong>Nguyễn Văn A</strong>
                                <span>@vanna_green</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="user-contact">
                            <div><i class="fa-solid fa-envelope"></i> vana@gmail.com</div>
                            <div><i class="fa-solid fa-phone"></i> 0905 123 456</div>
                        </div>
                    </td>
                    <td><span class="badge badge-admin"></span></td>
                    <td><span class="status-active"><i class="fa-solid fa-circle"></i> Đang hoạt động</span></td>
                    <td>
                        <div class="action-btns">
                            <button class="btn-icon view" title="Xem chi tiết"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn-icon edit" title="Chỉnh sửa"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn-icon delete" title="Vô hiệu hóa"><i class="fa-solid fa-user-slash"></i></button>
                        </div>
                    </td>
                </tr>
                <!-- Thêm dòng tiếp theo tương tự... -->
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="pagination">
        <span>Hiển thị 1 - 10 trên tổng số 852 người dùng</span>
        <div class="page-numbers">
            <button class="prev"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button class="next"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>
</div>
@endsection