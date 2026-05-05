<x-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded-xl text-center">

        <h1 class="text-2xl font-bold text-gray-800">
            Xác minh email
        </h1>

        <p class="mt-4 text-gray-600">
            Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, vui lòng xác minh địa chỉ email
            của bạn bằng cách nhấp vào link chúng tôi vừa gửi.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-4 text-green-600 font-medium">
                Một link xác minh mới đã được gửi tới email của bạn!
            </div>
        @endif

        <!-- Resend Verification Email -->
        <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
            @csrf
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition">
                Gửi email xác minh
            </button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 underline">
                Đăng xuất
            </button>
        </form>

        @if(session('success'))
            <div id='message-success'
                class="text-center fixed top-[5rem] left-1/2 -translate-x-1/2 z-5 flex justify-center items-center">
                <p class="slide-down p-2 bg-white text-green-600 border-2 rounded-[0.5rem] border-green-600 font-bol">
                    {{session('success')}}
                </p>

            </div>
        @endif

    </div>
</x-layout>