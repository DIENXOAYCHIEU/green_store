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
	<div class="flex flex-rows">
		<div class="w-2/3">
			<img src="{{asset('storage/bg/recycling.png')}}" class="w-full">
		</div>
		<div class="w-1/3 flex flex-col gap-4 items-center mt-[5rem]">
			<div class="flex items-center justify-center">
				<a href="{{route('product.index')}}">
					<p class="text-white-line text-[3rem] italic font-bold text-green-500">GREEN STORE</p>
				</a>
			</div>
			<form method="POST" action="{{route('login.handle')}}" class="border-1 border-gray-400 rounded-[0.4rem] w-2/3">
				@csrf
				<div class="flex flex-col gap-4 p-3">
					<div class="flex flex-rows border-1 border-gray-300 overflow-hidden rounded-[0.4rem]">
						<span class="w-[2rem] h-[2rem] bg-gray-200 flex justify-center items-center ">
							<i class='bx bxs-user'></i>
						</span>
						<input type="text" name="key" class="w-full pl-2 pr-2" placeholder="Username or email">
					</div>

					<div class="flex flex-rows border-1 border-gray-300 rounded-[0.4rem] overflow-hidden">
						<span class="w-[2rem] h-[2rem] bg-gray-200 flex justify-center items-center">
							<i class='bx bxs-lock-alt' ></i>						
						</span>
						<input id="password" type="password" name="password" placeholder="Password" class="w-full pl-2 pr-2">
						<span id='toggle-password' class="w-[2rem] cursor-pointer h-[2rem] bg-gray-200 flex justify-center items-center">
							<i class='bx bxs-low-vision' ></i>
						</span>
					</div>

					<a href="" class="text-[0.9rem] italic text-blue-600 text-right">Quên mật khẩu</a>

					<div>
						<button type="submit" class="flex flex-rows justify-center w-full items-center gap-1 bg-blue-600 cursor-pointer hover:bg-blue-800 text-white p-2 text-[1.2rem] rounded-[0.4rem]">
							<i class='bx bxs-right-arrow-square' ></i>
							<span class="flex items-center">Đăng nhập</span>
						</button>
					</div>

					<div>
						<a  class="flex flex-rows justify-center w-full items-center gap-1 bg-blue-600 cursor-pointer hover:bg-blue-800 text-white p-2 text-[1.2rem] rounded-[0.4rem]">
							<span class="flex items-center">Đăng ký</span>
						</a>
					</div>
					<div>
						<p class="text-center">
						----- hoặc đăng ký với -----
						</p>
					</div>
					<div class="">
						<a class="cursor-pointer hover:text-blue-600 flex flex-rows gap-1 items-center justify-center border-1 border-gray-300 rounded-[0.4rem]">
							<img src="https://developers.google.com/identity/images/g-logo.png" class="w-[2rem] h-[2rem] p-1">
							<p>Google</p>
						</a>
					</div>

				</div>
			</form>
		</div>
	</div>
	<div class="overflow-hidden text-white bg-blue-500 sticky bottom-0 flex flex-rows">
		<p class="w-full slide-to-end font-bold p-2">
			CHÀO MỪNG ĐẾN VỚI GREEN STORE!
		</p>
	</div>
</body>
</html>