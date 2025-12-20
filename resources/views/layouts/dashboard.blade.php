<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Fleur Parfume</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-60 bg-gray-900 text-white flex flex-col p-6">
            <h2 class="text-xl font-bold mb-10">Fleur Parfume</h2>

            <nav class="space-y-4 text-sm">
                <a href="{{ route('dashboard') }}"
                    class="block text-gray-300 hover:text-white">
                    Dashboard
                </a>

                <a href="{{ route('products.index') }}"
                    class="block text-gray-300 hover:text-white">
                    Produk
                </a>

                <a href="#"
                    class="block text-gray-300 hover:text-white">
                    Pesanan
                </a>

                <a href="#"
                    class="block text-gray-300 hover:text-white">
                    Pengaturan
                </a>
            </nav>

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

            <!-- NAVBAR -->
            <header class="bg-white shadow px-6 py-4">
                <span class="text-gray-700 font-medium">
                    Halo, ADMINNNN
                </span>
            </header>

            <!-- MAIN CONTENT -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>

        </div>
    </div>

    <script>
        function confirmLogout() {
            return confirm('Apakah Anda yakin ingin keluar dari dashboard admin?');
        }
    </script>

</body>

</html>
