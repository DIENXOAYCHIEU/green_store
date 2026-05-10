<div class="w-[250px] bg-white rounded shadow-sm p-4 h-fit">

    <div class="flex items-center gap-3 border-b pb-4">

        <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 user-avatar">
            <i class='text-[1.5rem] md:text-[2.5rem] bx bx-user-circle'></i>
        </div>

        <div>
            <p class="font-semibold">{{Auth::user()->username}}</p>
            <p class="text-sm text-gray-500">
                <a href="{{ route('user.profile') }}">Sửa hồ sơ</a>
            </p>
        </div>

    </div>

    <div class="mt-4 flex flex-col gap-3 text-sm">

        <div class="mt-4 flex flex-col gap-3 text-sm">
            <a href="{{ route('user.profile') }}"
                class="flex items-center gap-2 cursor-pointer
        {{ request()->routeIs('user.profile') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">
                <i class='bx bx-user'></i> Tài Khoản Của Tôi
            </a>

            <a href="{{ route('user.purchase') }}"
                class="flex items-center gap-2 cursor-pointer
        {{ request()->routeIs('user.purchase*') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">
                <i class='bx bx-package'></i> Đơn Mua
            </a>
        </div>

    </div>

</div>