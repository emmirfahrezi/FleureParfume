<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Fleure Perfumes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

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
 @include('components.footer')
</body>
</html>
