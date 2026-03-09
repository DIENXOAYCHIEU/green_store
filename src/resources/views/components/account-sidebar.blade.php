<div class="w-[250px] bg-white rounded shadow-sm p-4 h-fit">

    <div class="flex items-center gap-3 border-b pb-4">

        <img src="{{asset('storage/avatars/' . Auth::user()->avatar)}}" class="w-12 h-12 rounded-full object-cover">

        <div>
            <p class="font-semibold">{{Auth::user()->username}}</p>
            <p class="text-sm text-gray-500">
                <a href="">Sửa hồ sơ</a>
            </p>
        </div>

    </div>

    <div class="mt-4 flex flex-col gap-3 text-sm">

        <a class="flex items-center gap-2 text-gray-700 hover:text-green-600 cursor-pointer">
            <i class='bx bx-bell'></i> Thông Báo
        </a>

        <a class="flex items-center gap-2 text-gray-700 hover:text-green-600 cursor-pointer">
            <i class='bx bx-user'></i> Tài Khoản Của Tôi
        </a>

        <a class="flex items-center gap-2 text-green-600 font-semibold cursor-pointer">
            <i class='bx bx-package'></i> Đơn Mua
        </a>

        <a class="flex items-center gap-2 text-gray-700 hover:text-green-600 cursor-pointer">
            <i class='bx bx-wallet'></i> Kho Voucher
        </a>

        <a class="flex items-center gap-2 text-gray-700 hover:text-green-600 cursor-pointer">
            <i class='bx bx-coin'></i> Green Xu
        </a>

    </div>

</div>