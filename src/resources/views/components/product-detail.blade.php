{{-- notify when adding to cart success  --}}
<div id='cart-success' class="fixed top-[5rem] left-1/2 -translate-x-1/2 z-5 flex justify-center items-center">

</div>

{{-- --}}
<div class="flex flex-row justify-center pt-[4rem] pb-[4rem] pl-[1rem] pr-[1rem] items-start gap-[2rem]">
	{{-- img --}}
	<div class="w-1/2 flex justify-center">
		<div class="w-full">
			<img id="product-picture" class="w-full rounded-[0.6rem]" src="{{asset('storage/products/'.$product->picture)}}">
			<div class="w-[25rem] scrollbar-hidden overflow-x-auto flex flex-row gap-4 p-4  justify-center items-center">
				@foreach ($detailImages as $detailImage)
					<img class="h-[5rem] detail-image w-[5rem] rounded-[0.6rem] cursor-pointer" src="{{asset('storage/'.$detailImage->path)}}">
				@endforeach
			</div>
		</div>
	</div>

	{{-- attributes --}}
	<form method="POST" action="{{route('product.buynow')}}" class="w-1/2 p-4 ">
		@csrf
		<div class="flex flex-col gap-2 text-[1.2rem]">
			<p class="text-[2.2rem]">{{$product->name}}</p>
			<p class="italic text-yellow-500">
				<i class='bx bx-trending-up' ></i>
				{{$product->sold_quantity}} lượt mua
			</p>
			@if ($product->discount!==0)
			<p class="w-fit text-white bg-black text-xs pl-[0.5rem] pr-[0.5rem] pt-[0.3rem] pb-[0.3rem]  rounded-[1rem]">{{$product->discount}}% OFF</p>
			<p class="pt-[0.5rem]">Giá gốc:
				<span class="line-through text-gray-500">@formatPrice($product->price)</span>
			</p>
			<p class="text-[1.2rem]">Giảm còn: @formatPrice($product->total_price)</p>
			@else
			<p class="text-[1.2rem]">Giảm bán: @formatPrice($product->total_price)</p>
			@endif

			<div class="flex flex-col gap-2">
				<label for="quantity">Số lượng:</label>
				<input type="number" class="border-2 rounded-[0.6rem] p-2" min="1" value="1" name="quantity" id="quantity" required>
				@error('quantity')
				<p class="text-red-500 italic">
					<i class='bx bx-error-circle'></i>
					{{$message}}
				</p>
				@enderror
			</div>

			<div class="flex flex-col gap-4 p-[3rem]">
				<a  id="add-to-cart" data-product='@json($product)' class="flex	justify-center border-2 p-3 rounded-[0.6rem] font-bold cursor-pointer text-blue-600">Thêm vào giỏ</a>
				@if(Auth::check())
				<button id='buy-now' type='submit'  class="flex justify-center border-2 p-3 rounded-[0.6rem] font-bold text-white bg-blue-600 cursor-pointer">Mua ngay</button>
				@else
				<a id='buy-now' href="{{route('auth.login')}}"  class="flex justify-center border-2 p-3 rounded-[0.6rem] font-bold text-white bg-blue-600 cursor-pointer">Mua ngay</a>
				@endif
			</div>

			<p>Trọng lượng: @formatWeight($product->weight)</p>
			<p>Thông tin mô tả:</p>
			<p>{{$product->description}}</p>
		</div>
		<input type="text" name="product_id" value="{{$product->id}}" class="hidden">
	</form>
</div>
