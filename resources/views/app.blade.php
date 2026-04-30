<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ryan Voucher Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js']) {{-- ← tambahin ini --}}
    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <x-navigasi />

    <main class="grow">
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>