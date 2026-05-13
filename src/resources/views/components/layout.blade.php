<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Green Store</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<script>
		// Global user ID variable
		window.currentUserId = @if(Auth::check()) {{ Auth::id() }} @else null @endif;
	</script>
</head>

<body class="bg-gray-50">

	
	<!-- HEADER -->
    <header class="sticky top-0 z-50 bg-white shadow-sm">

    <!-- TOP HEADER -->
    <div class="flex items-center justify-between
                h-[75px] px-8
                border-b border-gray-200">

        <!-- LEFT -->
        <a class="flex items-center gap-3" href="{{route('user.home')}}">
            <i class='bx bx-leaf text-green-600 text-4xl'></i>
            <h1 class="text-[28px] font-bold italic text-green-500">
                GREEN STORE
            </h1>
        </a>

        <!-- SEARCH -->
        <div class="flex-1 flex justify-center">

            <form action="{{ route('products.search') }}" method="GET">

        <div class="flex items-center">

            <!-- INPUT -->
            <div class="w-[500px] h-[48px]
                        bg-white border border-gray-200
                        rounded-l-full px-5
                        flex items-center shadow-sm">

                <input
                    type="text"
                    name="keyword"
                    placeholder="Tìm sản phẩm xanh..."
                    class="w-full bg-transparent outline-none
                           text-sm text-gray-700
                           placeholder:text-gray-400"
                >

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-[100px] h-[48px]
                           bg-green-600
                           rounded-r-full
                           flex items-center justify-center
                           hover:bg-green-700 transition shadow-sm">

                <i class='bx bx-search text-white text-xl'></i>

                <span class="text-white relative -top-[1px] ml-1">
                    Tìm
                </span>

            </button>

        </div>

    </form>

</div>

        <!-- RIGHT -->
        <div class="flex items-center gap-6">

            <!-- CART -->
            <a class="relative" href="{{ route('user.cart') }}">
                <i class='bx bx-cart text-[32px] cursor-pointer'></i>
                <span class="absolute -top-2 -right-2
                             bg-red-500 text-white
                             text-[10px]
                             px-1.5 rounded-full">
                    <span id="cart-count">0</span>
                </span>
            </a>

            <!-- USER -->
            <div id="avatarButton" class='text-[32px] cursor-pointer'>
				<i class='text-[1.5rem] md:text-[2.5rem] bx bx-user-circle'></i>
			</div>
            <div id="avatarDropdown" class="user-dropdown shadow">
				@if(Auth::check())
					<div class="dropdown-user-info">
						<div class="fw-bold">{{ Auth::user()->username }}</div>
						<div class="text-muted small">{{ Auth::user()->email }}</div>
					</div>
					<hr>

					<a href="{{ route('user.profile') }}" class="dropdown-item-custom">
						<i class='bx bx-user'></i> Tài khoản của tôi
					</a>

					<a href="{{ route('user.purchase') }}" class="dropdown-item-custom">
						<i class='bx bx-package'></i> Đơn mua
					</a>

					<form method="POST" action="{{route('logout')}}">
						@csrf
						<button class="dropdown-item-custom w-100 text-start cursor-pointer">
							<i class='bx bx-log-out'></i> Đăng xuất
						</button>
					</form>

				@else
					<a href="{{route('login')}}" class="dropdown-item-custom">
						Đăng nhập
					</a>
					<a href="{{ route('auth.register') }}" class="dropdown-item-custom">
						Đăng ký
					</a>
				@endif
			</div>
        </div>

    </div>

    <!-- MENU -->
    <div class="h-[55px]
                flex items-center justify-center
                border-b border-gray-200 bg-white">

        <nav class="flex items-center gap-12 text-[15px] font-medium">
            <!-- HOME -->
            <a href="/"
            class="relative group transition
            {{ request()->is('/') ? 'text-green-600' : 'hover:text-green-600' }}">
                Trang chủ
                <span class="absolute left-0 -bottom-[18px]
                            w-full h-[2px]
                            bg-green-600
                            origin-left transition-transform duration-300
                            {{ request()->is('/') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </span>
            </a>

            <!-- SHOP -->
            <a href="/product"
            class="relative group transition
            {{ request()->is('product') ? 'text-green-600' : 'hover:text-green-600' }}">
                Cửa hàng
                <span class="absolute left-0 -bottom-[18px]
                            w-full h-[2px]
                            bg-green-600
                            origin-left transition-transform duration-300
                            {{ request()->is('product') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </span>
            </a>
            <!-- CATEGORIES -->
            <a href="/category"
            class="relative group transition
            {{ request()->is('category') ? 'text-green-600' : 'hover:text-green-600' }}">
                Các loại sản phẩm
                <span class="absolute left-0 -bottom-[18px]
                            w-full h-[2px]
                            bg-green-600
                            origin-left transition-transform duration-300
                            {{ request()->is('category') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </span>
            </a>

            <!-- CONTACT -->
            <a href="/contact"
            class="relative group transition
            {{ request()->is('contact') ? 'text-green-600' : 'hover:text-green-600' }}">
                Liên hệ
                <span class="absolute left-0 -bottom-[18px]
                            w-full h-[2px]
                            bg-green-600
                            origin-left transition-transform duration-300
                            {{ request()->is('contact') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </span>
            </a>
        </nav>
    </div>

    </header>
	<!-- MAIN CONTENT -->
	<div class="max-w-7xl mx-auto px-6 py-6">
		{{ $slot }}
	</div>

	<!-- FOOTER -->
	<div class="bg-white mt-10 p-10 border-t border-gray-300 grid grid-cols-1 md:grid-cols-3 gap-8">
		<div>
			<p class="text-lg font-bold mb-2">Về chúng tôi</p>
			<p class="text-sm text-gray-600">
				Green Store cung cấp sản phẩm thân thiện môi trường như ống hút tre, hộp đựng, chậu cây...
			</p>
		</div>

		<div>
			<p class="text-lg font-bold mb-2">Danh mục</p>
			<p>Inox</p>
			<p>Nature</p>
			<p>Recycling</p>
		</div>

		<div>
			<p class="text-lg font-bold mb-2">Liên hệ</p>
			<div class="flex gap-3 text-2xl">
				<i class='bx bxl-facebook-circle'></i>
				<i class='bx bxl-instagram'></i>
			</div>
			<p class="mt-2 text-sm">greenstore@gmail.com</p>
		</div>
	</div>

	@if(session('success'))
		<div id='message-success' class="text-center fixed top-[5rem] left-1/2 -translate-x-1/2 z-5 flex justify-center items-center">
			<p class="slide-down p-2 bg-white text-green-600 border-2 rounded-[0.5rem] border-green-600 font-bol">
				{{session('success')}}
			</p>

		</div>
	@endif
</body>

<script>
	const avatarButton = document.getElementById("avatarButton")
	const avatarDropdown = document.getElementById("avatarDropdown")

	avatarButton.addEventListener("click", () => {
		avatarDropdown.classList.toggle("show")
	})

	document.addEventListener("click", (e) => {

		if (!avatarButton.contains(e.target) && !avatarDropdown.contains(e.target)) {
			avatarDropdown.classList.remove("show")
		}

	})

	// Update cart count on page load
	document.addEventListener('DOMContentLoaded', function() {
		const cartCount = document.getElementById('cart-count');
		if (cartCount) {
			try {
				const cart = JSON.parse(sessionStorage.getItem(`cart-${window.currentUserId}`) || '[]');
				const totalItems = cart.reduce((total, product) => total + (product.quantity || 0), 0);
				cartCount.textContent = totalItems;
			} catch (error) {
				cartCount.textContent = '0';
			}
		}

		// Show popup for VNPay success message
		const successDiv = document.getElementById('message-success');
		if (successDiv && window.showPopup) {
			const message = successDiv.textContent.trim();
			if (message) {
				window.showPopup(message, 'success', 4000);
				successDiv.remove();
			}
		}
	});
</script>
</html>