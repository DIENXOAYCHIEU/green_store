<div class="w-[16rem] border-gray-400 border rounded-[0.6rem] hover:text-blue-600 hover:italic">
	<a href="{{route('product.show', ['product'=>$product->id])}}" class="flex flex-col gap-3">
		<div class="relative">
			<img class="h-[20rem] border-gray-400 rounded-[0.6rem] " src="{{ asset('storage/products/'.$product->picture) }}">
			<p class="text-white bg-black text-xs pl-[0.5rem] pr-[0.5rem] pt-[0.3rem] pb-[0.3rem] top-[1rem] right-[1rem] absolute rounded-[1rem]">{{$product->discount}}% OFF</p>
		</div>
		<div class="pl-[1rem] pr-[1rem] pb-[0.5rem]">
			<p >{{$product->name}}</p>
			<p class="italic text-yellow-500">
				<i class='bx bx-trending-up' ></i>
				{{$product->sold_quantity}} lượt mua
			</p>
			@if ($product->discount!==0)
			<p class="pt-[0.5rem]">Giá gốc:
				<span class="line-through text-gray-500">@formatPrice($product->price)</span>
			</p>
			<p class="text-[1.2rem]">Giảm còn: @formatPrice($product->total_price)</p>
			@else
			<p class="text-[1.2rem]">Giảm bán: @formatPrice($product->total_price)</p>
			@endif
		</div>
	</a>
</div>