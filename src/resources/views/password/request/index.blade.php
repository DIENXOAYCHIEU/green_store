<x-layout>
	<div class="min-h-screen flex items-center justify-center bg-gray-100">
		<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
			<div>
				<a href="{{ route('login') }}"
					class="inline-flex items-center gap-2 text-gray-600 hover:text-green-600 transition">
					<i class='bx bx-arrow-back text-lg'></i>
					<span>Quay lại</span>
				</a> <!-- Title -->
				<h1 class="text-2xl font-bold text-center text-gray-800 mb-6">
					Quên Mật Khẩu
				</h1>
			</div>

			<form action="{{ route('password.email') }}" method="POST" class="space-y-5">
				@csrf

				<div>
					<label class="text-sm font-medium text-gray-600">Email</label>

					<div class="mt-1 flex items-center border rounded-lg overflow-hidden
                focus-within:ring-2 focus-within:ring-green-500
                @error('email') border-red-500 @enderror">

						<input id="email" type="email" name="email" placeholder="Nhập địa chỉ Email"
							class="w-full px-2 py-2 outline-none">
					</div>
					@error('email')
						<p class="text-red-500 text-sm mt-1">{{$message}}</p>
					@enderror
				</div>

				<!-- Session Error -->
				@if(session('error'))
					<div class="bg-red-100 text-red-700 p-3 rounded-lg text-sm">
						{{ session('error') }}
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

				<!-- Button -->
				<button type="submit"
					class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-semibold transition duration-200">

					Gửi
				</button>
			</form>
		</div>
	</div>
</x-layout>