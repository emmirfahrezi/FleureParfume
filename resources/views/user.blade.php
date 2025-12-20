<x-layout>

    {{-- hero section (same as home, but show username and logout) --}}
    <div class="relative isolate px-6 pt-32 lg:px-20 min-h-screen"
        style="background-image: linear-gradient(135deg, rgba(90,62,43,0.7) 0%, rgba(0,0,0,0.5) 100%), url('https://images.unsplash.com/photo-1523293182086-7651a899d37f?w=1920&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">

        <div class="max-w-3xl py-6 sm:py-8 lg:py-16 flex flex-col justify-center pt-20 min-h-screen">

            <!-- LEFT TEXT -->
            <h1 class="text-5xl font-semibold tracking-tight text-white sm:text-7xl leading-none drop-shadow-lg"
                style="font-family: cormorant, serif !important;">
                Data to enrich your online business
            </h1>

            <p class="mt-4 text-lg font-medium text-gray-100 sm:text-xl leading-relaxed max-w-xl drop-shadow"
                style="font-family: poppins, sans-serif !important; font-weight: 300;">
                Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo.
                Elit sunt amet fugiat veniam occaecat.
            </p>

            <!-- Show logged in user name -->
            <p class="mt-4 text-sm font-medium text-gray-100 sm:text-base leading-relaxed max-w-xl drop-shadow"
                style="font-family: poppins, sans-serif !important; font-weight: 300;">
                Selamat datang, <strong>{{ Auth::user()->name }}</strong>
            </p>

            <div class="mt-6 flex items-center gap-x-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="rounded-md px-4 py-2.5 text-sm font-semibold text-white shadow transition hover:opacity-80"
                        style="background-color: #5A3E2B; font-family: poppins, sans-serif !important;">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>

    {{-- keep the rest of the home sections so the page looks the same --}}
    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- LEFT SIDE - IMAGE -->
                <div class="flex justify-center lg:justify-start">
                    <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?w=800&q=80" alt="Parfume"
                        class="rounded-lg shadow-lg w-full max-w-md h-auto object-cover">
                </div>

                <!-- RIGHT SIDE - TEXT -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-4xl sm:text-5xl font-semibold text-gray-900 mb-6"
                        style="font-family: cormorant, serif !important;">
                        Discover Your Perfect Scent
                    </h2>

                    <p class="text-lg text-gray-600 mb-4"
                        style="font-family: poppins, sans-serif !important; font-weight: 300;">
                        Kami menghadirkan koleksi parfum premium dari seluruh dunia untuk memenuhi setiap selera dan momen
                        spesial Anda.
                    </p>

                    <p class="text-lg text-gray-600 mb-8"
                        style="font-family: poppins, sans-serif !important; font-weight: 300;">
                        Setiap botol dirancang dengan sempurna untuk memberikan pengalaman aroma yang tak terlupakan. Pilih
                        dari berbagai pilihan eksklusif kami.
                    </p>

                    <div class="flex gap-4">
                        <a href="#"
                            class="rounded-md px-6 py-3 text-sm font-semibold text-white shadow transition hover:opacity-80"
                            style="background-color: #5A3E2B; font-family: poppins, sans-serif !important;">
                            Shop Now
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- LEFT SIDE - TEXT -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-6xl sm:text-8xl font-semibold text-gray-900"
                        style="font-family: cormorant, serif !important;">
                        Smell is good
                    </h2>
                </div>

                <!-- RIGHT SIDE - IMAGE -->
                <div class="flex justify-center lg:justify-end">
                    <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?w=800&q=80" alt="Parfume"
                        class="rounded-lg shadow-lg w-full max-w-md h-auto object-cover">
                </div>

            </div>
        </div>
    </div>

</x-layout>