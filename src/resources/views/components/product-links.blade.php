<div class="flex flex-row justify-center items-center p-[3rem]">
	@if ($products->isNotEmpty())
	<nav>
		<ul class="pagination">
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
			@for ($i = $start; $i <= $end; $i++)
			<li class="{{ $products->currentPage() == $i ? 'active' : ''}}">
				<a href="{{$products->url($i)}}">{{$i}}</a>
			</li>
			@endfor

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