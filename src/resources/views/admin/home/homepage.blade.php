<!-- resources/views/admin/home/homepage.blade.php -->
 <!-- khung chung cho trang admin -->
 <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Green Life Store</title>
    <link rel="stylesheet" href="{{ asset('css/admin/layout.css') }}">
    @stack('styles')
    <!-- Thêm icon từ FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <i class="fa-solid fa-leaf"></i>
            <span>Green Life</span>
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
                </li>
                <li class="{{ Request::is('admin/users') ? 'active' : '' }}">
                    <a href="{{ route('admin.users') }}"><i class="fa-solid fa-users"></i> Quản lý người dùng</a>
                </li>
                <li class="{{ Request::is('admin/products') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}"><i class="fa-solid fa-box"></i> Quản lý sản phẩm</a>
                </li>
                <!-- <li><a href="#"><i class="fa-solid fa-list"></i> Quản lý danh mục</a></li> -->
                <li class="{{ Request::is('admin/orders') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}"><i class="fa-solid fa-cart-shopping"></i> Quản lý đơn hàng</a>
                </li>
                <!-- <li><a href="#"><i class="fa-solid fa-tag"></i> Quản lý khuyến mãi</a></li>
                <li><a href="#"><i class="fa-solid fa-star"></i> Quản lý đánh giá</a></li>
                <li><a href="#"><i class="fa-solid fa-credit-card"></i> Quản lý thanh toán</a></li>
                <li><a href="#"><i class="fa-solid fa-truck"></i> Quản lý vận chuyển</a></li>
                <li><a href="#"><i class="fa-solid fa-bell"></i> Thông báo User</a></li> -->
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Tìm kiếm hệ thống...">
            </div>
            <div class="header-actions">
                <div class="theme-toggle"><i class="fa-solid fa-sun"></i></div>
                <div class="notification-icon">
                    <i class="fa-solid fa-bell"></i>
                    <span class="badge">3</span>
                </div>
                <div class="admin-profile dropdown">
                    <div class="profile-trigger">
                        <!-- Lấy avatar theo tên của admin đăng nhập -->
                        <img src="{{ auth()->user()->avatar ? auth()->user()->avatar : 'https://res.cloudinary.com/dl5najcrb/image/upload/v1775904289/default-avatar-icon-of-social-media-user-vector_znbehh.jpg' }}" class="rounded-full w-[1.5rem] h-[1.5rem] md:w-[2.5rem] md:h-[2.5rem]" class="user-avatar">
                        <span>Xin chào Admin, {{ Auth::user()->fullname }}</span>
                        <i class="fa-solid fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i>
                    </div>
                    
                    <!-- Menu thả xuống khi click/hover -->
                    <div class="dropdown-menu">
                        <div class="dropdown-header">
                            <strong>{{ Auth::user()->username }}</strong>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                        <hr>
                        
                        <!-- Nút đăng xuất phải dùng Form để bảo mật (tránh lỗi CSRF) -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <section class="content-body">
            <!-- Chỉ hiển thị slogan nếu URL chính xác là admin (trang chủ) -->
            @if(Request::is('admin')) 
                <div class="slogan-section">
                    <h1>Chào mừng trở lại!</h1>
                    <p>"Vì một tương lai xanh, bắt đầu từ những lựa chọn bền vững hôm nay."</p>
                </div>
            @endif

            <!-- Nơi nội dung của các trang con sẽ nhảy vào đây -->
            <div class="main-page-content">
                @yield('content')
            </div>

        </section>
    </main>

</body>
</html>
