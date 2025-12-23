<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Fleur Parfume</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Responsif MOBILE LAYOUT MODE -->
    <header class="md:hidden bg-gray-900 text-white px-4 py-3 relative">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-lg">Fleur Parfume</h2>
                <span class="text-xs text-gray-300">Halo, ADMINNN</span>
            </div>

            <!-- Toggle -->
            <input type="checkbox" id="menu-toggle" class="hidden peer">
            <label for="menu-toggle" class="cursor-pointer text-2xl select-none">
                ☰
            </label>
        </div>

        <!-- Mobile Menu -->
        <nav
            class="hidden peer-checked:block absolute left-0 top-full w-full
               bg-gray-900 text-sm text-gray-300 border-t border-gray-800 z-50">
            <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-gray-800">Dashboard</a>
            <a href="{{ route('products.index') }}" class="block px-6 py-3 hover:bg-gray-800">Produk</a>
            <a href="{{ route('pesanan.index') }}" class="block px-6 py-3 hover:bg-gray-800">Pesanan</a>
            <a href="{{ route('settings.index') }}" class="block px-6 py-3 hover:bg-gray-800">Pengaturan</a>
        </nav>
    </header>

    <!-- Responsif DESKTOP LAYOUT MODE -->
    <div class="flex min-h-screen">

        <!-- SIDEBAR (DESKTOP ONLY) -->
        <aside class="hidden md:flex w-60 bg-gray-900 text-white flex-col p-6">
            <h2 class="text-xl font-bold mb-10">Fleur Parfume</h2>

            <nav class="space-y-4 text-sm">
                <a href="{{ route('dashboard') }}" class="block text-gray-300 hover:text-white">
                    Dashboard
                </a>
                <a href="{{ route('products.index') }}" class="block text-gray-300 hover:text-white">
                    Produk
                </a>
                <a href="{{ route('pesanan.index') }}" class="block text-gray-300 hover:text-white">
                    Pesanan
                </a>
                <a href="/dashboard/settings" class="block text-gray-300 hover:text-white">
                    Pengaturan
                </a>
            </nav>
            <br>
            <!-- download data user -->
            <h3>Menu Laporan</h3>
            <a href="{{ route('reports.users.download') }}" style="padding: 10px; background: green; color: white; text-decoration: none; border-radius: 5px;">
                Download PDF Daftar User
            </a>

            <!-- download data produk -->
            <div style="margin: 20px 0; border: 1px solid #ccc; padding: 15px;">
                <h4>Laporan Inventaris</h4>
                <a href="{{ route('reports.products.download') }}"
                    style="display: inline-block; padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">
                    Cetak Daftar Produk (PDF)
                </a>
            </div>

            <!-- LOGOUT -->
            <form action="{{ route('logout') }}"
                method="POST"
                onsubmit="return confirmLogout();"
                class="mt-auto">
                @csrf
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg text-sm">
                    Logout
                </button>
            </form>
        </aside>

        <!-- CONTENT -->
        <div class="flex-1 flex flex-col">

            <!-- DESKTOP HEADER -->
            <header class="hidden md:block bg-white shadow px-6 py-4">
                <span class="text-gray-700 font-medium">
                    Halo, ADMINNN
                </span>
            </header>

            <!-- MAIN CONTENT -->
            <main class="flex-1 p-4 md:p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>