<div>
	<p class="text-[2.5rem] pl-[5rem] pr-[5rem] p-4">Sản phẩm tái chế</p>
</div>
<!--  -->
<div class="flex flex-row justify-between items-center p-4 pl-[5rem] pr-[5rem]">
	<div class="flex flex-row justify-between items-center gap-4">
		<div>
			<p>Lọc sản phẩm:</p>
		</div>
		<!-- danh muc -->

		<div>
			<details class="relative">
				<summary>Danh mục</summary>
				<div class="absolute border-1 p-2 bg-white">
					@foreach ($categories as $category)
					<a href="{{ route('product.index', 
					['categories'=> array_unique(array_merge($selectedCategoryIds 
												?? [], [$category->id])) ])}}" 
					class="p-1 hover:text-white hover:bg-green-500 cursor-pointer">		{{ $category->name}}
					</a>
					@endforeach
				</div>
			</details>
		</div>

		<!-- gia -->

		<div>
			<details id='filter-price' class="relative">
				<summary>Giá</summary>
				<form method="GET" action="{{ route('product.index',['categories'=>$selectedCategoryIds]) }}">
				<dialog id='dialog-filter-price' class="border-1 border-gray-500">
					<div class="p-2 border-b-1">
						<div class="flex flex-row justify-between ">
							<p class="">Giá thấp nhất là @formatPrice($lowestPrice)</p>
							<a href="{{route('product.index',array_merge(
							['categories'=> $selectedCategoryIds ?? [] ], 
							['selected_price_to'=>null,
							'selected_frice_from'=>null]) )}}">
								<p class="underline">Làm mới</p>
							</a>
						</div>
						<p class="">Giá cao nhất là @formatPrice($highestPrice)</p>
					</div>

						
						<div class="flex flex-row justify-center items-center gap-4 p-2">
							<div class="flex flex-col justify-start items-center gap-1">
								<p>Từ</p>
								<input class="border-1 rounded-[1rem]" type="number" name="selected_price_from" min='0'>
							</div>
							<div class="flex flex-col justify-start items-center gap-1">
								<p>Đến</p>
								<input class="border-1 rounded-[1rem]" type="number" name="selected_price_to" min='0'>
							</div>
						</div>

				</dialog>
				</form>
			</details>
		</div>
	</div>

	<!-- sap xep -->

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

<!-- loc da chon  -->
@if ($selectedCategories->isNotEmpty())
<div class="flex flex-row justify-start items-center gap-4 pl-[5rem] pr-[5rem] pt-4 pb-4">
	@foreach ($selectedCategories as $selectedCategory)
	<p class="border-1 rounded-[2rem] pl-2 pr-2 cursor-pointer">
		{{ $selectedCategory->name }}
		<a href="{{ route('product.index',
		['categories'=>array_diff($selectedCategoryIds,
								[$selectedCategory->id]) ]) }}">
			 <i class='bx bx-x'></i>
		</a>
	</p>
	@endforeach

	@if ($selectedPrice['to'] || $selectedPrice['from']){
	<p class="border-1 rounded-[2rem] pl-2 pr-2 cursor-pointer">
		@formatPrice($selectedPrice['to']) - @formatPrice($selectedPrice['from'])
		<a href="{{route('product.index', array_merge(
		['categories'=> $selectedCategoryIds],
		['selected_price_to'=>null,
		'selected_price_from'=>null] ))}}">
			 <i class='bx bx-x'></i>			 
		</a>
	</p>		
	}
	@endif
	<a href="{{ route('product.index') }}"><p class="underline border-1 rounded-[2rem] pl-2 pr-2 cursor-pointer">Xóa tất cả</p></a>
</div>
@endif