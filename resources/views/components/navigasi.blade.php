<header class="sticky top-0 z-50 bg-[#1b2838]/90 backdrop-blur-md shadow-lg border-b border-gray-700">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3 group cursor-pointer transition-transform duration-300 hover:scale-105">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png?_=20220611141426" class="w-10 h-10" alt="Logo">
            <h1 class="text-white text-xl font-bold tracking-tight">Ryan Voucher Store</h1>
        </div>

        <ul class="hidden md:flex items-center gap-8 text-[#c7d5e0]">
            <li><a href="{{ url('/dashboard') }}" class="hover:text-white transition-colors relative group">
                Home
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#66c0f4] transition-all group-hover:w-full"></span>
            </a></li>
            <li><a href="{{ url('/produk-katalog') }}" class="hover:text-white transition-colors">Produk</a></li>
            <li><a href="{{ url('/produk-admin') }}" class="hover:text-white transition-colors">Admin</a></li>
            <li><a href="{{ url('/history') }}" class="hover:text-white transition-colors">History</a></li>
            <li><a href="{{ url('/help') }}" class="hover:text-white transition-colors">Help</a></li>
            <li><a href="#" class="bg-[#66c0f4] text-[#1b2838] px-5 py-2 rounded-md font-bold hover:bg-[#8fd6ff] hover:shadow-[0_0_15px_rgba(102,192,244,0.4)] transition-all">
                Login
            </a></li>
        </ul>
    </nav>
</header>