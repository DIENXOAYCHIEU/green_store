<x-layout>

    <!-- Hero -->
    <section class="mb-8">

        <div class="relative w-full h-[400px] overflow-hidden rounded-2xl">

            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09"
                 class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/30 flex flex-col justify-center items-center text-white">

                <h2 class="text-4xl font-bold mb-4">
                    Green Store
                </h2>

                <p class="mb-4">
                    Giải pháp xanh cho cuộc sống hiện đại
                </p>

                <a href="/product"
                    class="bg-green-500 px-6 py-3 rounded-lg
                    hover:bg-green-600 transition">

                    Shop Now

                </a>

            </div>

        </div>

    </section>

    <!-- Categories -->
    <<section class="mb-14">

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
                    Nature
                </h3>

                <p class="text-sm text-white/80 mb-4">
                    Natural eco products
                </p>

                <a href="/product"
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
                    Recycling
                </h3>

                <p class="text-sm text-white/80 mb-4">
                    Reuse & recycle products
                </p>

                <button class="bg-white text-black
                               px-5 py-2 rounded-full
                               text-sm font-medium
                               hover:bg-green-500
                               hover:text-white transition">

                    Explore

                </button>

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
                    Inox
                </h3>

                <p class="text-sm text-white/80 mb-4">
                    Premium stainless products
                </p>

                <button class="bg-white text-black
                               px-5 py-2 rounded-full
                               text-sm font-medium
                               hover:bg-green-500
                               hover:text-white transition">

                    Explore

                </button>

            </div>

        </div>

        <!-- CARD -->
        <div class="group relative h-[320px]
                    overflow-hidden rounded-[30px]
                    cursor-pointer">

            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061"
                 class="w-full h-full object-cover
                        group-hover:scale-110 transition duration-500">

            <div class="absolute inset-0
                        bg-gradient-to-t
                        from-black/70 via-black/20 to-transparent">
            </div>

            <div class="absolute bottom-6 left-6 text-white">

                <h3 class="text-3xl font-bold mb-2">
                    Organic
                </h3>

                <p class="text-sm text-white/80 mb-4">
                    Healthy organic lifestyle
                </p>

                <button class="bg-white text-black
                               px-5 py-2 rounded-full
                               text-sm font-medium
                               hover:bg-green-500
                               hover:text-white transition">

                    Explore

                </button>

            </div>

        </div>

    </div>

</section>
    <!-- Banner -->
    <section class="bg-green-100 py-16 text-center rounded-xl mb-6">

        <h2 class="text-4xl font-bold mb-4">
            Fresh Organic Food
        </h2>

        <p class="mb-4">
            Healthy lifestyle starts here
        </p>

        <a href="/product"
            class="bg-green-600 text-white
            px-6 py-3 rounded-lg
            hover:bg-green-700 transition">

            Shop Now

        </a>

    </section>
    <section class="mt-10">

    <!-- TOP -->
    <div class="flex items-center justify-between mb-6">

        <h2 class="text-3xl font-bold">
            Featured Products
        </h2>

        <a href="/product"
           class="text-green-600 font-medium flex items-center gap-1
                  hover:text-green-700 transition">

            View All

            <i class='bx bx-right-arrow-alt text-xl'></i>

        </a>

    </div>

    <!-- PRODUCTS -->
    <div class="grid grid-cols-4 gap-6">

        @foreach ($products as $product)

            <x-product-card
                :product="$product"
            />

        @endforeach

    </div>

</section>
    <section class="mt-10">

    <div class="bg-gradient-to-r from-green-900 to-green-500
                rounded-[35px]
                px-16 py-10
                flex items-center justify-between">

        <!-- LEFT -->
        <div class="flex items-center gap-8">

            <!-- Icon -->
            <div class="w-24 h-24 rounded-full bg-green-500
                        flex items-center justify-center">

                <i class='bx bxs-leaf text-white text-5xl'></i>

            </div>

            <!-- Text -->
            <div>

                <h2 class="text-white text-5xl font-bold mb-3">
                    Start Your Green Journey
                </h2>

                <p class="text-white text-2xl">
                    Every choice you make creates a difference for the planet.
                </p>

            </div>

        </div>

        <!-- BUTTON -->
        <button class="bg-white text-green-800
                       px-14 py-6
                       rounded-full
                       text-2xl font-medium
                       flex items-center gap-4
                       hover:scale-105 transition">

            Explore Now

            <i class='bx bx-right-arrow-alt text-4xl'></i>

        </button>

    </div>

</section>

</x-layout>