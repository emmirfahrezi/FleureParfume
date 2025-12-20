<!DOCTYPE html>
<html>
<head>
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

<body class="min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-96 border border-gray-200">
        <h2 class="text-3xl font-bold text-center mb-2" style="color:#3B2F2F;">Create Account</h2>
        <p class="text-center mb-6" style="color:#5a4a30;">Join Fleure Parfumes</p>

        @if($errors->any())
            <ul class="text-red-500 text-sm mb-3">
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="mb-4">
                <label class="font-semibold" style="color:#3B2F2F;">Nama Lengkap</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg mt-1" required>
            </div>

            <div class="mb-4">
                <label class="font-semibold" style="color:#3B2F2F;">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded-lg mt-1" required>
            </div>

            <div class="mb-4">
                <label class="font-semibold" style="color:#3B2F2F;">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded-lg mt-1" required>
            </div>

            <button class="w-full py-2 rounded-xl font-semibold text-white"
                    style="background-color:#4B2E15;">
                Register
            </button>

            <p class="text-center text-sm mt-4" style="color:#3B2F2F;">
                Sudah punya akun?
                <a href="/login" class="font-semibold" style="color:#4B2E15;">Login</a>
            </p>
        </form>
    </div>

</body>
</html>
