<!-- LOGOUT MODAL -->
<div id="logoutModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="bg-[#F5EFE6] rounded-3xl shadow-2xl p-8 w-full max-w-sm text-center">

        <h2 class="font-brand text-2xl text-[#3B2F2F] mb-4">
            Logout
        </h2>

        <p class="text-gray-600 mb-6">
            Apakah Anda yakin ingin keluar dari akun?
        </p>

        <div class="flex gap-4 justify-center">
            <button onclick="closeLogoutModal()"
                    class="px-6 py-2 rounded-xl border border-[#3B2F2F]">
                Batal
            </button>

            <a href="/logout"
               class="px-6 py-2 rounded-xl bg-red-600 text-white">
                Keluar
            </a>
        </div>
    </div>
</div>
