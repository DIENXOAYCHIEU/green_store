<div class="w-[16rem] border-gray-400 border rounded-[0.6rem] hover:text-blue-600 hover:italic">
	<a href="{{route('user.product.show', ['id'=>$product->id])}}" class="flex flex-col gap-3">
		<div class="relative">
			<img class="h-[20rem] border-gray-400 rounded-[0.6rem] " src="{{ $product->picture_url }}">
		</div>
		<div class="pl-[1rem] pr-[1rem] pb-[0.5rem]">
			<p class="font-bold">{{$product->name}}</p>
			<p class="italic text-yellow-500">
				<i class='bx bx-trending-up' ></i>
				{{$product->sold_quantity}} lượt mua
			</p>
			<p class="pt-[0.5rem] font-bold">Giá gốc:
				<span class="text-lg font-bold text-red-500">@formatPrice($product->price)</span>
			</p>
		</div>
	</a>
</div>