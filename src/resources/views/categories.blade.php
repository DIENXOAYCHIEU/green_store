<x-layout>

    <!-- Categories -->
    <section class="mb-14">

    <!-- TITLE -->
    <div class="flex items-center justify-between mb-8">

        <div>

            <h2 class="text-4xl font-bold text-gray-800 mb-2">
                Categories
            </h2>

            <p class="text-gray-500">
                Discover sustainable lifestyle collections
            </p>

        </div>

    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- CARD -->
        <div class="group relative h-[320px]
                    overflow-hidden rounded-[30px]
                    cursor-pointer">

            <!-- IMAGE -->
            <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6"
                 class="w-full h-full object-cover
                        group-hover:scale-110 transition duration-500">

            <!-- OVERLAY -->
            <div class="absolute inset-0
                        bg-gradient-to-t
                        from-black/70 via-black/20 to-transparent">

            </div>

            <!-- CONTENT -->
            <div class="absolute bottom-6 left-6 text-white">

                <h3 class="text-3xl font-bold mb-2">
                    Thiên nhiên
                </h3>

                <p class="text-sm text-white/80 mb-4">
                    Sản phẩm làm từ thiên nhiên
                </p>

                <a href="https://outmatch-salon-object.ngrok-free.dev/product?selected_category_ids%5B0%5D=2"
                    class="bg-white text-black
                    px-5 py-2 rounded-full
                    text-sm font-medium
                    hover:bg-green-500
                    hover:text-white transition">

                    Explore

                </a>

            </div>

        </div>

        <!-- CARD -->
        <div class="group relative h-[320px]
                    overflow-hidden rounded-[30px]
                    cursor-pointer">

            <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b"
                 class="w-full h-full object-cover
                        group-hover:scale-110 transition duration-500">

            <div class="absolute inset-0
                        bg-gradient-to-t
                        from-black/70 via-black/20 to-transparent">
            </div>

            <div class="absolute bottom-6 left-6 text-white">

                <h3 class="text-3xl font-bold mb-2">
                    Tái chế
                </h3>

                <p class="text-sm text-white/80 mb-4">
                    Sản phẩm tái chế
                </p>

                <a href="https://outmatch-salon-object.ngrok-free.dev/product?selected_category_ids%5B0%5D=1"
                    class="bg-white text-black
                    px-5 py-2 rounded-full
                    text-sm font-medium
                    hover:bg-green-500
                    hover:text-white transition">

                    Explore

</a>

            </div>

        </div>

        <!-- CARD -->
        <div class="group relative h-[320px]
                    overflow-hidden rounded-[30px]
                    cursor-pointer">

            <img src="https://images.unsplash.com/photo-1524592094714-0f0654e20314"
                 class="w-full h-full object-cover
                        group-hover:scale-110 transition duration-500">

            <div class="absolute inset-0
                        bg-gradient-to-t
                        from-black/70 via-black/20 to-transparent">
            </div>

            <div class="absolute bottom-6 left-6 text-white">

                <h3 class="text-3xl font-bold mb-2">
                    Tự hủy
                </h3>

                <p class="text-sm text-white/80 mb-4">
                    Sản phẩm tự hủy sinh học
                </p>

                <a href="https://outmatch-salon-object.ngrok-free.dev/product?selected_category_ids%5B0%5D=3"
                    class="bg-white text-black
                    px-5 py-2 rounded-full
                    text-sm font-medium
                    hover:bg-green-500
                    hover:text-white transition">

                    Explore

                </a>

            </div>

        </div>
    </div>

</section>

</x-layout>