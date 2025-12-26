@extends('layouts.app')

@section('content')
<section class="pt-28 pb-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-center mb-16">
            <h1 class="font-brand text-4xl md:text-5xl text-[#3B2F2F] mb-4">Your Profile</h1>
            <p class="text-gray-600">Informasi akun Fleure Perfumes Anda</p>
        </div>

        <div class="flex justify-center">
            <div class="bg-white rounded-3xl p-10 w-full max-w-4xl shadow-[0_25px_60px_rgba(0,0,0,0.15)]">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- AVATAR -->
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto rounded-full bg-[#E8D7B9] flex items-center justify-center text-4xl font-semibold text-[#3B2F2F] mb-4 overflow-hidden border-4 border-white shadow-lg">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>
                        <h3 class="font-semibold text-lg">{{ $user->name }}</h3>
                        <span class="inline-block bg-[#F5EAD7] text-[#3B2F2F] px-4 py-1 rounded-full text-xs">Member Fleure</span>
                    </div>

                    <!-- DETAIL -->
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <label class="text-sm text-gray-400">Full Name</label>
                            <p class="text-lg font-medium border-b pb-2 text-[#3B2F2F]">{{ $user->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-400">Email Address</label>
                            <p class="text-lg font-medium border-b pb-2 text-[#3B2F2F]">{{ $user->email }}</p>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <a href="{{ route('profile.edit') }}" class="px-8 py-3 rounded-xl bg-[#3B2F2F] text-white hover:bg-[#2A211F] transition">
                                Edit Profile
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-8 py-3 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection