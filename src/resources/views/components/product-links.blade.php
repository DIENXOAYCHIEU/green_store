<div class="flex flex-row justify-center items-center p-[3rem]">
	@if ($products->isNotEmpty())
	<nav>
		<ul class="pagination items-center">
			{{-- pre --}}
			@if ($products->onFirstPage())
			<li class="disabled">
				<i class='bx bx-chevron-left' ></i>
			</li>
			@else
			<li>
				<a href="{{$products->previousPageUrl()}}">
					<i class='bx bx-chevron-left' ></i>
				</a>
			</li>
			@endif

			{{-- page num --}}
			<li class="border-2 p-2 rounded-[0.3rem] border-gray-400">
				<input id="page-of-products" data-current='{{$products->currentPage()}}' data-last="{{$products->lastPage()}}" type="text" name="page" class=" w-[4rem] text-center">
				/ {{$products->lastPage()}}
			</li>
			{{-- next --}}
			@if ($products->hasMorePages())
			<li>
				<a href="{{$products->nextPageUrl()}}">
					<i class='bx bx-chevron-right' ></i>
				</a>
			</li>
			@else
			<li class="disabled">
				<i class='bx bx-chevron-right' ></i>
			</li>
			@endif

		</ul>
	</nav>
	@else
	<p class="text-gray-500 italic text-[1.3rem]">Không tìm thấy sản phẩm</p>
	@endif
</div>