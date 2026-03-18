<dialog id='cart-popup' class="overflow-auto fixed z-5 w-full h-full inset-0 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" >		
	{{-- close button --}}
	<div class=" flex flex-row border-b-1 border-gray-300 p-4 pl-[2rem] justify-between items-center">
		<p class="md:text-[1.3rem] font-bold">Giỏ hàng của bạn</p>
		<button id="cart-close" class="flex items-center justify-center cursor-pointer">
			<i class='md:text-[3rem] bx bx-x'></i>
		</button>
	</div>

	<form method="POST" id="cart-form" action="{{ route('product.checkout') }}">
		@csrf
		<input type="hidden" name="cart-input" id='cart-input'>
		{{-- list products in cart --}}
		<div id='cart-container' class="flex justify-start min-w-[720px] overflow-x-auto md:justify-center items-center pt-[2rem] pb-[2rem] ">
		</div>
		<div id="checkout-btn" class="flex justify-center items-center p-4">
		@if(Auth::check())
			<button type="submit" class="text-white bg-blue-600 p-2 rounded-[0.5rem] font-bold cursor-pointer w-[15rem]">THANH TOÁN</button>
		@else
			<p class="p-4 text-gray-500 italic text-[1.3rem]">Hãy đăng nhập để thanh toán</p>
		@endif
		</div>
	</form>
</dialog>