@extends('layouts.app')

@section('content')

<!-- PROFILE PAGE -->
<section class="pt-28 pb-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <!-- TITLE -->
        <div class="text-center mb-16">
            <h1 class="font-brand text-4xl md:text-5xl text-[#3B2F2F] mb-4">
                Your Profile
            </h1>
            <p class="text-gray-600">
                Kelola informasi akun Anda di Fleure Perfumes
            </p>
        </div>

        <!-- PROFILE CARD -->
        <div class="flex justify-center">
            <div class="bg-white rounded-3xl p-10 w-full max-w-4xl
                        shadow-[0_25px_60px_rgba(0,0,0,0.15)]">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-start">

                    <!-- LEFT : AVATAR -->
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto rounded-full bg-[#E8D7B9]
                                    flex items-center justify-center text-4xl
                                    font-semibold text-[#3B2F2F] mb-4">
                            R
                        </div>

                        <h3 class="font-semibold text-lg text-[#3B2F2F]">
                            Rvelclaw
                        </h3>
                        <p class="text-sm text-gray-600 mb-3">
                            rvenz17@gmail.com
                        </p>

                        <span class="inline-block bg-[#F5EAD7] text-[#3B2F2F]
                                     px-4 py-1 rounded-full text-sm">
                            Member Fleure
                        </span>
                    </div>

                    <!-- RIGHT : FORM (BENTUK TETAP) -->
                    <div class="md:col-span-2">
                        <form class="space-y-6">

                            <div>
                                <label class="block mb-1 text-sm font-medium">
                                    Full Name
                                </label>
                                <input type="text"
                                    value="Rvelclaw"
                                    class="w-full border border-gray-300
                                           rounded-xl px-4 py-3">
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-medium">
                                    Email Address
                                </label>
                                <input type="email"
                                    value="rvenz17@gmail.com"
                                    class="w-full border border-gray-300
                                           rounded-xl px-4 py-3">
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-medium">
                                    Account Status
                                </label>
                                <input type="text"
                                    value="Active"
                                    disabled
                                    class="w-full border border-gray-300
                                           rounded-xl px-4 py-3 bg-gray-100">
                            </div>

                            <div class="flex gap-4 pt-4">
                                <button type="button"
                                    class="px-8 py-3 rounded-xl bg-[#3B2F2F]
                                           text-white hover:bg-[#2A211F] transition">
                                    Edit Profile
                                </button>

                                <button type="button"
                                    class="px-8 py-3 rounded-xl bg-red-500
                                           text-white hover:bg-red-600 transition">
                                    Logout
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

@endsection
