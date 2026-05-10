<x-layout>

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