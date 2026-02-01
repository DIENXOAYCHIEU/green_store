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
			<div class="h-[3rem] w-[3rem] flex items-center justify-center cursor-pointer"><i class='text-[2.5rem] bx bx-menu'></i></div>
			<div class="h-[3rem] w-[3rem] flex items-center justify-center cursor-pointer"><i class='text-[2.5rem] bx bx-search' ></i></div>
		</div>
		<div class="flex items-center justify-center">
			<p class="text-white-line text-[3rem] italic font-bold text-green-500">GREEN STORE</p>
		</div>
		<div class="flex flex-row gap-4">
			<div id='cart-button' class="h-[3rem] w-[3rem] flex items-center justify-center cursor-pointer"><i class='text-[2.5rem] bx bx-cart'></i></div>
			<div class="h-[3rem] w-[3rem] flex items-center justify-center cursor-pointer"><i class='text-[2.5rem] bx bx-user-circle' ></i></div>
		</div>
	</div>

	<!-- container -->
	{{ $slot }}

	<!-- footer -->

	<div class="p-[4rem] border-t-1 border-gray-300 flex flex-row gap-4 justify-between items-top">
		<div class="flex flex-col gap-2 w-1/4">
			<p class="text-[1.5rem] font-bold">Về chúng tôi</p>
			<p class="text-[1.2rem]">Chào mừng đến với Green Store, đây là nơi gặp gỡ các sản phẩm tái chế thân thiện môi trường, cùng với chất lượng tốt không dễ bị hư hỏng. Sản phẩm gồm có như ống hút tre,hộp đựng, chậu cây...<br>Hãy khám phá cửa hàng thêm để tìm sản phẩm phù hợp cho bạn.</p>
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
			<p class="text-[1.2rem]"><i class='bx bxl-instagram' ></i></p>
			<p class="text-[1.2rem] flex flex-row gap-2 justify-center items-center"><i class='bx bx-envelope' ></i>Email: greenstore@gmail.com</p>
		</div>
	</div>

	<!-- cart -->
	@include('components.product-cart')
</body>
</html>