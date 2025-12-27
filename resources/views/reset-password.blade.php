<!DOCTYPE html>
<html>
<head>
    <title>New Password - Fleure Parfume</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body { background-image: url('{{ asset('bg-auth.jpg') }}'); background-size: cover; background-position: center; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-96 border border-gray-200">
        <h2 class="text-2xl font-bold text-center mb-6" style="color:#3B2F2F;">CREATE NEW PASSWORD</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label class="font-semibold" style="color:#3B2F2F;">Email Confirm</label>
                <input type="email" name="email" class="w-full p-2 border rounded-lg mt-1" required>
            </div>

            <div class="mb-4">
                <label class="font-semibold" style="color:#3B2F2F;">New Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded-lg mt-1" required placeholder="Minimal 8 karakter">
            </div>

            <div class="mb-6">
                <label class="font-semibold" style="color:#3B2F2F;">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="w-full p-2 border rounded-lg mt-1" required>
            </div>

            <button type="submit" class="w-full py-2 rounded-xl font-semibold text-white" style="background-color:#4B2E15;">
                Update Password
            </button>
        </form>
    </div>
</body>
</html>