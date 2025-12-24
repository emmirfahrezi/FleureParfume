@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-[#F5EFE6] pt-28 pb-24">
    <div class="w-full max-w-md px-6">

        <div class="bg-white rounded-3xl p-10
                    shadow-[0_25px_60px_rgba(0,0,0,0.15)]">

            <!-- TITLE -->
            <div class="text-center mb-8">
                <h1 class="font-brand text-3xl text-[#3B2F2F] mb-2">
                    Reset Password
                </h1>
                <p class="text-gray-600 text-sm">
                    Buat password baru untuk akun Anda
                </p>
            </div>

            <!-- FORM -->
            <form class="space-y-5">

                <div>
                    <label class="block text-sm mb-1 text-[#3B2F2F]">
                        New Password
                    </label>
                    <input type="password"
                        class="w-full border border-gray-300
                               rounded-xl px-4 py-3
                               focus:outline-none focus:ring-2
                               focus:ring-[#C9A96A]">
                </div>

                <div>
                    <label class="block text-sm mb-1 text-[#3B2F2F]">
                        Confirm Password
                    </label>
                    <input type="password"
                        class="w-full border border-gray-300
                               rounded-xl px-4 py-3
                               focus:outline-none focus:ring-2
                               focus:ring-[#C9A96A]">
                </div>

                <button type="submit"
                    class="w-full bg-[#3B2F2F] hover:bg-[#2A211F]
                           text-white py-3 rounded-xl
                           tracking-widest transition">
                    RESET PASSWORD
                </button>
            </form>

        </div>
    </div>
</section>
@endsection
