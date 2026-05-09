<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Green Store</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-gray-50">

	
	<!-- HEADER -->
    <header class="sticky top-0 z-50 bg-white shadow-sm">

    <!-- TOP HEADER -->
    <div class="flex items-center justify-between
                h-[75px] px-8
                border-b border-gray-200">

        <!-- LEFT -->
        <div class="flex items-center gap-3">

            <i class='bx bx-leaf text-green-600 text-4xl'></i>

            <h1 class="text-[28px] font-bold italic text-green-500">
                GREEN STORE
            </h1>

        </div>

        <!-- SEARCH -->
        <div class="flex-1 flex justify-center">

            <div class="flex items-center">

                <!-- INPUT -->
                <div class="w-[500px] h-[48px]
                            bg-white border border-gray-200
                            rounded-l-full px-5
                            flex items-center shadow-sm">

                    <input
                        type="text"
                        placeholder="Tìm sản phẩm xanh..."
                        class="w-full bg-transparent outline-none
                               text-sm text-gray-700
                               placeholder:text-gray-400"
                    >

                </div>

                <!-- BUTTON -->
                <button class="w-[100px] h-[48px]
                               bg-green-600
                               rounded-r-full
                               flex items-center justify-center
                               hover:bg-green-700 transition shadow-sm">

                    <i class='bx bx-search text-white text-xl'></i>

                    <span class="text-white relative -top-[1px] ml-1">
                        Tìm
                    </span>

                </button>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-6">

            <!-- CART -->
            <div class="relative">

                <i class='bx bx-cart text-[28px] cursor-pointer'></i>

                <span class="absolute -top-2 -right-2
                             bg-red-500 text-white
                             text-[10px]
                             px-1.5 rounded-full">

                    2

                </span>

            </div>

            <!-- USER -->
            <i class='bx bx-user-circle text-[32px] cursor-pointer'></i>

        </div>

    </div>

    <!-- MENU -->
    <div class="h-[55px]
                flex items-center justify-center
                border-b border-gray-200 bg-white">

        <nav class="flex items-center gap-12 text-[15px] font-medium">

    <!-- HOME -->
    <a href="/"
       class="relative group transition
       {{ request()->is('/') ? 'text-green-600' : 'hover:text-green-600' }}">

        Home

        <span class="absolute left-0 -bottom-[18px]
                     w-full h-[2px]
                     bg-green-600
                     origin-left transition-transform duration-300
                     {{ request()->is('/') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
        </span>

    </a>

    <!-- SHOP -->
    <a href="/product"
       class="relative group transition
       {{ request()->is('product') ? 'text-green-600' : 'hover:text-green-600' }}">

        Shop

        <span class="absolute left-0 -bottom-[18px]
                     w-full h-[2px]
                     bg-green-600
                     origin-left transition-transform duration-300
                     {{ request()->is('product') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
        </span>

    </a>
    <!-- CATEGORIES -->
<a href="/category"
   class="relative group transition
   {{ request()->is('category') ? 'text-green-600' : 'hover:text-green-600' }}">

    Categories

    <span class="absolute left-0 -bottom-[18px]
                 w-full h-[2px]
                 bg-green-600
                 origin-left transition-transform duration-300
                 {{ request()->is('category') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
    </span>

</a>
    <!-- CONTACT -->
    <a href="/contact"
       class="relative group transition
       {{ request()->is('contact') ? 'text-green-600' : 'hover:text-green-600' }}">

        Contact

        <span class="absolute left-0 -bottom-[18px]
                     w-full h-[2px]
                     bg-green-600
                     origin-left transition-transform duration-300
                     {{ request()->is('contact') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
        </span>

    </a>

</nav>

    </div>

    </header>
	<!-- MAIN CONTENT -->
	<div class="max-w-7xl mx-auto px-6 py-6">
		{{ $slot }}
	</div>

	<!-- FOOTER -->
	<div class="bg-white mt-10 p-10 border-t border-gray-300 grid grid-cols-1 md:grid-cols-3 gap-8">

		<div>
			<p class="text-lg font-bold mb-2">Về chúng tôi</p>
			<p class="text-sm text-gray-600">
				Green Store cung cấp sản phẩm thân thiện môi trường như ống hút tre, hộp đựng, chậu cây...
			</p>
		</div>

		<div>
			<p class="text-lg font-bold mb-2">Danh mục</p>
			<p>Inox</p>
			<p>Nature</p>
			<p>Recycling</p>
		</div>

		<div>
			<p class="text-lg font-bold mb-2">Liên hệ</p>
			<div class="flex gap-3 text-2xl">
				<i class='bx bxl-facebook-circle'></i>
				<i class='bx bxl-instagram'></i>
			</div>
			<p class="mt-2 text-sm">greenstore@gmail.com</p>
		</div>

	</div>

</body>
</html>