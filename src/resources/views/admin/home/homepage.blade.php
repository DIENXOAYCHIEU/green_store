<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Green Life Store</title>
    <link rel="stylesheet" href="{{ asset('css/styleadmin.css') }}">
    <!-- Thêm icon từ FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <li class="active"><a href="#"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa-solid fa-users"></i> Quản lý người dùng</a></li>
                <li><a href="#"><i class="fa-solid fa-box"></i> Quản lý sản phẩm</a></li>
                <li><a href="#"><i class="fa-solid fa-list"></i> Quản lý danh mục</a></li>
                <li><a href="#"><i class="fa-solid fa-cart-shopping"></i> Quản lý đơn hàng</a></li>
                <li><a href="#"><i class="fa-solid fa-tag"></i> Quản lý khuyến mãi</a></li>
                <li><a href="#"><i class="fa-solid fa-star"></i> Quản lý đánh giá</a></li>
                <li><a href="#"><i class="fa-solid fa-credit-card"></i> Quản lý thanh toán</a></li>
                <li><a href="#"><i class="fa-solid fa-truck"></i> Quản lý vận chuyển</a></li>
                <li><a href="#"><i class="fa-solid fa-bell"></i> Thông báo User</a></li>
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
                <div class="admin-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=2d6a4f&color=fff" alt="Avatar">
                    <span>Chào, Quản trị viên</span>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <section class="content-body">
            <div class="slogan-section">
                <h1>Chào mừng trở lại!</h1>
                <p>"Vì một tương lai xanh, bắt đầu từ những lựa chọn bền vững hôm nay."</p>
            </div>

            <!-- Dashboard Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>1,284</h3>
                        <p>Đơn hàng mới</p>
                    </div>
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>VND 45M</h3>
                        <p>Doanh thu tháng</p>
                    </div>
                    <i class="fa-solid fa-seedling"></i>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>852</h3>
                        <p>Khách hàng mới</p>
                    </div>
                    <i class="fa-solid fa-earth-americas"></i>
                </div>
            </div>
        </section>
    </main>

</body>
</html>
