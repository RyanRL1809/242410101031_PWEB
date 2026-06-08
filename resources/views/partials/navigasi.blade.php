<header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-[#1b2838]/90 backdrop-blur-md shadow-lg border-b border-gray-700 overflow-x-hidden">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">        <a href="{{ route('home') }}" class="flex items-center gap-3 group cursor-pointer transition-transform duration-300 hover:scale-105">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png?_=20220611141426" class="w-10 h-10" alt="Logo">
            <h1 class="text-white text-xl font-bold tracking-tight hidden sm:block">Ryan Voucher Store</h1>
            <h1 class="text-white text-lg font-bold tracking-tight sm:hidden">Ryan Voucher Store</h1>
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex items-center gap-4 lg:gap-6 text-[#c7d5e0] ml-auto text-sm lg:text-base">
            <li><a href="{{ route('katalog') }}" class="hover:text-white transition-colors whitespace-nowrap">Produk</a></li>
            @auth
                @if(auth()->user()->role === 'admin')
                    <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors whitespace-nowrap">Admin Produk</a></li>
                    <li><a href="{{ route('admin.users.index') }}" class="hover:text-white transition-colors whitespace-nowrap">Akun Pelanggan</a></li>
                @endif
            @endauth
            @auth
            <li><a href="{{ route('history') }}" class="hover:text-white transition-colors whitespace-nowrap">History</a></li>
            @endauth
            <li><a href="{{ route('help') }}" class="hover:text-white transition-colors whitespace-nowrap">Help</a></li>
            <li><a href="{{ route('pengaturan.index') }}" class="hover:text-white transition-colors whitespace-nowrap">Pengaturan</a></li>
            @auth
            <li class="border-l border-gray-600 pl-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 transition-opacity hover:opacity-85">
                    @if (auth()->user()->profile_image)
                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile image" class="w-9 h-9 rounded-full object-cover shadow-md flex-shrink-0">
                    @else
                        <div class="w-9 h-9 rounded-full bg-[#66c0f4] text-[#1b2838] flex items-center justify-center font-bold shadow-md flex-shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="leading-tight">
                        <p class="text-white text-sm font-bold">{{ auth()->user()->name }}</p>
                        <p class="text-[#66c0f4] text-[10px] uppercase tracking-widest">{{ auth()->user()->role }}</p>
                    </div>
                </a>
            </li>
            @else
            <li>
                <a href="{{ route('login') }}"
                class="bg-[#66c0f4] text-[#1b2838] px-4 py-2 rounded-md font-bold text-sm hover:bg-[#8fd6ff] transition-all whitespace-nowrap">
                    Login
                </a>
            </li>
            @endauth
        </ul>

        <!-- Mobile Hamburger Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-white p-2 hover:bg-gray-700 rounded-lg transition-colors">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </nav>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-[#0f1823] border-t border-gray-700 max-h-96 overflow-y-auto">
        <ul class="flex flex-col divide-y divide-gray-700 text-[#c7d5e0]">
            <li><a href="{{ route('katalog') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 hover:bg-gray-800 transition-colors">Produk</a></li>
            @auth
                @if(auth()->user()->role === 'admin')
                    <li><a href="{{ route('products.index') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 hover:bg-gray-800 transition-colors text-[#66c0f4] font-bold">Admin Produk</a></li>
                    <li><a href="{{ route('admin.users.index') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 hover:bg-gray-800 transition-colors text-[#66c0f4] font-bold">Akun Pelanggan</a></li>
                @endif
            @endauth
            @auth
            <li><a href="{{ route('history') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 hover:bg-gray-800 transition-colors">History</a></li>
            @endauth
            <li><a href="{{ route('help') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 hover:bg-gray-800 transition-colors">Help</a></li>
            <li><a href="{{ route('pengaturan.index') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 hover:bg-gray-800 transition-colors">Pengaturan</a></li>
            @auth
            <li class="border-t border-gray-600">
                <a href="{{ route('profile.edit') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-2">
                        @if (auth()->user()->profile_image)
                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 rounded-full bg-[#66c0f4] text-[#1b2838] flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-white text-sm font-bold">{{ auth()->user()->name }}</p>
                            <p class="text-[#66c0f4] text-xs uppercase">{{ auth()->user()->role }}</p>
                        </div>
                    </div>
                </a>
            </li>
            @else
            <li class="border-t border-gray-600">
                <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 bg-[#66c0f4] text-[#1b2838] hover:bg-[#8fd6ff] transition-colors font-bold text-center">
                    Login
                </a>
            </li>
            @endauth
        </ul>
    </div>
</header>
