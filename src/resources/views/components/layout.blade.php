<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Green Store</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<!-- header -->

	<div class="flex flex-row h-[4rem] w-full justify-between items-center p-4 border-b-1 border-gray-300">
		<div class="flex flex-row gap-4">
			<div class="h-[3rem] w-[3rem] flex items-center justify-center cursor-pointer"><i
					class='text-[2.5rem] bx bx-menu'></i></div>
			<div class="h-[3rem] w-[3rem] flex items-center justify-center cursor-pointer"><i
					class='text-[2.5rem] bx bx-search'></i></div>
		</div>
		<div class="flex items-center justify-center">
			<a href="{{route('user.home')}}">
				<p class="text-white-line text-[3rem] italic font-bold text-green-500">GREEN STORE</p>
			</a>
		</div>
		<div class="position-relative">
			<div class="flex flex-row gap-4">
				<div id='cart-button'
					class="relative h-[3rem] w-[3rem] flex items-center justify-center cursor-pointer"></div>

				<!-- Avatar button -->
				<div id="avatarButton" class="cursor-pointer d-flex align-items-center justify-content-center"
					style="width:40px;height:40px">

					@if(Auth::check())
						<img src="{{asset('storage/avatars/' . Auth::user()->avatar)}}" class="rounded-full"
							style="width:40px;height:40px;object-fit:cover;">
					@else
						<i class='bx bx-user-circle pt-2' style="font-size:33px"></i>
					@endif

				</div>
			</div>

			<!-- Dropdown -->
			<div id="avatarDropdown" class="user-dropdown shadow">

				@if(Auth::check())

					<div class="dropdown-user-info">
						<div class="fw-bold">{{ Auth::user()->username }}</div>
						<div class="text-muted small">{{ Auth::user()->email }}</div>
					</div>

					<hr>

					<a href="#" class="dropdown-item-custom">
						<i class='bx bx-user'></i> Tài khoản của tôi
					</a>

					<a href="#" class="dropdown-item-custom">
						<i class='bx bx-package'></i> Đơn mua
					</a>

					<form method="POST" action="{{route('logout.handle')}}">
						@csrf
						<button class="dropdown-item-custom w-100 text-start cursor-pointer">
							<i class='bx bx-log-out'></i> Đăng xuất
						</button>
					</form>

				@else

					<a href="{{route('auth.login')}}" class="dropdown-item-custom">
						Đăng nhập
					</a>

					<a href="{{ route('auth.register') }}" class="dropdown-item-custom">
						Đăng ký
					</a>

				@endif

			</div>

		</div>
	</div>

	<!-- container -->
	{{ $slot }}

	<!-- footer -->

	<div class="p-[4rem] border-t-1 border-gray-300 flex flex-row gap-4 justify-between items-top">
		<div class="flex flex-col gap-2 w-1/4">
			<p class="text-[1.5rem] font-bold">Về chúng tôi</p>
			<p class="text-[1.2rem]">Chào mừng đến với Green Store, đây là nơi gặp gỡ các sản phẩm tái chế
				thân thiện môi trường, cùng với chất lượng tốt không dễ bị hư hỏng. Sản phẩm gồm có như
				ống hút tre,hộp đựng, chậu cây...<br>Hãy khám phá cửa hàng thêm để tìm sản phẩm phù hợp
				cho bạn.</p>
		</div>
		<div class="flex flex-col gap-2">
			<p class="text-[1.5rem] font-bold">Danh mục</p>
			<p class="text-[1.2rem]">Inox</p>
			<p class="text-[1.2rem]">Nature</p>
			<p class="text-[1.2rem]">Recycling</p>
		</div>
		<div class="flex flex-col gap-2">
			<p class="text-[1.5rem] font-bold">Liên hệ</p>
			<p class="text-[1.2rem]"> <i class='bx bxl-facebook-circle'></i></p>
			<p class="text-[1.2rem]"><i class='bx bxl-instagram'></i></p>
			<p class="text-[1.2rem] flex flex-row gap-2 justify-center items-center"><i
					class='bx bx-envelope'></i>Email: greenstore@gmail.com</p>
		</div>
	</div>

	<!-- cart -->
	@include('components.product-cart')

	<!-- message when login successfully -->

	@if(session('success'))
		<div id='message-success' class="fixed top-[5rem] left-1/2 -translate-x-1/2 z-5 flex justify-center items-center">
			<p class="slide-down p-2 bg-white text-green-600 border-2 rounded-[0.5rem] border-green-600 font-bol">
				{{session('success')}}
			</p>

		</div>
	@endif

</body>
<script>

	const avatarButton = document.getElementById("avatarButton")
	const dropdown = document.getElementById("avatarDropdown")

	avatarButton.addEventListener("click", () => {
		dropdown.classList.toggle("show")
	})

	document.addEventListener("click", (e) => {

		if (!avatarButton.contains(e.target) && !dropdown.contains(e.target)) {
			dropdown.classList.remove("show")
		}

	})

</script>

</html>