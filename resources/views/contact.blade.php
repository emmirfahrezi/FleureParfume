@extends('layouts.app')

@section('content')

<!-- HERO SECTION (DI BAWAH NAVBAR) -->
<section class="w-full">
    <div class="relative w-full h-[420px] overflow-hidden">

        <!-- HERO IMAGE -->
        <img
            src="{{ asset('fleure-contact.jpg') }}"
            alt="Contact Fleure Perfumes"
            class="w-full h-full object-cover"
        >

        <!-- OVERLAY -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- TEXT -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
            <h1 class="font-cormorant text-4xl md:text-5xl text-white mb-4 !important">
                Contact Us
            </h1>

            <p class="max-w-2xl text-white/90">
                Kami siap membantu Anda menemukan parfum yang mencerminkan karakter
                dan gaya hidup Anda. Jangan ragu untuk menghubungi kami.
            </p>
        </div>
    </div>
</section>

<!-- CONTACT CONTENT -->
<section class="bg-[#F5EAD7] py-20">
    <div class="max-w-6xl mx-auto px-6">

        <!-- GRID INFO + FORM -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

            <!-- LEFT INFO -->
            <div class="space-y-8">
                <div>
                    <h3 class="font-semibold text-lg text-[#3B2F2F] mb-2">
                        Store Address
                    </h3>
                    <p class="text-gray-700">
                        Fleur Perfumes Boutique<br>
                        Jl. Elegance No. 88<br>
                        Bandung, Indonesia
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-lg text-[#3B2F2F] mb-2">
                        Contact
                    </h3>
                    <p class="text-gray-700">
                        Email: support@fleureperfumes.com<br>
                        Phone: +62 812 3456 7890
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-lg text-[#3B2F2F] mb-2">
                        Opening Hours
                    </h3>
                    <p class="text-gray-700">
                        Monday – Friday: 09.00 – 18.00<br>
                        Saturday: 10.00 – 16.00
                    </p>
                </div>
            </div>

            <!-- FORM -->
            <div class="flex justify-end">
                <div class="bg-white rounded-3xl shadow-xl p-8 w-full max-w-md">
                    @if(session('success'))
                        <div class="mb-4 p-3 rounded-xl bg-emerald-100 text-emerald-800 text-center font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="space-y-5" method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <div>
                            <label class="block mb-1 text-sm">Full Name</label>
                            <input type="text" name="name" required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>


                        <div>
                            <label class="block mb-1 text-sm">Email</label>
                            <input type="email" name="email" required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        </div>


                        <div>
                            <label class="block mb-1 text-sm">Message</label>
                            <textarea rows="4" name="message" required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3"></textarea>
                        </div>

                        <button
                            class="w-full bg-[#3B2F2F] hover:bg-[#2A211F] text-white py-3 rounded-xl tracking-widest">
                            SEND MESSAGE
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- MAPS (CENTER, BUKAN GRID) -->
        <div class="mt-24 flex justify-center">
            <div class="w-full max-w-3xl text-center">

                <h3 class="font-semibold text-lg mb-6 text-[#3B2F2F]">
                    Our Location
                </h3>

                <div class="rounded-3xl overflow-hidden shadow-lg">
                    <iframe
                        src="https://www.google.com/maps?q=Bandung&output=embed"
                        class="w-full h-72 border-0"
                        loading="lazy">
                    </iframe>
                </div>

                <div class="mt-8">
                    <a href="https://maps.app.goo.gl/PjTFzGLgtiq9GYM48"
                       target="_blank"
                       class="inline-flex items-center gap-2 bg-[#3B2F2F] text-white px-8 py-3 rounded-xl hover:bg-[#2A211F] transition">
                         Open in Google Maps
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
