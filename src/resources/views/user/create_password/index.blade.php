<x-layout>
	<div class="min-h-screen flex items-center justify-center bg-gray-100">
		<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

			<!-- Title -->
			<h1 class="text-2xl font-bold text-center text-gray-800 mb-6">
				Tạo mật khẩu mới
			</h1>

			<form action="{{ route('createPassword.handle') }}" method="POST" class="space-y-5">
				@csrf

				<!-- Password -->
				<div>
					<label class="text-sm font-medium text-gray-600">Mật khẩu</label>

					<div class="mt-1 flex items-center border rounded-lg overflow-hidden
                focus-within:ring-2 focus-within:ring-green-500
                @error('password') border-red-500 @enderror">

						<span class="px-3 text-gray-500">
							<i class='bx bxs-lock'></i>
						</span>

						<input id="password" type="password" name="password" placeholder="Nhập mật khẩu"
							class="w-full px-2 py-2 outline-none">

						<span id="toggle-password" class="px-3 text-gray-500 cursor-pointer hover:text-gray-700">
							<i class='bx bx-show'></i>
						</span>
					</div>

					@error('password')
						<p class="text-red-500 text-sm mt-1">{{$message}}</p>
					@enderror
				</div>

				<!-- Confirm Password -->
				<div>
					<label class="text-sm font-medium text-gray-600">Xác nhận mật khẩu</label>

					<div class="mt-1 flex items-center border rounded-lg overflow-hidden
                focus-within:ring-2 focus-within:ring-green-500
                @error('password_confirmation') border-red-500 @enderror">

						<span class="px-3 text-gray-500">
							<i class='bx bxs-lock'></i>
						</span>

						<input id="confirm-password" type="password" name="password_confirmation"
							placeholder="Nhập lại mật khẩu" class="w-full px-2 py-2 outline-none">
					</div>

					@error('password_confirmation')
						<p class="text-red-500 text-sm mt-1">{{$message}}</p>
					@enderror
				</div>

				<!-- Session Error -->
				@if(session('error'))
					<div class="bg-red-100 text-red-700 p-3 rounded-lg text-sm">
						{{ session('error') }}
					</div>
				@endif

				<!-- Button -->
				<button type="submit"
					class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-semibold transition duration-200">

					Tạo mật khẩu
				</button>
			</form>
		</div>
	</div>

	<!-- Toggle Password Script -->
	<script>
		const toggle = document.getElementById("toggle-password");
		const password = document.getElementById("password");

		toggle.addEventListener("click", () => {
			if (password.type === "password") {
				password.type = "text";
				toggle.innerHTML = "<i class='bx bx-hide'></i>";
			} else {
				password.type = "password";
				toggle.innerHTML = "<i class='bx bx-show'></i>";
			}
		});
	</script>
</x-layout>