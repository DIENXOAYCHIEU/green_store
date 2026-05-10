<x-layout>
    <div class="bg-gray-100 min-h-screen py-10">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white border border-gray-200 shadow-sm rounded-3xl">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold">Thanh toán</h1>
                            <p class="mt-1 text-gray-600">Kiểm tra lại đơn hàng và điền thông tin giao hàng.</p>
                        </div>
                        <div class="text-sm text-gray-500">Số sản phẩm: {{ $products_in_cart->count() }}</div>
                    </div>

                    @if($products_in_cart->isEmpty())
                        <p class="mt-8 text-center text-gray-500 italic">Giỏ hàng của bạn đang trống.</p>
                    @else
                        @php
                            $total = 0;
                        @endphp

                        <form method="POST" action="{{ route('user.product.placeorder') }}" class="mt-8">
                            @csrf
                           <input
                                type="hidden"
                                name="cart-input"
                                value='@json($products_in_cart->map(fn($p) => [
                                    "id" => $p->id,
                                    "quantity" => $p->quantity
                                ]))'>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Order Summary -->
                                <div>
                                    <h2 class="text-xl font-semibold mb-4">Tóm tắt đơn hàng</h2>
                                    <div class="space-y-4">
                                        @foreach($products_in_cart as $product)
                                            @php
                                                $subTotal = $product->price * $product->quantity;
                                                $total += $subTotal;
                                            @endphp
                                            <div class="flex items-center space-x-4 border-b pb-4">
                                                <img src="{{ $product->picture_url }}" alt="{{ $product->name }}" class="w-16 h-16 object-contain">
                                                <div class="flex-1">
                                                    <h3 class="font-medium">{{ $product->name }}</h3>
                                                    <p class="text-sm text-gray-600">Số lượng: {{ $product->quantity }}</p>
                                                    <p class="text-sm font-semibold">{{ number_format($subTotal, 0, ',', '.') }} ₫</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-6 pt-4">
                                        <div class="flex justify-between text-lg font-bold">
                                            <span>Tổng cộng:</span>
                                            <span>{{ number_format($total, 0, ',', '.') }} ₫</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Customer Information -->
                                <div>
                                    <h2 class="text-xl font-semibold mb-4">Thông tin giao hàng</h2>
                                    <div class="space-y-4">
                                        @if(isset($saved_addresses) && $saved_addresses->isNotEmpty())
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Chọn liên hệ đã lưu</label>
                                                <select id="receiver-select" name="receiver_id"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                                    <option value="">Địa chỉ mới</option>
                                                    @foreach($saved_addresses as $address)
                                                        <option
                                                            value="{{ $address->id }}"
                                                            data-fullname="{{ $address->fullname }}"
                                                            data-phone="{{ $address->phone }}"
                                                            data-province="{{ $address->province }}"
                                                            data-district="{{ $address->district }}"
                                                            data-ward="{{ $address->ward }}"
                                                            data-full-address="{{ $address->full_address }}"
                                                            @if(old('receiver_id') == $address->id) selected @endif
                                                        >
                                                            {{ $address->fullname }} • {{ $address->phone }} • {{ \Illuminate\Support\Str::limit($address->full_address, 40) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Họ tên người nhận</label>
                                            <input type="text" name="receiver_name" required
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                                   value="{{ old('receiver_name', auth()->check() ? auth()->user()->username : '') }}">
                                            @error('receiver_name')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                                            <input type="tel" name="receiver_phone" required
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                                   value="{{ old('receiver_phone', auth()->check() ? auth()->user()->phone : '') }}">
                                            @error('receiver_phone')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                                            <input type="text" name="province" required
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                                   value="{{ old('province') }}">
                                            @error('province')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Quận/Huyện</label>
                                            <input type="text" name="district" required
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                                   value="{{ old('district') }}">
                                            @error('district')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Phường/Xã</label>
                                            <input type="text" name="ward" required
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                                   value="{{ old('ward') }}">
                                            @error('ward')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ chi tiết</label>
                                            <textarea name="full_address" rows="3" required
                                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                                      placeholder="Số nhà, tên đường...">{{ old('full_address') }}</textarea>
                                            @error('full_address')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Ghi chú (tùy chọn)</label>
                                            <textarea name="note" rows="2"
                                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                                      placeholder="Ghi chú về đơn hàng...">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <a href="{{ route('user.cart') }}" class="inline-flex items-center justify-center rounded-full border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 cursor-pointer">Quay lại giỏ hàng</a>
                                <button type="submit" class="inline-flex items-center justify-center rounded-full bg-green-600 px-8 py-3 text-sm font-semibold text-white hover:bg-green-700 cursor-pointer">
                                    <i class='bx bx-credit-card mr-2'></i>
                                    Xác nhận thanh toán
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const receiverSelect = document.getElementById('receiver-select');
            const fields = {
                receiver_name: document.querySelector('input[name="receiver_name"]'),
                receiver_phone: document.querySelector('input[name="receiver_phone"]'),
                province: document.querySelector('input[name="province"]'),
                district: document.querySelector('input[name="district"]'),
                ward: document.querySelector('input[name="ward"]'),
                full_address: document.querySelector('textarea[name="full_address"]'),
            };

            if (!receiverSelect) {
                return;
            }

            const resetValues = () => {
                fields.receiver_name.value = '{{ addslashes(old('receiver_name', auth()->check() ? auth()->user()->username : '')) }}';
                fields.receiver_phone.value = '{{ addslashes(old('receiver_phone', auth()->check() ? auth()->user()->phone : '')) }}';
                fields.province.value = '{{ addslashes(old('province')) }}';
                fields.district.value = '{{ addslashes(old('district')) }}';
                fields.ward.value = '{{ addslashes(old('ward')) }}';
                fields.full_address.value = '{{ addslashes(old('full_address')) }}';
            };

            receiverSelect.addEventListener('change', function () {
                const selectedOption = receiverSelect.selectedOptions[0];
                if (!selectedOption || !selectedOption.value) {
                    resetValues();
                    return;
                }

                fields.receiver_name.value = selectedOption.dataset.fullname || '';
                fields.receiver_phone.value = selectedOption.dataset.phone || '';
                fields.province.value = selectedOption.dataset.province || '';
                fields.district.value = selectedOption.dataset.district || '';
                fields.ward.value = selectedOption.dataset.ward || '';
                fields.full_address.value = selectedOption.dataset.fullAddress || '';
            });

            if (receiverSelect.value) {
                receiverSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-layout>
