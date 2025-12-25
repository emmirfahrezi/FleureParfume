<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Fleure Perfumes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .font-brand {
            font-family: 'Cormorant Garamond', serif;
        }
    </style>
</head>

<body class="bg-[#F5EFE6] text-[#3B2F2F]">

<!-- NAVBAR -->
@include('components.navbar')

<!-- CONTENT -->
<main>
    @yield('content')
    <!-- LOGOUT CONFIRM MODAL -->
    <div id="logoutModal"
        class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/40 backdrop-blur-sm">

        <div class="bg-[#F5EFE6] rounded-3xl shadow-2xl w-[90%] max-w-sm p-8 text-center">

            <h2 class="font-brand text-2xl text-[#3B2F2F] mb-3">
                Logout
            </h2>

            <p class="text-sm text-gray-700 mb-8">
                Apakah Anda yakin ingin keluar dari akun?
            </p>

            <div class="flex gap-4 justify-center">
                <!-- BATAL -->
                <button onclick="closeLogoutModal()"
                    class="px-6 py-3 rounded-xl border border-[#3B2F2F] text-[#3B2F2F] hover:bg-[#3B2F2F]/10 transition">
                    Batal
                </button>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-[#3B2F2F] text-white hover:bg-[#2A211F] transition">
                        Ya, Logout
                    </button>
                </form>
            </div>

        </div>
    </div>

</main>

<!-- FOOTER -->
 @include('components.footer')
 <script>
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
        document.getElementById('logoutModal').classList.add('flex');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.add('hidden');
        document.getElementById('logoutModal').classList.remove('flex');
    }
</script>
</body>
</html>
