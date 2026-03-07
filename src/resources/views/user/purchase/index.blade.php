<x-layout>

	<div class="bg-gray-100 min-h-screen py-6">

		<div class="max-w-[1200px] mx-auto flex gap-6">

			<!-- SIDEBAR -->
			<div class="w-[250px] bg-white rounded shadow-sm p-4 h-fit">

				<div class="flex items-center gap-3 border-b pb-4">

					<img src="{{asset('storage/avatars/' . Auth::user()->avatar)}}"
						class="w-12 h-12 rounded-full object-cover">

					<div>
						<p class="font-semibold">{{Auth::user()->username}}</p>
						<p class="text-sm text-gray-500">
							<a href="">Sửa hồ sơ</a>
						</p>

					</div>

				</div>

				<div class="mt-4 flex flex-col gap-3 text-sm">

					<a class="flex items-center gap-2 text-gray-700 hover:text-green-600 cursor-pointer">
						<i class='bx bx-bell'></i> Thông Báo
					</a>

					<a class="flex items-center gap-2 text-gray-700 hover:text-green-600 cursor-pointer">
						<i class='bx bx-user'></i> Tài Khoản Của Tôi
					</a>

					<a class="flex items-center gap-2 text-green-600 font-semibold cursor-pointer">
						<i class='bx bx-package'></i> Đơn Mua
					</a>

					<a class="flex items-center gap-2 text-gray-700 hover:text-green-600 cursor-pointer">
						<i class='bx bx-wallet'></i> Kho Voucher
					</a>

					<a class="flex items-center gap-2 text-gray-700 hover:text-green-600 cursor-pointer">
						<i class='bx bx-coin'></i> Green Xu
					</a>

				</div>

			</div>


			<!-- MAIN CONTENT -->
			<div class="flex-1">

				<!-- ORDER STATUS TABS -->
				<div class="bg-white rounded shadow-sm">

					<div class="flex text-sm border-b">
						<button
							class="px-6 py-3 border-b-2 border-green-500 text-green-600 font-semibold cursor-pointer">
							Tất cả
						</button>
						
						<button class="px-6 py-3 hover:text-green-600 cursor-pointer">
							Chờ thanh toán
						</button>

						<button class="px-6 py-3 hover:text-green-600 cursor-pointer">
							Vận chuyển
						</button>

						<button class="px-6 py-3 hover:text-green-600 cursor-pointer">
							Chờ giao hàng
						</button>

						<button class="px-6 py-3 hover:text-green-600 cursor-pointer">
							Hoàn thành
						</button>

						<button class="px-6 py-3 hover:text-green-600 cursor-pointer">
							Đã hủy
						</button>

					</div>


					<!-- SEARCH -->
					<div class="p-4 border-b">

						<input type="text"
							placeholder="Bạn có thể tìm kiếm theo tên Shop, ID đơn hàng hoặc Tên Sản phẩm"
							class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-200">

					</div>


					<!-- ORDER CARD -->
					<div class="p-4 border-b">

						<!-- shop -->
						<div class="flex justify-between items-center mb-3">

							<div class="flex items-center gap-2">

								<span class="bg-red-500 text-white text-xs px-2 py-1 rounded">
									Yêu thích
								</span>

								<p class="font-semibold">Green Store Official</p>

								<button class="text-sm border px-2 py-1 rounded hover:bg-gray-100">
									Chat
								</button>

								<button class="text-sm border px-2 py-1 rounded hover:bg-gray-100">
									Xem Shop
								</button>

							</div>

							<span class="text-green-600 font-semibold">
								HOÀN THÀNH
							</span>

						</div>


						<!-- product -->
						<div class="flex gap-4">

							<img src="https://picsum.photos/80" class="w-[80px] h-[80px] object-cover border rounded">

							<div class="flex-1">

								<p class="font-semibold">
									Ống hút tre thân thiện môi trường
								</p>

								<p class="text-sm text-gray-500">
									Phân loại: Nature
								</p>

								<p class="text-sm text-gray-500">
									x2
								</p>

							</div>

							<div class="text-right">

								<p class="text-gray-500 line-through text-sm">
									150.000đ
								</p>

								<p class="text-red-500 font-semibold">
									120.000đ
								</p>

							</div>

						</div>


						<!-- total + actions -->
						<div class="flex justify-between items-center mt-4 border-t pt-4">

							<p class="text-sm text-gray-600">
								Thành tiền:
								<span class="text-red-500 text-lg font-semibold">
									240.000đ
								</span>
							</p>

							<div class="flex gap-3">

								<button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
									Đánh Giá
								</button>

								<button class="border px-4 py-2 rounded hover:bg-gray-100">
									Yêu cầu trả hàng
								</button>

							</div>

						</div>

					</div>


				</div>

			</div>

		</div>

	</div>

</x-layout>