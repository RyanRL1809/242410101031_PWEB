<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Ryan Voucher Store')</title>
    
    <script>
        function getCookieInline(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for(let i=0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }

        const theme = getCookieInline('theme') || 'system';
        const fontSize = getCookieInline('font_size') || 'normal';

        if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        document.documentElement.setAttribute('data-font-size', fontSize);
    </script>

    <style>
        html { scroll-behavior: smooth; }
        html[data-font-size="kecil"] { font-size: 14px; }
        html[data-font-size="normal"] { font-size: 16px; }
        html[data-font-size="besar"] { font-size: 18px; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-950 flex flex-col min-h-screen transition-colors">

    @include('partials.navigasi')

    <main class="grow">
        @if(session('success'))
        <div class="max-w-7xl mx-auto mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 
        rounded relative" role="alert">
            <strong class="font-bold">Mantap!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    @include('components.footer')
    @stack('scripts')
</body>
</html>
