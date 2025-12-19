<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="bg-white/80 rounded-lg shadow p-8 text-center">
            <h1 class="text-3xl font-bold mb-4">Selamat datang, {{ Auth::user()->name }}!</h1>
            <p class="mb-6">Ini adalah halaman pengguna. Kamu sudah login.</p>

            <form method="POST" action="/logout" class="inline">
                @csrf
                <button type="submit" class="rounded-md px-6 py-3 text-sm font-semibold text-white" style="background-color:#4B2E15;">
                    Logout
                </button>
            </form>
        </div>
    </div>
</x-layout>
