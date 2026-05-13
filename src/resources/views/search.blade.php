<x-layout>

    <div class="max-w-7xl mx-auto py-10 px-6">

        <!-- TITLE -->
        <h2 class="text-3xl font-bold mb-8">

            Kết quả tìm kiếm:
            <span class="text-green-600">
                "{{ $keyword }}"
            </span>

        </h2>

        <!-- PRODUCTS -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-[3rem]">

            @forelse ($products as $product)
                <x-product-card
                    :product="$product"
                />
            @empty

                <div class="col-span-4 text-center py-20">

                    <h3 class="text-2xl font-semibold text-gray-500">

                        Không tìm thấy sản phẩm

                    </h3>

                </div>

            @endforelse
        </div>
	<!-- links -->
	<x-product-links
		:products="$products"
	/>

    </div>

</x-layout>