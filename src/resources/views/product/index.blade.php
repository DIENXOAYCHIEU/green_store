<x-layout>
	<div>
		<p class="text-[2.5rem] pl-[5rem] pr-[5rem] p-4">Sản phẩm tái chế</p>
	</div>
	<!--  -->
	<div class="flex flex-row justify-between items-center p-4 pl-[5rem] pr-[5rem]">
		<div class="flex flex-row justify-between items-center gap-4">
			<div>
				<p>Lọc sản phẩm:</p>
			</div>
			<div>
				<details class="relative">
					<summary>Danh mục</summary>
					<div class="absolute border-1 p-2 bg-white">
						@foreach ($categories as $category)
						<div class="p-1 hover:text-white hover:bg-green-500 cursor-pointer">{{ $category->name}}</div>
						@endforeach
					</div>
				</details>
			</div>
			<div>
				<details id='filter-price' class="relative">
					<summary>Giá</summary>
					<dialog id='dialog-filter-price' class="border-1 border-gray-500">
						<div class="flex flex-row justify-between p-2 border-b-1">
							<p class="">Giá cao nhất là 9</p>
							<p class="underline">Làm mới</p>
						</div>
						<div class="flex flex-row justify-center items-center gap-4 p-2">
							<div class="flex flex-col justify-start items-center gap-1">
								<p>Từ</p>
								<input class="border-1 rounded-[1rem]" type="number" name="" min='0'>
							</div>
							<div class="flex flex-col justify-start items-center gap-1">
								<p>Đến</p>
								<input class="border-1 rounded-[1rem]" type="number" name="" min='0'>
							</div>

						</div>
					</dialog>
				</details>
			</div>
		</div>

		<div class="flex flex-row gap-4 justify-between items-center">
			<p>Sắp xếp:</p>
			<div class="border-1 rounded">
				<select class="p-1">
					<option>Mặc định</option>
					@foreach ($sortOptions as $sortOption)
					<option>{{ $sortOption['name']}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<!--  -->
	<div class="flex flex-row justify-start items-center gap-4 pl-[5rem] pr-[5rem] pt-4 pb-4">
		{{ $slot }}
		<!-- 
		<div><p class="border-1 rounded-[2rem] pl-2 pr-2 cursor-pointer">Tái chế <i class='bx bx-x'></i></p></div>
		<div><p class="border-1 rounded-[2rem] pl-2 pr-2 cursor-pointer">Tái chế <i class='bx bx-x'></i></p></div>
 -->
		<div><p class="underline border-1 rounded-[2rem] pl-2 pr-2 cursor-pointer">Xóa tất cả</p></div>
	</div>
</x-layout>