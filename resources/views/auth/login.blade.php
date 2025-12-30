<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Fleure Parfume</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('bg-auth.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <div class="bg-white w-full max-w-md p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-200">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-2" style="color:#3B2F2F;">
            FLEURE PARFUMES
        </h2>

        <p class="text-center mb-6 text-sm sm:text-base" style="color:#5a4a30;">
            Welcome, please sign in
        </p>


        @if ($errors->any())
            <div class="text-red-500 text-sm mb-3">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-4">
                <label class="font-semibold text-sm sm:text-base" style="color:#3B2F2F;">
                    Email
                </label>
                <input type="email" name="email"
                    class="w-full p-2 sm:p-3 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-brown-400"
                    required>
            </div>

            <div class="mb-4">
                <label class="font-semibold text-sm sm:text-base" style="color:#3B2F2F;">
                    Password
                </label>
                <input type="password" name="password"
                    class="w-full p-2 sm:p-3 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-brown-400"
                    required>
            </div>

            <div class="text-right mb-4">
                <a href="/forgot-password" class="text-sm underline" style="color:#4B2E15;">
                    Forgot your password?
                </a>
            </div>

            <button class="w-full py-2 sm:py-3 rounded-xl font-semibold text-white transition hover:opacity-90"
                style="background-color:#4B2E15;">
                Sign In
            </button>

            <p class="text-center text-sm mt-4" style="color:#3B2F2F;">
                Belum punya akun?
                <a href="/register" class="font-semibold" style="color:#4B2E15;">
                    Daftar
                </a>
            </p>
        </form>

        <!-- GOOGLE LOGIN -->
        <div class="mt-6">
            <a href="{{ route('google.login') }}"
                class="w-full flex items-center justify-center gap-2 border px-4 py-2 rounded-xl hover:bg-gray-100 transition">
                <img src="https://developers.google.com/identity/images/g-logo.png" width="18">
                <span class="text-sm sm:text-base">Login dengan Google</span>
            </a>
        </div>
    </div>

</body>

</html>
