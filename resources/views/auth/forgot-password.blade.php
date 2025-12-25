@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center pt-28 pb-24 bg-[#EFE3D0]">
    <div class="w-full max-w-md px-6">

        <!-- CARD -->
        <div class="bg-white p-10 rounded-3xl shadow-2xl">

            <!-- TITLE -->
            <div class="text-center mb-8">
                <h1 class="font-brand text-3xl text-[#3B2F2F] mb-2">
                    Forgot Password
                </h1>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Masukkan email Anda dan kami akan mengirimkan link
                    untuk mengatur ulang password akun Anda.
                </p>
            </div>

            <!-- FORM -->
            <form class="space-y-6">

                <div>
                    <label class="block text-sm mb-2 text-[#3B2F2F] font-medium">
                        Email Address
                    </label>
                    <input
                        type="email"
                        placeholder="you@example.com"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3
                               focus:outline-none focus:ring-2
                               focus:ring-[#C9A96A] focus:border-transparent"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-[#3B2F2F] hover:bg-[#2A211F]
                           text-white py-3 rounded-xl
                           tracking-widest transition duration-300">
                    SEND RESET LINK
                </button>

            </form>

            <!-- BACK TO LOGIN -->
            <div class="text-center mt-6">
                <a href="/login"
                   class="text-sm text-[#3B2F2F] hover:underline">
                    Back to Login
                </a>
            </div>

        </div>

    </div>
</section>
@endsection
