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
	<div class="bg-gray-100 flex items-center justify-center min-h-screen">
		<div class="w-full max-w-md">
			<form method="POST" action="{{route('login.handle')}}"
				class="bg-white shadow-lg border border-gray-300 rounded-lg">
				@csrf
				<div class="flex flex-col gap-4 p-6">
					<!-- Logo -->
					<a class="flex justify-center gap-3" href="{{route('user.home')}}">
						<i class='bx bx-leaf text-green-600 text-4xl'></i>
						<h1 class="text-[28px] font-bold italic text-green-500">
							GREEN STORE
						</h1>
					</a>
					<div>
						<div class="flex flex-row border border-gray-300 overflow-hidden rounded-[0.4rem]
						@error('email')
							ring-2 ring-red-500
						@enderror
						">
							<span class="w-[2rem] h-[2rem] bg-gray-200 flex justify-center items-center">
								<i class='bx bxs-user'></i>
							</span>
							<input type="text" name="email" placeholder="Email" class="w-full pl-2 pr-2"
								value="{{old('email')}}">
						</div>
						@error('email')
							<div>
								<p class="text-[0.9rem] text-red-600">{{$message}}</p>
							</div>
						@enderror
					</div>

					<div>
						<div class="flex flex-row border border-gray-300 rounded-[0.4rem] overflow-hidden
						@error('password')
							ring-2 ring-red-500
						@enderror
						">
							<span class="w-[2rem] h-[2rem] bg-gray-200 flex justify-center items-center">
								<i class='bx bxs-lock-alt'></i>
							</span>
							<input id="password" type="password" name="password" placeholder="Password"
								class="w-full pl-2 pr-2" value="{{old('password')}}">
							<span id='toggle-password'
								class="w-[2rem] cursor-pointer h-[2rem] bg-gray-200 flex justify-center items-center">
								<i class='bx bxs-low-vision'></i>
							</span>
						</div>
						@error('password')
							<div>
								<p class="text-[0.9rem] text-red-600">{{$message}}</p>
							</div>
						@enderror
					</div>

					<a href="{{ route('password.request') }}" class="text-[0.9rem] italic text-blue-600 text-right">Quên
						mật khẩu</a>
					@if(session('error'))
						<div>
							<p class="text-red-700 bg-red-200 p-1 rounded-[0.3rem]">{{session('error')}}</p>
						</div>
					@endif
					@if(session('success'))
						<div id='message-success'
							class="text-center fixed top-[5rem] left-1/2 -translate-x-1/2 z-5 flex justify-center items-center">
							<p
								class="slide-down p-2 bg-white text-green-600 border-2 rounded-[0.5rem] border-green-600 font-bol">
								{{session('success')}}
							</p>

					</div>
				@endif
				<div>
					<button type="submit"
						class="flex flex-row justify-center w-full items-center gap-1 bg-green-600 cursor-pointer hover:bg-green-700 text-white p-2 text-[1.2rem] rounded-[0.4rem]">
						<i class='bx bxs-right-arrow-square'></i>
						<span class="flex items-center">Đăng nhập</span>
					</button>
				</div>

					<div>
						<a href="{{ route('auth.register') }}"
							class="flex flex-row justify-center w-full items-center gap-1 bg-blue-600 cursor-pointer hover:bg-blue-800 text-white p-2 text-[1.2rem] rounded-[0.4rem]">
							<span class="flex items-center">Đăng ký</span>
						</a>
					</div>
					<div>
						<p class="text-center">
							----- hoặc đăng ký với -----
						</p>
					</div>
					<div class="">
						<a href="{{ route('auth.google.redirect') }}"
							class="cursor-pointer hover:text-blue-600 flex flex-row gap-1 items-center justify-center border border-gray-300 rounded-[0.4rem]">
							<img src="https://developers.google.com/identity/images/g-logo.png"
								class="w-[2rem] h-[2rem] p-1">
							<p>Google</p>
						</a>
					</div>

				</div>
			</form>
		</div>
	</div>
</body>

</html>