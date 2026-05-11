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
