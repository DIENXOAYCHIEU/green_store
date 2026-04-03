<x-layout>

	<div class="bg-gray-100 min-h-screen py-6">
		<div class="max-w-[1200px] mx-auto flex gap-6">

			<!-- Sidebar -->
			<x-account-sidebar />

			<!-- Main Content -->
			<div class="flex-1">

				<div class="bg-white rounded-xl shadow p-6">

					<!-- Header -->
					<div class="border-b pb-4 mb-6">
						<h2 class="text-xl font-semibold text-gray-800">
							Hồ sơ của tôi
						</h2>
						<p class="text-sm text-gray-500">
							Quản lý thông tin cá nhân
						</p>
					</div>

					<!-- Content -->
					<div class="flex gap-10">

						<!-- Left Form -->
						<form method="POST" action="{{route('edit.handle')}}" class="flex-1 space-y-4">
							@csrf
							<input type="hidden" name="id" value="{{ auth()->user()->id }}">
							<!-- Name -->
							<div>
								<label class="block text-sm text-gray-600 mb-1">
									Tên người dùng
								</label>
								<input type="text" name="username"
									class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 @error('username') ring-2 ring-red-500 @enderror"
									value="{{ auth()->user()->username }}">
								@error('username')
									<p class="text-red-600 text-sm">{{$message}}</p>
								@enderror
							</div>

							<!-- Email -->
							<div>
								<label class="block text-sm text-gray-600 mb-1">
									Email
								</label>
								<input type="email" name="email"
									class="w-full border rounded-lg px-3 py-2 bg-gray-100 cursor-not-allowed"
									value="{{ auth()->user()->email }}" disabled>
							</div>

							<!-- Phone -->
							<div>
								<label class="block text-sm text-gray-600 mb-1">
									Số điện thoại
								</label>
								<input type="text" name="phone"
									class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 @error('phone') ring-2 ring-red-500 @enderror"
									value="{{ auth()->user()->phone }}" placeholder="Nhập số điện thoại">
								@error('phone')
									<p class="text-red-600 text-sm">{{$message}}</p>
								@enderror
							</div>

							<!-- Error message -->
							@if(session('error'))
								<p class="bg-red-200 text-red-700 p-2 rounded">
									{{session('error')}}
								</p>
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

							<!-- Submit -->
							<div>
								<button type="submit"
									class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">
									Lưu thay đổi
								</button>
							</div>

						</form>

						<!-- Right Avatar -->
						<div class="w-[250px] flex flex-col items-center gap-4 border-l pl-6">

							<img src="{{ auth()->user()->avatar
									? auth()->user()->avatar
									: 'https://via.placeholder.com/120' }}" class="w-[120px] h-[120px] rounded-full object-cover border">

							<button class="px-4 py-2 border rounded-lg hover:bg-gray-100">
								Chọn ảnh
							</button>

							<p class="text-xs text-gray-500 text-center">
								Dung lượng tối đa 1MB <br>
								Định dạng: JPEG, PNG
							</p>

						</div>

					</div>

				</div>

			</div>
		</div>
	</div>

</x-layout>