<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Fleure Perfumes</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F5EFE6] text-[#3B2F2F]">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#2B1E16] text-white flex flex-col px-6 py-10 shadow-xl">

        <!-- LOGO -->
        <div class="mb-14 text-center">
            <h1 class="font-brand text-3xl tracking-[0.35em]">
                FLEURE
            </h1>
            <span class="font-brand text-xs tracking-[0.55em] text-[#D6B98C]">
                PERFUMES
            </span>
        </div>

        <!-- MENU -->
        <nav class="space-y-2 text-sm">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('dashboard')
               ? 'bg-[#8B5A2B] text-white shadow'
               : 'text-gray-300 hover:bg-[#6F4518]' }}">
                Dashboard
            </a>

            <a href="{{ route('products.index') }}"
               class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('products.*')
               ? 'bg-[#8B5A2B] text-white shadow'
               : 'text-gray-300 hover:bg-[#6F4518]' }}">
                Produk
            </a>

            <a href="#"
               class="block px-4 py-2 rounded-lg text-gray-300 hover:bg-[#6F4518]">
                Pesanan
            </a>

            <a href="#"
               class="block px-4 py-2 rounded-lg text-gray-300 hover:bg-[#6F4518]">
                Pengaturan
            </a>
        </nav>

    </aside>

    <!-- CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- TOP BAR -->
        <header class="bg-[#F1E5D1] px-10 py-5 shadow-sm">
            <span class="text-sm tracking-wide">
                Halo, <b>ADMINNNN</b>
            </span>
        </header>

        <!-- MAIN -->
        <main class="flex-1 p-10">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>
