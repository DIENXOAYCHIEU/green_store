@extends('admin.home.homepage')

@section('title', 'Chi tiết tài khoản')

@section('content')
<div class="user-management-container">
    <div class="content-header">
        <div class="header-title">
            <h2><i class="fa-solid fa-user"></i> Chi tiết tài khoản</h2>
            <p>Xem thông tin chi tiết của tài khoản khách hàng hoặc nhân viên.</p>
        </div>
        <div class="header-btns">
            <a href="{{ route('admin.users.edit', $account->id) }}" class="btn-add"><i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa</a>
            <a href="{{ route('admin.users') }}" class="btn-export"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
        </div>
    </div>

    <div class="user-detail-card">
        <div class="user-profile-section">
            <div class="user-avatar">
                <img src="{{ $account->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($account->username) . '&background=dcfce7&color=166534&size=120' }}" alt="avatar">
            </div>
            <div class="user-basic-info">
                <h3>{{ $account->username }}</h3>
                <p class="user-email">{{ $account->email }}</p>
                <div class="user-status">
                    @if($account->deleted_at)
                        <span class="status-inactive"><i class="fa-solid fa-circle"></i> Đã xóa</span>
                    @else
                        <span class="status-active"><i class="fa-solid fa-circle"></i> Đang hoạt động</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="user-details-grid">
            <div class="detail-section">
                <h4><i class="fa-solid fa-id-card"></i> Thông tin cá nhân</h4>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>ID tài khoản</label>
                        <span>#{{ $account->id }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Tên đăng nhập</label>
                        <span>{{ $account->username }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Email</label>
                        <span>{{ $account->email }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Số điện thoại</label>
                        <span>{{ $account->phone }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Vai trò</label>
                        <span class="badge-role">{{ ucfirst($account->roles?->name ?? 'Chưa phân quyền') }}</span>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <h4><i class="fa-solid fa-clock"></i> Thông tin hệ thống</h4>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Ngày tạo</label>
                        <span>{{ $account->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Cập nhật lần cuối</label>
                        <span>{{ $account->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @if($account->email_verified_at)
                    <div class="detail-item">
                        <label>Email xác thực</label>
                        <span class="verified"><i class="fa-solid fa-check-circle"></i> Đã xác thực</span>
                    </div>
                    @else
                    <div class="detail-item">
                        <label>Email xác thực</label>
                        <span class="unverified"><i class="fa-solid fa-times-circle"></i> Chưa xác thực</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if($account->reviews->count() > 0)
        <div class="detail-section">
            <h4><i class="fa-solid fa-star"></i> Đánh giá gần đây</h4>
            <div class="reviews-list">
                @foreach($account->reviews->take(3) as $review)
                <div class="review-item">
                    <div class="review-header">
                        <span class="review-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $review->rating ? 'active' : '' }}"></i>
                            @endfor
                        </span>
                        <span class="review-date">{{ $review->created_at->format('d/m/Y') }}</span>
                    </div>
                    <p class="review-content">{{ Str::limit($review->comment, 100) }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection