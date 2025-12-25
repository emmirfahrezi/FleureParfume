<!-- AUTH MODAL -->
<div id="authModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="bg-[#F5EFE6] w-full max-w-md rounded-3xl shadow-2xl p-8 relative">

        <!-- CLOSE -->
        <button onclick="closeAuthModal()"
                class="absolute top-4 right-4 text-2xl text-[#3B2F2F]">
            &times;
        </button>

        <!-- TITLE -->
        <h2 id="authTitle"
            class="font-brand text-3xl text-center text-[#3B2F2F] mb-6">
            Login
        </h2>

        <!-- LOGIN FORM -->
        <form id="loginForm" class="space-y-5">
            <div>
                <label class="block mb-1">Email</label>
                <input type="email"
                       class="w-full border rounded-xl px-4 py-3">
            </div>

            <div>
                <label class="block mb-1">Password</label>
                <input type="password"
                       class="w-full border rounded-xl px-4 py-3">
            </div>

            <button class="w-full bg-[#3B2F2F] text-white py-3 rounded-xl">
                Sign In
            </button>

            <p class="text-sm text-center">
                Belum punya akun?
                <button type="button"
                        onclick="switchToRegister()"
                        class="font-semibold text-[#3B2F2F] underline">
                    Register
                </button>
            </p>
        </form>

        <!-- REGISTER FORM -->
        <form id="registerForm" class="space-y-5 hidden">
            <div>
                <label class="block mb-1">Full Name</label>
                <input type="text"
                       class="w-full border rounded-xl px-4 py-3">
            </div>

            <div>
                <label class="block mb-1">Email</label>
                <input type="email"
                       class="w-full border rounded-xl px-4 py-3">
            </div>

            <div>
                <label class="block mb-1">Password</label>
                <input type="password"
                       class="w-full border rounded-xl px-4 py-3">
            </div>

            <button class="w-full bg-[#3B2F2F] text-white py-3 rounded-xl">
                Register
            </button>

            <p class="text-sm text-center">
                Sudah punya akun?
                <button type="button"
                        onclick="switchToLogin()"
                        class="font-semibold text-[#3B2F2F] underline">
                    Login
                </button>
            </p>
        </form>

    </div>
</div>
