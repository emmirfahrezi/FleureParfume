@extends('layouts.app')

@section('content')
<section class="pt-28 pb-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-brand text-[#3B2F2F]">Edit Profil</h1>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-[0_20px_50px_rgba(0,0,0,0.1)]">
            <!-- Tambahkan enctype -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Input Foto -->
                <div class="flex flex-col items-center mb-6">
                    <div class="w-24 h-24 rounded-full bg-gray-100 mb-4 overflow-hidden border">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-2xl font-bold text-gray-400">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <label class="block">
                        <span class="sr-only">Pilih Foto</span>
                        <input type="file" name="profile_photo" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-[#F5EAD7] file:text-[#3B2F2F]
                            hover:file:bg-[#E8D7B9]">
                    </label>
                    @error('profile_photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#E8D7B9]">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#E8D7B9]">
                    </div>
                </div>

                <div class="pt-4 flex justify-center gap-4">
                    <button type="submit" class="px-10 py-3 rounded-xl bg-[#3B2F2F] text-white hover:bg-[#2A211F] transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('profile.show') }}" class="px-10 py-3 text-gray-500">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection