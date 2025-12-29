<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Fleure Parfume</title>

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
            Create Account
        </h2>

        <p class="text-center mb-6 text-sm sm:text-base" style="color:#5a4a30;">
            Join Fleure Parfumes
        </p>

        @if($errors->any())
            <ul class="text-red-500 text-sm mb-3 space-y-1">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="mb-4">
                <label class="font-semibold text-sm sm:text-base" style="color:#3B2F2F;">
                    Nama Lengkap
                </label>
                <input type="text" name="name"
                    class="w-full p-2 sm:p-3 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-brown-400"
                    required>
            </div>

            <div class="mb-4">
                <label class="font-semibold text-sm sm:text-base" style="color:#3B2F2F;">
                    Email
                </label>
                <input type="email" name="email"
                    class="w-full p-2 sm:p-3 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-brown-400"
                    required>
            </div>

            <div class="mb-6">
                <label class="font-semibold text-sm sm:text-base" style="color:#3B2F2F;">
                    Password
                </label>
                <input type="password" name="password"
                    class="w-full p-2 sm:p-3 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-brown-400"
                    required>
            </div>

            <button
                class="w-full py-2 sm:py-3 rounded-xl font-semibold text-white transition hover:opacity-90"
                style="background-color:#4B2E15;">
                Register
            </button>

            <p class="text-center text-sm mt-4" style="color:#3B2F2F;">
                Sudah punya akun?
                <a href="/login" class="font-semibold" style="color:#4B2E15;">
                    Login
                </a>
            </p>
        </form>
    </div>

</body>

</html>
