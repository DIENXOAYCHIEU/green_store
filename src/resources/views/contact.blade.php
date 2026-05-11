<x-layout>

    <!-- HERO -->
    <section class="relative h-[400px]">

        <img
            src="https://images.unsplash.com/photo-1497436072909-60f360e1d4b1"
            class="w-full h-full object-cover"
        >

        <div class="absolute inset-0 bg-black/50
                    flex flex-col items-center
                    justify-center text-center">

            <h1 class="text-5xl font-bold text-white mb-4">
                About Green Store
            </h1>

            <p class="text-white text-lg max-w-2xl">
                Sustainable products for a greener future.
            </p>

        </div>

    </section>

    <!-- ABOUT -->
    <section class="max-w-7xl mx-auto py-20 px-6">

        <div class="grid grid-cols-2 gap-16 items-center">

            <!-- IMAGE -->
            <div>

                <img
                    src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a"
                    class="rounded-3xl shadow-xl"
                >

            </div>

            <!-- CONTENT -->
            <div>

                <h2 class="text-4xl font-bold mb-6">
                    Who We Are
                </h2>

                <p class="text-gray-600 leading-8 mb-6">

                    Green Store is an eco-friendly shopping platform
                    dedicated to providing sustainable and reusable
                    products that help reduce plastic waste and
                    protect the environment.

                </p>

                <p class="text-gray-600 leading-8 mb-6">

                    We believe that small lifestyle changes can create
                    a big impact on our planet. Our products are carefully
                    selected to support a greener, cleaner, and healthier future.

                </p>

                <button class="bg-green-600 text-white
                               px-8 py-3 rounded-full
                               hover:bg-green-700 transition">

                    Explore Products

                </button>

            </div>

        </div>

    </section>

    <!-- MISSION -->
    <section class="bg-green-50 py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">

                <h2 class="text-4xl font-bold mb-4">
                    Our Mission
                </h2>

                <p class="text-gray-600 max-w-3xl mx-auto leading-8">

                    Our mission is to encourage sustainable living by
                    making eco-friendly products accessible, affordable,
                    and stylish for everyone.

                </p>

            </div>

            <div class="grid grid-cols-3 gap-8">

                <!-- CARD -->
                <div class="bg-white p-8 rounded-3xl shadow text-center">

                    <div class="text-5xl mb-4">
                        🌱
                    </div>

                    <h3 class="text-2xl font-semibold mb-3">
                        Eco Friendly
                    </h3>

                    <p class="text-gray-600 leading-7">

                        Products designed to reduce environmental impact.

                    </p>

                </div>

                <!-- CARD -->
                <div class="bg-white p-8 rounded-3xl shadow text-center">

                    <div class="text-5xl mb-4">
                        ♻️
                    </div>

                    <h3 class="text-2xl font-semibold mb-3">
                        Reusable
                    </h3>

                    <p class="text-gray-600 leading-7">

                        Encouraging reusable alternatives over disposable items.

                    </p>

                </div>

                <!-- CARD -->
                <div class="bg-white p-8 rounded-3xl shadow text-center">

                    <div class="text-5xl mb-4">
                        🌍
                    </div>

                    <h3 class="text-2xl font-semibold mb-3">
                        Sustainable Future
                    </h3>

                    <p class="text-gray-600 leading-7">

                        Building a cleaner and greener world together.

                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- TOP -->
    <section class="mb-14 text-center">

        <h1 class="text-5xl font-bold mb-4">
            Contact Us
        </h1>

        <p class="text-gray-500 text-lg">
            We'd love to hear from you. Send us a message anytime.
        </p>

    </section>

    <!-- CONTACT -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        <!-- LEFT -->
        <div class="bg-white rounded-3xl p-10 shadow-sm">

            <h2 class="text-3xl font-bold mb-8">
                Get In Touch
            </h2>

            <!-- FORM -->
            <form class="space-y-6">

                <!-- NAME -->
                <div>

                    <label class="block mb-2 font-medium">
                        Full Name
                    </label>

                    <input
                        type="text"
                        placeholder="Enter your name"
                        class="w-full border border-gray-300
                               rounded-xl px-5 py-4
                               outline-none focus:border-green-500"
                    >

                </div>

                <!-- EMAIL -->
                <div>

                    <label class="block mb-2 font-medium">
                        Email Address
                    </label>

                    <input
                        type="email"
                        placeholder="Enter your email"
                        class="w-full border border-gray-300
                               rounded-xl px-5 py-4
                               outline-none focus:border-green-500"
                    >

                </div>

                <!-- SUBJECT -->
                <div>

                    <label class="block mb-2 font-medium">
                        Subject
                    </label>

                    <input
                        type="text"
                        placeholder="Subject"
                        class="w-full border border-gray-300
                               rounded-xl px-5 py-4
                               outline-none focus:border-green-500"
                    >

                </div>

                <!-- MESSAGE -->
                <div>

                    <label class="block mb-2 font-medium">
                        Message
                    </label>

                    <textarea
                        rows="6"
                        placeholder="Write your message..."
                        class="w-full border border-gray-300
                               rounded-xl px-5 py-4
                               outline-none focus:border-green-500">
                    </textarea>

                </div>

                <!-- BUTTON -->
                <button
                    class="bg-green-600 text-white
                           px-8 py-4 rounded-xl
                           hover:bg-green-700 transition">

                    Send Message

                </button>

            </form>

        </div>

        <!-- RIGHT -->
        <div class="bg-gradient-to-br from-green-700 to-green-500
                    rounded-3xl p-10 text-white">

            <h2 class="text-3xl font-bold mb-8">
                Contact Information
            </h2>

            <!-- ITEM -->
            <div class="space-y-8">

                <div class="flex items-start gap-4">

                    <div class="w-14 h-14 rounded-full
                                bg-white/20
                                flex items-center justify-center">

                        <i class='bx bx-map text-3xl'></i>

                    </div>

                    <div>

                        <h3 class="text-xl font-semibold mb-1">
                            Address
                        </h3>

                        <p class="text-white/90">
                            123 Green Street, Ho Chi Minh City, Vietnam
                        </p>

                    </div>

                </div>

                <div class="flex items-start gap-4">

                    <div class="w-14 h-14 rounded-full
                                bg-white/20
                                flex items-center justify-center">

                        <i class='bx bx-phone text-3xl'></i>

                    </div>

                    <div>

                        <h3 class="text-xl font-semibold mb-1">
                            Phone
                        </h3>

                        <p class="text-white/90">
                            +84 123 456 789
                        </p>

                    </div>

                </div>

                <div class="flex items-start gap-4">

                    <div class="w-14 h-14 rounded-full
                                bg-white/20
                                flex items-center justify-center">

                        <i class='bx bx-envelope text-3xl'></i>

                    </div>

                    <div>

                        <h3 class="text-xl font-semibold mb-1">
                            Email
                        </h3>

                        <p class="text-white/90">
                            greenstore@gmail.com
                        </p>

                    </div>

                </div>

            </div>

            <!-- SOCIAL -->
            <div class="mt-12">

                <h3 class="text-2xl font-semibold mb-4">
                    Follow Us
                </h3>

                <div class="flex gap-5 text-4xl">

                    <i class='bx bxl-facebook-circle cursor-pointer hover:scale-110 transition'></i>

                    <i class='bx bxl-instagram cursor-pointer hover:scale-110 transition'></i>

                    <i class='bx bxl-twitter cursor-pointer hover:scale-110 transition'></i>

                </div>

            </div>

        </div>

    </section>

</x-layout>