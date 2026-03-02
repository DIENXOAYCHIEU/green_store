<div class="pl-[4rem] pr-[4rem] pb-[4rem] flex flex-col">
	<p class="text-[1.3rem] mb-4 text-center text-white p-2 font-bold bg-amber-600">Đánh giá của khách hàng</p>
	@if($reviews->count()>0)
	@foreach($reviews as $review)
	<div class="border-t-1 border-gray-200 border-b-1">
		<div class="w-4/5 mx-auto pt-4 pb-4 flex flex-col gap-4">
			<div class="flex flex-row justify-between items-center">
				<div class="flex flex-row gap-2 justify-center items-center">
					<img class="w-[2rem] h-[2rem] rounded-full" src="{{asset('storage/avatars/avatar1.png' )}}">
					<p class="font-bold">{{$review->accounts->username}}</p>
				</div>
				<p class="text-gray-500">{{$review->created_at}}</p>
			</div>
			<div class="flex items-start justify-start ">
				<p>{{$review->content}}</p>
			</div>
		</div>
	</div>
	@endforeach
	<button type="button" id="read-more" class="cursor-pointer flex flex-row justify-center items-center mx-auto mt-4 mb-4 gap-1 border-1 p-2 w-2/10">
		Đọc thêm 
		<i class='bx bxs-down-arrow-alt'></i>
	</button>
	@else
	<p class="text-gray-500 text-[1.2rem] italic text-center">Chưa có đánh giá</p>
	@endif
</div>
