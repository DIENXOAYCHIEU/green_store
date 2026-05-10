@vite('resources/css/app.css')
<x-layout>

	<div class="bg-gray-100 min-h-screen py-6">

		<div class="max-w-[1200px] mx-auto flex gap-6">

			<x-account-sidebar />

			<div class="flex-1">

				<div class="flex flex-col gap-4">

					<div class="bg-white p-6 rounded-lg shadow">
						<h2 class="text-2xl font-bold mb-4">Lịch sử đơn hàng</h2>

						<form action="{{ route('user.purchase') }}" method="GET" class="mb-6 flex gap-4 flex-wrap items-end">
							<div class="flex-1 min-w-[200px]">
								<label class="block text-sm font-medium text-gray-700 mb-1">
									<i class="fa-solid fa-magnifying-glass mr-1"></i>Tìm kiếm
								</label>
								<input type="text" name="search" value="{{ $search }}" placeholder="Mã đơn, tên sản phẩm, tên người nhận..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
							</div>

							<div class="min-w-[150px]">
								<label class="block text-sm font-medium text-gray-700 mb-1">
									<i class="fa-solid fa-filter mr-1"></i>Trạng thái
								</label>
								<select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
									<option value="">Tất cả</option>
									@foreach($statuses as $st)
										<option value="{{ $st->id }}" {{ $selected_status == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="min-w-[150px]">
								<label class="block text-sm font-medium text-gray-700 mb-1">
									<i class="fa-solid fa-calendar-days mr-1"></i>Ngày đặt
								</label>
								<input type="date" name="date" value="{{ $date }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
							</div>

							<div class="flex gap-2">
								<button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
									<i class="fa-solid fa-magnifying-glass mr-1"></i>Lọc
								</button>
								<a href="{{ route('user.purchase') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
									<i class="fa-solid fa-arrows-rotate mr-1"></i>Đặt lại
								</a>
							</div>
						</form>

						@if($orders->count() > 0)
							<div class="overflow-x-auto">
								<table class="w-full table-auto border-collapse border border-gray-300">
									<thead class="bg-gray-50">
										<tr>
											<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Mã Đơn</th>
											<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Người nhận</th>
											<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Tổng tiền</th>
											<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Trạng thái</th>
											<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Ngày đặt</th>
											<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Thanh toán</th>
											<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Thao tác</th>
										</tr>
									</thead>
									<tbody class="bg-white divide-y divide-gray-200">
										@foreach($orders as $order)
										<tr class="hover:bg-gray-50">
											<td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border border-gray-300">
												#{{ $order->id }}
											</td>
											<td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 border border-gray-300">
												<div>
													<p class="font-medium">{{ $order->receivers->fullname ?? 'N/A' }}</p>
													<p class="text-gray-500 text-xs">{{ $order->receivers->phone ?? '' }}</p>
												</div>
											</td>
											<td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900 border border-gray-300">
												{{ number_format($order->total_price) }}đ
											</td>
											<td class="px-4 py-4 whitespace-nowrap border border-gray-300">
												<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
													@if($order->statuses->name == 'Đã giao')
														bg-green-100 text-green-800
													@elseif($order->statuses->name == 'Đang xử lý')
														bg-yellow-100 text-yellow-800
													@elseif($order->statuses->name == 'Đã hủy')
														bg-red-100 text-red-800
													@else
														bg-gray-100 text-gray-800
													@endif">
													{{ $order->statuses->name ?? 'Chưa xác định' }}
												</span>
											</td>
											<td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 border border-gray-300">
												{{ $order->created_at->format('d/m/Y H:i') }}
											</td>
											<td class="px-4 py-4 whitespace-nowrap border border-gray-300">
												@if($order->bills->count() > 0)
													<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
														Đã thanh toán
													</span>
												@else
													<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
														Chưa thanh toán
													</span>
												@endif
											</td>
											<td class="px-4 py-4 whitespace-nowrap text-sm font-medium border border-gray-300">
												<div class="flex space-x-2">
													<a href="{{ route('user.purchase.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">
														<i class="fa-solid fa-circle-info mr-1"></i>Xem chi tiết
													</a>
													@if($order->bills->count() > 0)
														<a href="{{ route('user.purchase.invoice', $order->id) }}" class="text-green-600 hover:text-green-900">
															<i class="fa-solid fa-file-invoice-dollar mr-1"></i>Hóa đơn
														</a>
													@endif
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>

							<div class="mt-4">
								{{ $orders->appends(request()->query())->links() }}
							</div>
						@else
							<div class="text-center py-8">
								<i class="fa-solid fa-shopping-cart text-gray-400 text-4xl mb-4"></i>
								<p class="text-gray-500">Bạn chưa có đơn hàng nào.</p>
							</div>
						@endif
					</div>

				</div>

			</div>

		</div>

	</div>
</x-layout>