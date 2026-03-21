<div class="pl-2 pr-2 pb-3 md:pl-[4rem] md:pr-[4rem] md:pb-[4rem] flex gap-4 flex-col">
	<p class="md:text-[1.3rem] mb-4 text-center text-white p-2 font-bold bg-amber-600">Đánh giá của khách hàng ({{$reviews->total()}} lượt)</p>
	@if($reviews->count()>0)
	<div id="reivews-container">
		@foreach($reviews as $review)
		<div class="border-t-1 border-gray-200 border-b-1">
			<div class="w-4/5 mx-auto pt-4 pb-4 flex flex-col gap-4">
				<div class="flex flex-row flex-wrap justify-between items-center">
					<div class="flex flex-row gap-2 justify-center items-center">
						<img class="w-[2rem] h-[2rem] rounded-full" src="{{asset('storage/avatars/' . $review->accounts->avatar )}}">
						<p class="font-bold">{{$review->accounts->username}}</p>
					</div>
					<p class="text-gray-500">{{$review->created_at}}</p>
				</div>
				<div class="flex items-start justify-start ">
					<p class='text-container' data-text='{{$review->content}}'>
					</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
		@if($reviews->hasMorePages())
		<a href="{{$reviews->url($reviews->currentPage()+1)}}" id="read-more-review" data-page='2' class="cursor-pointer flex flex-row justify-center items-center mx-auto mt-4 mb-4 gap-1 border-1 p-2 w-2/10">
			Đọc thêm 
			<i class='bx bxs-down-arrow-alt'></i>
		</a>
		@endif
	@else
	<p class="text-gray-500 text-[1.2rem] italic text-center">Chưa có đánh giá</p>
	@endif
	@if(Auth::check())
	<form method="POST" action="{{route('review.store')}}" class="flex flex-row gap-4 justify-center items-start">
		@csrf
		<div>
			<img src="{{asset('storage/avatars/' . Auth::user()->avatar)}}" class="w-[2rem] h-[2rem] rounded-full border-1 border-gray-200">
		</div>
		<div class="w-2/3">
			<textarea id="users-review" name='review' class="w-full overflow-hidden p-4 border-1 rounded-[0.8rem]" placeholder="Để lại đánh giá"></textarea>
		</div>
		<div>
			<button type="submit" class="border-1 rounded-full w-[2rem] h-[2rem] cursor-pointer bg-blue-600 text-white">
				<i class='bx bx-paper-plane'></i>
			</button>
		</div>

		<input type="text" value="{{$product->id}}" name="product_id" class="hidden">
	</form>
	@endif
</div>

@if(session('error'))
<div id='message-success' class="fixed top-[5rem] left-1/2 -translate-x-1/2 z-5 flex justify-center items-center">
	<p class="slide-down p-2 bg-white text-orange-600 border-2 rounded-[0.5rem] border-orange-600 font-bol">
		{{session('error')}}
	</p>

</div>
@endif
