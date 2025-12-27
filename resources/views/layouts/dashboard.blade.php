<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | Fleur Parfume</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-amber-50 via-rose-50 to-white text-slate-800">

        <!-- ✅ FIXED & TESTED MOBILE HEADER -->
    <header class="md:hidden bg-white/90 backdrop-blur border-b border-slate-200 shadow-sm relative z-50">
        <div class="flex items-center justify-between px-4 py-3">
            <div>
                <h2 class="font-semibold text-lg">Fleur Parfume Admin</h2>
                <span class="text-xs text-slate-500">Halo, ADMIN</span>
            </div>
        
            <!-- Checkbox Toggle -->
            <input type="checkbox" id="menu-toggle" class="hidden peer">
            <label for="menu-toggle"
                class="cursor-pointer text-2xl select-none text-slate-700 transition-transform duration-200 peer-checked:rotate-90">
                ☰
            </label>
        </div>
    
        <!-- ✅ Nav jadi SAUDARA LANGSUNG dari input (di parent yang sama) -->
        <nav
            class="max-h-0 overflow-hidden peer-checked:max-h-96 transition-all duration-300 ease-in-out
                   bg-white/95 backdrop-blur text-sm text-slate-700 border-t border-slate-200 shadow-lg">
            <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-rose-50">Dashboard</a>
            <a href="{{ route('products.index') }}" class="block px-6 py-3 hover:bg-rose-50">Produk</a>
            <a href="{{ route('admin.orders.index') }}" class="block px-6 py-3 hover:bg-rose-50">Pesanan</a>
            <a href="{{ route('dashboard.settings') }}" class="block px-6 py-3 hover:bg-rose-50">Pengaturan</a>
        </nav>
    </header>

    <!-- Responsif DESKTOP LAYOUT MODE -->
    <div class="flex min-h-screen">

        <!-- SIDEBAR (DESKTOP ONLY) -->
        <aside class="hidden md:flex w-72 bg-white/90 backdrop-blur border-r border-slate-200 flex-col p-6 shadow-lg">
            <div class="flex items-center gap-3 mb-10">
                <div
                    class="h-10 w-10 rounded-full bg-rose-100 text-rose-700 font-semibold flex items-center justify-center">
                    FP</div>
                <div>
                    <p class="text-xs text-slate-500">Admin Panel</p>
                    <h2 class="text-lg font-semibold text-slate-800">Fleur Parfume</h2>
                </div>
            </div>

            <nav class="space-y-2 text-sm">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 hover:bg-rose-50 hover:text-rose-700">
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('products.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 hover:bg-rose-50 hover:text-rose-700">
                    <span>Produk</span>
                </a>
                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 hover:bg-rose-50 hover:text-rose-700">
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('dashboard.settings') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 hover:bg-rose-50 hover:text-rose-700">
                    <span>Pengaturan Akses</span>
                </a>
            </nav>

            <div class="mt-8 space-y-3 text-sm">
                <p class="text-xs uppercase tracking-wide text-slate-500">Menu Laporan</p>
                <a href="{{ route('reports.users.download') }}"
                    class="block px-3 py-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100">
                    Download PDF Daftar User
                </a>
                <a href="{{ route('reports.products.download') }}"
                    class="block px-3 py-2 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100">
                    Cetak Daftar Produk (PDF)
                </a>
            </div>

            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmLogout();" class="mt-auto pt-6">
                @csrf
                <button type="submit"
                    class="w-full bg-rose-600 hover:bg-rose-700 text-white py-2 rounded-lg text-sm shadow">
                    Logout
                </button>
            </form>
        </aside>

        <!-- CONTENT -->
        <div class="flex-1 flex flex-col">

            <!-- DESKTOP HEADER -->
            <header class="hidden md:block bg-white/90 backdrop-blur border-b border-slate-200 px-6 py-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-500">Welcome back</p>
                        <p class="text-lg font-semibold text-slate-800">Halo, ADMIN</p>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-slate-500">
                        <span class="px-3 py-1 rounded-full bg-rose-50 text-rose-700">Admin</span>
                        <span class="px-3 py-1 rounded-full bg-slate-100">Live</span>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <main class="flex-1 p-4 md:p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>
