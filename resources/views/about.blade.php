@extends('layouts.app') {{-- pakai layout frontend lu --}}

@section('content')

<!-- HERO ABOUT -->
<section class="bg-[#F5EFE6] py-30">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="font-brand text-5xl tracking-[0.25em] text-[#3B2F2F] mb-6">
            ABOUT
        </h1>
        <p class="max-w-2xl mx-auto text-[#6B5B4B] leading-relaxed">
            Fleure Perfumes adalah destinasi parfum premium yang menghadirkan
            keharuman eksklusif untuk mereka yang menghargai kualitas, karakter,
            dan keanggunan.
        </p>
    </div>
</section>

<!-- STORY SECTION -->
<section class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

        <!-- TEXT -->
        <div>
            <h2 class="font-brand text-3xl tracking-wide text-[#3B2F2F] mb-6">
                Our Story
            </h2>
            <p class="text-[#6B5B4B] leading-relaxed mb-4">
                Fleure Perfumes lahir dari kecintaan terhadap seni wewangian.
                Kami percaya bahwa parfum bukan sekadar aroma, tetapi identitas
                yang melekat pada setiap individu.
            </p>
            <p class="text-[#6B5B4B] leading-relaxed">
                Setiap koleksi kami dipilih dengan cermat dari rumah parfum
                ternama di dunia, memastikan kualitas terbaik dan pengalaman
                aroma yang berkelas.
            </p>
        </div>

        <!-- IMAGE -->
        <div class="relative">
            <img 
                src="{{ asset('about-parfume.jpg') }}"
                alt="About Fleure Perfumes"
                class="rounded-3xl shadow-xl object-cover w-full h-full">
            </div>

    </div>
</section>

<!-- VALUES -->
<section class="bg-[#F5EFE6] py-24">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="font-brand text-4xl tracking-wide text-[#3B2F2F] mb-16">
            Our Values
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <div class="bg-white rounded-3xl p-10 shadow-lg hover:shadow-xl transition">
                <h3 class="font-brand text-xl tracking-wide mb-4">
                    Elegance
                </h3>
                <p class="text-[#6B5B4B] text-sm leading-relaxed">
                    Kami menghadirkan parfum dengan karakter elegan yang
                    mencerminkan keanggunan sejati.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-10 shadow-lg hover:shadow-xl transition">
                <h3 class="font-brand text-xl tracking-wide mb-4">
                    Authenticity
                </h3>
                <p class="text-[#6B5B4B] text-sm leading-relaxed">
                    Setiap produk dijamin keasliannya, langsung dari distributor
                    dan brand terpercaya.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-10 shadow-lg hover:shadow-xl transition">
                <h3 class="font-brand text-xl tracking-wide mb-4">
                    Experience
                </h3>
                <p class="text-[#6B5B4B] text-sm leading-relaxed">
                    Kami fokus pada pengalaman pelanggan yang personal,
                    eksklusif, dan berkesan.
                </p>
            </div>

        </div>
    </div>
</section>


@endsection
