<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Green Store</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
	<div class="w-full max-w-md">
		<!-- Register form -->
		<form method="POST" action="{{route('register.handle')}}"
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
				<!-- Username -->
				<div>
					<div class="flex border border-gray-300 rounded-md overflow-hidden
            @error('username') ring-2 ring-red-500 @enderror">
						<span class="w-[2.5rem] bg-gray-200 flex items-center justify-center">
							<i class='bx bxs-user'></i>
						</span>
						<input type="text" name="username" placeholder="Tên người dùng" value="{{old('username')}}"
							class="w-full px-2 py-2 outline-none">
					</div>
					@error('username')
						<p class="text-red-600 text-sm">{{$message}}</p>
					@enderror
				</div>

				<!-- Phone -->
				<div>
					<div class="flex border border-gray-300 rounded-md overflow-hidden
            @error('phone') ring-2 ring-red-500 @enderror">
						<span class="w-[2.5rem] bg-gray-200 flex items-center justify-center">
							<i class='bx bxs-phone'></i>
						</span>
						<input type="text" name="phone" placeholder="Số điện thoại" value="{{old('phone')}}"
							class="w-full px-2 py-2 outline-none">
					</div>
					@error('phone')
						<p class="text-red-600 text-sm">{{$message}}</p>
					@enderror
				</div>

				<!-- Address fields -->
				<div class="grid grid-cols-1 gap-4">
					<div>
						<div class="flex border border-gray-300 rounded-md overflow-hidden
            @error('province') ring-2 ring-red-500 @enderror">
							<span class="w-[2.5rem] bg-gray-200 flex items-center justify-center">
								<i class='bx bx-map'></i>
							</span>
							<input type="text" name="province" placeholder="Tỉnh/Thành phố" value="{{old('province')}}"
								class="w-full px-2 py-2 outline-none">
						</div>
						@error('province')
							<p class="text-red-600 text-sm">{{$message}}</p>
						@enderror
					</div>

					<div>
						<div class="flex border border-gray-300 rounded-md overflow-hidden
            @error('district') ring-2 ring-red-500 @enderror">
							<span class="w-[2.5rem] bg-gray-200 flex items-center justify-center">
								<i class='bx bx-map-pin'></i>
							</span>
							<input type="text" name="district" placeholder="Quận/Huyện" value="{{old('district')}}"
								class="w-full px-2 py-2 outline-none">
						</div>
						@error('district')
							<p class="text-red-600 text-sm">{{$message}}</p>
						@enderror
					</div>

					<div>
						<div class="flex border border-gray-300 rounded-md overflow-hidden
            @error('ward') ring-2 ring-red-500 @enderror">
							<span class="w-[2.5rem] bg-gray-200 flex items-center justify-center">
								<i class='bx bx-location-plus'></i>
							</span>
							<input type="text" name="ward" placeholder="Phường/Xã" value="{{old('ward')}}"
								class="w-full px-2 py-2 outline-none">
						</div>
						@error('ward')
							<p class="text-red-600 text-sm">{{$message}}</p>
						@enderror
					</div>

					<div>
						<div class="flex border border-gray-300 rounded-md overflow-hidden
            @error('full_address') ring-2 ring-red-500 @enderror">
							<textarea name="full_address" placeholder="Địa chỉ chi tiết" rows="3"
								class="w-full px-2 py-2 outline-none">{{old('full_address')}}</textarea>
						</div>
						@error('full_address')
							<p class="text-red-600 text-sm">{{$message}}</p>
						@enderror
					</div>
				</div>

				<!-- Email -->
				<div>
					<div class="flex border border-gray-300 rounded-md overflow-hidden
            @error('email') ring-2 ring-red-500 @enderror">
						<span class="w-[2.5rem] bg-gray-200 flex items-center justify-center">
							<i class='bx bx-envelope'></i>
						</span>
						<input type="text" name="email" placeholder="Email" value="{{old('email')}}"
							class="w-full px-2 py-2 outline-none">
					</div>
					@error('email')
						<p class="text-red-600 text-sm">{{$message}}</p>
					@enderror
				</div>

				<!-- Password -->
				<div>
					<div class="flex border border-gray-300 rounded-md overflow-hidden
            @error('password') ring-2 ring-red-500 @enderror">
						<span class="w-[2.5rem] bg-gray-200 flex items-center justify-center">
							<i class='bx bxs-lock'></i>
						</span>
						<input id="password" type="password" name="password" placeholder="Mật khẩu"
							class="w-full px-2 py-2 outline-none">
						<span id="toggle-password"
							class="w-[2.5rem] bg-gray-200 flex items-center justify-center cursor-pointer">
							<i class='bx bxs-low-vision'></i>
						</span>
					</div>
					@error('password')
						<p class="text-red-600 text-sm">{{$message}}</p>
					@enderror
				</div>

				<!-- Confirm Password -->
				<div>
					<div class="flex border border-gray-300 rounded-md overflow-hidden
            @error('password_confirmation') ring-2 ring-red-500 @enderror">
						<span class="w-[2.5rem] bg-gray-200 flex items-center justify-center">
							<i class='bx bxs-lock'></i>
						</span>
						<input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu"
							class="w-full px-2 py-2 outline-none">
					</div>
					@error('password_confirmation')
						<p class="text-red-600 text-sm">{{$message}}</p>
					@enderror
				</div>

				<!-- Error message -->
				@if(session('error'))
					<p class="bg-red-200 text-red-700 p-2 rounded">
						{{session('error')}}
					</p>
				@endif

				<!-- Register button -->
				<button type="submit"
					class="flex flex-row justify-center w-full items-center gap-1 bg-green-600 cursor-pointer hover:bg-green-700 text-white p-2 text-[1.2rem] rounded-[0.4rem]">
					<i class='bx bx-user-plus'></i>
					Đăng Ký
				</button>

				<!-- Login link -->
				<div class="text-center text-sm">
					<span>Đã có tài khoản?</span>
					<a href="{{route('login')}}" class="text-blue-600 hover:underline">
						Đăng nhập
					</a>
				</div>
			</div>
		</form>
	</div>
</body>

</html>