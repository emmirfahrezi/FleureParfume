 {{-- hero section --}}
 <style>
     .hero-bg {
         background-image: linear-gradient(135deg, rgba(90, 62, 43, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%),
         url("{{ asset('images/products/thumbnail.jpg') }}");
         background-size: cover;
         background-position: center;
         background-attachment: fixed;
     }
 </style>
 
 <div class="relative isolate px-6 pt-20 lg:px-20 h-[600px] lg:h-[700px] hero-bg">

     <!-- Container kiri (hapus mx-auto agar TIDAK center) -->
     <div class="max-w-3xl py-6 sm:py-8 lg:py-16 flex flex-col justify-center h-full">

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



     </div>
 </div>

 {{-- hero section done --}}

 {{-- section 2 --}}
 <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-20 ">
     <div class="max-w-7xl mx-auto">
         <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

             <!-- LEFT SIDE - IMAGE -->
             <div class="flex justify-center lg:justify-start">
                 <img src="{{ asset('images/products/bitterpeach.jpg') }}" alt="Parfume bitter peach"
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

 {{-- section 2 done --}}



 {{-- section 3   --}}

 <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-20">
     <div class="max-w-7xl mx-auto">
         <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

             <!-- LEFT SIDE - TEXT -->
             <div class="flex flex-col justify-center">
                 <h2 class="text-6xl sm:text-8xl font-semibold text-gray-900"
                     style="font-family: cormorant, serif !important;">
                     Smell is good
                 </h2>
                 <p class="mt-4 text-lg text-gray-600 max-w-xl"
                     style="font-family: poppins, sans-serif !important; font-weight: 300;">
                     Temukan aroma yang menghidupkan mood, membangun kepercayaan diri, dan meninggalkan kesan lembut
                     setiap kali melangkah. Pilih wewangian yang paling menggambarkan dirimu.
                 </p>
             </div>

             <!-- RIGHT SIDE - IMAGE -->
             <div class="flex justify-center lg:justify-end">
                 <style>
                     .img-hover-effect {
                         transition: transform 0.3s ease, filter 0.3s ease;
                     }

                     .img-hover-effect:hover {
                         transform: scale(1.05);
                     }

                     .dark-overlay {
                         transition: opacity 0.3s ease;
                     }

                     .img-hover-effect:hover~.dark-overlay {
                         opacity: 0;
                     }
                 </style>
                 <div class="relative inline-block rounded-lg" style="overflow: visible;">
                     <img src="{{ asset('images/products/lostcherry.jpg') }}" alt="Lost Cherry"
                         class="img-hover-effect rounded-lg shadow-lg w-full max-w-md h-auto object-cover">
                     <div class="dark-overlay absolute inset-0 bg-black/30 rounded-lg pointer-events-none"></div>
                     <img src="{{ asset('images/products/lostcherry2.jpg') }}" alt="Lost Cherry detail"
                         class="absolute -right-6 top-1/2 -translate-y-1/2 w-50 h-50 rounded-md shadow-lg ring-2 ring-white/80">
                 </div>
             </div>

         </div>
     </div>
 </div>

 {{-- section 3 done --}}

 {{-- sectiion 4 --}}
 <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-20">
     <div class="text-center text-black" style="font-family: cormorant, serif !important;">
         <h4 class="text-2xl tracking-wide" style="font-family: cormorant, serif !important">Check Out Our</h4>
         <h1 class="text-5xl  leading-tight" style="font-family: cormorant, serif !important">BEST SELLER</h1>
     </div>

     @php
     // Panggil Model pakai backslash biar aman
     $bestSellers = \App\Models\Product::with('category')->latest()->take(4)->get();
     @endphp

     <div class="max-w-7xl mx-auto mt-12">
         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
             @foreach($bestSellers as $product)

             {{-- Logic Link Kategori --}}
             @php
             $catName = strtolower($product->category->name ?? '');
             $linkCategory = '#';

             if (str_contains($catName, 'wanita') || str_contains($catName, 'women')) {
             $linkCategory = route('woman.index');
             } elseif (str_contains($catName, 'pria') || str_contains($catName, 'men')) {
             $linkCategory = route('man.index');
             } elseif (str_contains($catName, 'unisex')) {
             $linkCategory = route('unisex.index');
             } elseif (str_contains($catName, 'exclusive')) {
             $linkCategory = route('exclusive.index');
             }
             @endphp

             <div class="bg-white rounded-lg shadow-lg overflow-hidden transition hover:shadow-xl group">

                 {{-- [MODIFIKASI] Bungkus Area Gambar Pakai Link --}}
                 <div class="w-full h-64 overflow-hidden relative">
                     <a href="{{ $linkCategory }}" class="block w-full h-full cursor-pointer">
                         @if($product->image)
                         <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                         @else
                         <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">No Image</div>
                         @endif

                         {{-- Efek Overlay Gelap pas di-hover (Opsional biar cakep) --}}
                         <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                     </a>
                 </div>

                 <div class="p-4">
                     {{-- Link di Tulisan Kategori --}}
                     <a href="{{ $linkCategory }}" class="block w-fit hover:underline hover:text-black transition">
                         <h4 class="text-s text-gray-500 mb-1" style="font-family: cormorant, serif !important;">
                             {{ $product->category->name ?? 'Uncategorized' }}
                         </h4>
                     </a>

                     {{-- Link di Nama Produk (Opsional: Kalau mau nama produk diklik juga ke kategori) --}}
                     <a href="{{ $linkCategory }}">
                         <h3 class="text-xl font-semibold text-gray-900 hover:text-gray-600 transition"
                             style="font-family: cormorant, serif !important;">
                             {{ $product->name }}
                         </h3>
                     </a>

                     <p class="text-gray-600 mt-2" style="font-family: poppins, sans-serif !important;">
                         Rp {{ number_format($product->price, 0, ',', '.') }}
                     </p>
                 </div>
             </div>
             @endforeach
         </div>
     </div>
 </div>
 {{-- section 4 done --}}

 {{-- banner brand --}}
 @php
 $brands = \Database\Factories\BrandData::get();
 @endphp

 <div class="marquee-container" style="height: 300px;">
     <div class="flex items-center h-full">
         <div class="marquee-content">

             @foreach($brands as $brand)
             <div class="brand-logo">
                 <div class="text-center">
                     <img src="{{ asset($brand['image']) }}" alt="{{ $brand['name'] }}" class="rounded-lg">
                     <p class="mt-2 text-sm font-semibold text-gray-700"
                         style="font-family: cormorant, serif !important;">{{ $brand['name'] }}</p>
                 </div>
             </div>
             @endforeach

             @foreach($brands as $brand)
             <div class="brand-logo">
                 <div class="text-center">
                     <img src="{{ asset($brand['image']) }}" alt="{{ $brand['name'] }}" class="rounded-lg">
                     <p class="mt-2 text-sm font-semibold text-gray-700"
                         style="font-family: cormorant, serif !important;">{{ $brand['name'] }}</p>
                 </div>
             </div>
             @endforeach
         </div>
     </div>
 </div>
 {{-- banner brand done --}}



 {{-- section 5  --}}
 @php
 use App\Models\Category;


 $categories = Category::with('products')->take(4)->get()
 @endphp
 <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-20">
     <div class="max-w-7xl mx-auto">
         <div class="text-center text-black" style="font-family: cormorant, serif !important;">
             <h4 class="text-2xl font-bold tracking-wide" style="font-family: cormorant, serif !important">New Perfumes</h4>
             <h1 class="text-5xl font-bold leading-tight uppercase" style="font-family: cormorant, serif !important">Shop By Category</h1>
         </div>

         <div class="max-w-7xl mx-auto mt-8">
             <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                 @foreach($categories as $cat)
                 <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                     <div class="relative w-full h-96">
                         @php
                         // Ambil gambar produk pertama di kategori ini
                         $coverImage = $cat->products->first()->image ?? null;
                         @endphp

                         @if($coverImage)
                         <img src="{{ asset('storage/' . $coverImage) }}" alt="{{ $cat->name }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                         @else
                         <div class="absolute inset-0 w-full h-full bg-gray-300 flex items-center justify-center text-gray-500">No Image</div>
                         @endif

                         <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-40 transition"></div>
                         <div class="absolute bottom-0 left-0 right-0 p-3">
                             <h3 class="text-white text-lg font-semibold drop-shadow" style="font-family: cormorant, serif !important;">
                                 {{ $cat->name }}
                             </h3>
                         </div>
                     </div>
                 </div>
                 @endforeach

             </div>
         </div>
     </div>
 </div>