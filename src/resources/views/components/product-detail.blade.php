{{-- notify when adding to cart success  --}}
<div id='cart-success' class="fixed top-[5rem] left-1/2 -translate-x-1/2 z-5 flex justify-center items-center">

</div>

{{-- --}}
<div class="flex flex-col md:flex-row justify-center pt-4 pb-4 md:pt-[4rem] md:pb-[4rem] pl-[1rem] pr-[1rem] md:items-start md:gap-[2rem]">
	{{-- img --}}
	<div class="w-9/10 md:w-1/2 m-auto mt-0 flex justify-center">
		<div class="w-full">
			<img id="product-picture" class="w-full rounded-[0.6rem]" src="{{ $product->picture_url }}">
			<div class="md:w-[25rem] scrollbar-hidden overflow-x-auto flex flex-row gap-4 p-4 justify-start md:justify-center items-center">
				@foreach ($detailImages as $detailImage)
					<img class="h-[5rem] detail-image w-[5rem] rounded-[0.6rem] cursor-pointer" src="{{asset('storage/products/'.$detailImage->path)}}">
				@endforeach
			</div>
		</div>
	</div>

	{{-- attributes --}}
	<form method="POST" action="{{route('user.product.buynow')}}" class="md:w-1/2 p-4 ">
		@csrf
		<div class="flex flex-col gap-2 md:text-[1.2rem]">
			<p class="md:text-[2.2rem]">{{$product->name}}</p>
			<p class="italic text-yellow-500">
				<i class='bx bx-trending-up' ></i>
				{{$product->sold_quantity}} lượt mua
			</p>
			<p class="text-[1.2rem]">Giá bán: @formatPrice($product->price)</p>

			<div class="flex flex-col gap-2">
				<label for="quantity">Số lượng:</label>
				<input type="number" class="border-2 rounded-[0.6rem] p-1 md:p-2" min="1" value="1" name="quantity" id="quantity" required>
				@error('quantity')
				<p class="text-red-500 italic">
					<i class='bx bx-error-circle'></i>
					{{$message}}
				</p>
				@enderror
			</div>

			<div class="flex flex-col gap-4 p-3 md:p-[3rem]">
				<button type="button" id="add-to-cart" data-product='@json($product)' data-user-id="{{ auth()->id() ?? 'guest' }}" class="flex justify-center border-2 p-3 rounded-[0.6rem] font-bold text-blue-600 cursor-pointer">Thêm vào giỏ hàng</button>
				@if(Auth::check())
				<button id='buy-now' type='submit'  class="flex justify-center border-2 p-3 rounded-[0.6rem] font-bold text-white bg-blue-600 cursor-pointer">Mua ngay</button>
				@else
				<a id='buy-now' href="{{route('login')}}"  class="flex justify-center border-2 p-3 rounded-[0.6rem] font-bold text-white bg-blue-600 cursor-pointer">Mua ngay</a>
				@endif
			</div>

			<p>Thông tin mô tả:</p>
			<p>{{$product->description}}</p>
		</div>
		<input type="text" name="product_id" value="{{$product->id}}" class="hidden">
	</form>
</div>
