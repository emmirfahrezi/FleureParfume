<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Fleure Perfumes</title>

    {{-- VITE --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FONT BRAND --}}
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .font-brand {
            font-family: 'Cormorant Garamond', serif;
        }
    </style>
</head>

<body class="bg-[#F5EFE6] text-[#3B2F2F]">

<!-- NAVBAR -->
@include('components.navbar')

<!-- CONTENT -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-[#2B1E16] text-gray-300 mt-10">
    <div class="max-w-7xl mx-auto px-8 py-16 text-center">
        <p class="text-sm">
            © {{ date('Y') }} Fleure Perfumes. Our perfumes are crafted with passion and dedication to bring you the finest scents.

        </p>
    </div>
</footer>

</body>
</html>
