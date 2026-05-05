<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ryan Voucher Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('partials.navigasi')

    <main class="grow">
        @if(session('success'))
        <div class="max-w-7xl mx-auto mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 
        rounded relative" role="alert">
            <strong class="font-bold">Mantap!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        @yield('content')
    </main>

    @include('components.footer')
    @stack('scripts')
</body>
</html>