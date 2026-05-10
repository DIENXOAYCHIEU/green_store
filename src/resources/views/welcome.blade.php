<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Green Store</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-50">

<!-- HEADER -->
<header class="bg-green-600 text-white p-4 flex justify-between items-center shadow-md sticky top-0">
    <div class="flex items-center gap-2">
    <img src="{{ asset('public/logo.png') }}" class="h-10">
    <span class="font-bold text-lg">Green Store</span>
    </div>
    <nav class="space-x-6 hidden md:block">
        <a href="#" class="hover:underline">Trang chủ</a>
        <a href="#" class="hover:underline">Sản phẩm</a>
        <a href="#" class="hover:underline">Giới thiệu</a>
        <a href="#" class="hover:underline">Liên hệ</a>
    </nav>
    <input class="px-3 py-1 rounded text-black" placeholder="Tìm kiếm...">
</header>

<!-- HERO -->
<section class="bg-gradient-to-r from-green-400 to-green-200 text-center py-20">
    <h2 class="text-4xl font-bold mb-4">Sống xanh mỗi ngày 🌿</h2>
    <p class="mb-6">Thực phẩm sạch - tốt cho sức khỏe</p>
    <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
        Mua ngay
    </button>
</section>

<!-- DANH MỤC -->
<section class="py-12">
    <h2 class="text-2xl font-bold text-center mb-8">Danh mục</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 px-10">
        <div class="bg-white p-6 rounded-xl shadow hover:scale-105 transition text-center">🥦 Rau củ</div>
        <div class="bg-white p-6 rounded-xl shadow hover:scale-105 transition text-center">🍎 Trái cây</div>
        <div class="bg-white p-6 rounded-xl shadow hover:scale-105 transition text-center">🌱 Organic</div>
        <div class="bg-white p-6 rounded-xl shadow hover:scale-105 transition text-center">🥤 Đồ uống</div>
    </div>
</section>

<!-- SẢN PHẨM -->
<section class="py-12 bg-gray-100">
    <h2 class="text-2xl font-bold text-center mb-8">Sản phẩm nổi bật</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-10">

        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
            <img class="rounded mb-4" src="https://via.placeholder.com/300">
            <h3 class="font-bold">Táo sạch</h3>
            <p class="text-green-600">50.000đ</p>
            <button class="mt-2 bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">
                Thêm
            </button>
        </div>

        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
            <img class="rounded mb-4" src="https://via.placeholder.com/300">
            <h3 class="font-bold">Cà rốt</h3>
            <p class="text-green-600">30.000đ</p>
            <button class="mt-2 bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">
                Thêm
            </button>
        </div>

        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
            <img class="rounded mb-4" src="https://via.placeholder.com/300">
            <h3 class="font-bold">Nước ép</h3>
            <p class="text-green-600">40.000đ</p>
            <button class="mt-2 bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">
                Thêm
            </button>
        </div>

    </div>
</section>

<!-- ƯU ĐIỂM -->
<section class="py-12">
    <div class="grid md:grid-cols-4 text-center gap-6 px-10">
        <div>🚚 Giao nhanh</div>
        <div>🌿 Sạch 100%</div>
        <div>💰 Giá tốt</div>
        <div>📞 24/7</div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-green-600 text-white text-center p-4 mt-10">
    © 2026 Green Store | 0123456789
</footer>

</body>
</html>