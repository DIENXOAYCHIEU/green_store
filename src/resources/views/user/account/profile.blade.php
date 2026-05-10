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
						<div class="flex flex-col md:flex-row gap-10">

							<!-- Left Form -->
							<form method="POST" action="{{route('edit.handle')}}" class="flex-1 space-y-4 order-2 md:order-1">
								@csrf
								<input type="hidden" name="id" value="{{ auth()->user()->id }}">
								
								<!-- Name -->
								<div>
									<label class="block text-sm text-gray-600 mb-1">Tên người dùng</label>
									<input type="text" name="username"
										class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 @error('username') ring-2 ring-red-500 @enderror"
										value="{{ auth()->user()->username }}">
									@error('username')
										<p class="text-red-600 text-sm mt-1">{{$message}}</p>
									@enderror
								</div>

								<!-- Email -->
								<div>
									<label class="block text-sm text-gray-600 mb-1">Email</label>
									<input type="email" name="email"
										class="w-full border rounded-lg px-3 py-2 bg-gray-50 text-gray-500 cursor-not-allowed"
										value="{{ auth()->user()->email }}" disabled>
								</div>

								<!-- Phone -->
								<div>
									<label class="block text-sm text-gray-600 mb-1">Số điện thoại</label>
									<input type="text" name="phone"
										class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 @error('phone') ring-2 ring-red-500 @enderror"
										value="{{ auth()->user()->phone }}" placeholder="Nhập số điện thoại">
									@error('phone')
										<p class="text-red-600 text-sm mt-1">{{$message}}</p>
									@enderror
								</div>

								<!-- Feedback Messages -->
								@if(session('error'))
									<p class="bg-red-100 text-red-700 p-3 rounded-lg text-sm">
										{{session('error')}}
									</p>
								@endif

								@if(session('success'))
									<div id='message-success'
										class="fixed top-20 left-1/2 -translate-x-1/2 z-50">
										<p class="bg-white text-green-600 border-2 border-green-600 px-6 py-2 rounded-lg font-bold shadow-lg animate-bounce">
											{{session('success')}}
										</p>
									</div>
								@endif
								<div id="message-container"></div>

								<!-- Submit -->
								<div class="pt-2">
									<button type="submit"
										class="bg-green-500 hover:bg-green-600 text-white px-8 py-2.5 rounded-lg transition-colors font-medium">
										Lưu thay đổi
									</button>
								</div>
							</form>

							<!-- Right Avatar Upload -->
							<div class="w-full md:w-[280px] flex flex-col items-center gap-4 md:border-l md:pl-10 order-1 md:order-2">
								<div class="relative group">
									<img src="{{ auth()->user()->avatar_url }}" 
										id="avatar-preview"
										class="w-32 h-32 rounded-full object-cover border-4 border-gray-50 shadow-sm user-avatar">
								</div>

								<label class="cursor-pointer bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm transition-all shadow-sm mb-2">
									Chọn ảnh
									<input type="file" id="avatarInput" class="hidden" accept="image/png, image/jpeg">
								</label>
								
								<p class="text-[12px] text-gray-400 text-center leading-relaxed">
									Dung lượng tối đa 1 MB <br>
									Định dạng: .JPEG, .PNG
								</p>
								
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<script>
		document.getElementById('avatarInput').addEventListener('change', function () {
			let formData = new FormData();
			formData.append('avatar', this.files[0]);

			fetch("{{ route('avatar.handle') }}", {
				method: "POST",
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				body: formData
			})
			.then(res => res.json())
			.then(data => {
				if (data.success) {
					document.querySelector("img").src = data.url;

					document.querySelectorAll('.user-avatar').forEach(img => {
						img.src = data.url;
					});

					window.dispatchEvent(new CustomEvent('avatar-updated', {
						detail: { url: data.url }
					}));

					showMessage('success', 'Cập nhật ảnh đại diện thành công!');
				} else {
					showMessage('error', data.message);
				}
			})
			.catch(() => alert("Lỗi upload"));
		});

		function showMessage(type, message) {
			let container = document.getElementById('message-container');

			if (type === 'success') {
				container.innerHTML = `
					<div id="message-success"
						class="fixed top-20 left-1/2 -translate-x-1/2 z-50">
						<p class="bg-white text-green-600 border-2 border-green-600 px-6 py-2 rounded-lg font-bold shadow-lg animate-bounce">
							${message}
						</p>
					</div>
				`;
			} else {
				container.innerHTML = `
					<p class="bg-red-100 text-red-700 p-3 rounded-lg text-sm">
						${message}
					</p>
				`;
			}

			// auto hide sau 3s
			setTimeout(() => {
				container.innerHTML = '';
			}, 3000);
		}
	</script>
</x-layout>