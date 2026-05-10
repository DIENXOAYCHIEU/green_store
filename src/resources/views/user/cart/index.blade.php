@vite('resources/js/app.js')
<x-layout>
    <div class="bg-gray-100 min-h-screen py-10">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white border border-gray-200 shadow-sm rounded-3xl">
                <div class="p-6 mt-5">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold">Giỏ hàng của bạn</h1>
                            <p class="mt-1 text-gray-600">Xem lại sản phẩm, điều chỉnh số lượng và tiến hành thanh toán.</p>
                        </div>
                        <div class="text-sm text-gray-500">Sản phẩm được lưu trong giỏ hàng của bạn.</div>
                    </div>

                    <form method="POST" action="{{ route('user.product.checkout') }}" id="cart-form">
                        @csrf
                        <input type="hidden" name="cart-input" id="cart-input">
                        <div id="cart-container" class="mt-8 overflow-x-auto"></div>
                        <div class="mt-6 flex justify-end">
                            <button id="checkout-btn"
                                    class="bg-blue-600 cursor-pointer hover:bg-blue-800 text-white font-bold py-2 px-4 rounded"
                                    type="submit">
                                Thanh toán
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
