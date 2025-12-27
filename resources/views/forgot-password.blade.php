<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Fleure Parfume</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body { background-image: url('bg-auth.jpg'); background-size: cover; background-position: center; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-96 border border-gray-200">
        <h2 class="text-3xl font-bold text-center mb-2" style="color:#3B2F2F;">RESET PASSWORD</h2>
        <p class="text-center mb-6 text-sm" style="color:#5a4a30;">Masukkan email Anda untuk menerima link reset</p>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-6">
                <label class="font-semibold" style="color:#3B2F2F;">Email Address</label>
                <input type="email" name="email" class="w-full p-2 border rounded-lg mt-1 @error('email') border-red-500 @enderror" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-2 rounded-xl font-semibold text-white" style="background-color:#4B2E15;">
                Send Reset Link
            </button>

            <div class="text-center mt-4">
                <a href="/login" class="text-sm" style="color:#4B2E15;">Kembali ke Login</a>
            </div>
        </form>
    </div>
</body>
</html>