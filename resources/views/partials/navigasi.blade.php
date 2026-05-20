<header class="sticky top-0 z-50 bg-[#1b2838]/90 backdrop-blur-md shadow-lg border-b border-gray-700">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3 group cursor-pointer transition-transform duration-300 hover:scale-105">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png?_=20220611141426" class="w-10 h-10" alt="Logo">
            <h1 class="text-white text-xl font-bold tracking-tight">Ryan Voucher Store</h1>
        </div>

        <ul class="hidden md:flex items-center gap-8 text-[#c7d5e0]">
            <li><a href="{{ route('home') }}" class="hover:text-white transition-colors relative group">
                Home
                <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#66c0f4] transition-all group-hover:w-full"></span>
            </a></li>
            <li><a href="{{ route('katalog') }}" class="hover:text-white transition-colors">Produk</a></li>
            @auth
                @if(auth()->user()->role === 'admin')

                <li>
                    <a href="{{ route('products.index') }}"
                    class="hover:text-white transition-colors">

                        Admin
                    </a>
                </li>

                @endif
            @endauth
            <li><a href="{{ route('history') }}" class="hover:text-white transition-colors">History</a></li>
            <li><a href="{{ route('help') }}" class="hover:text-white transition-colors">Help</a></li>
            <li><a href="{{ route('pengaturan.index') }}" class="hover:text-white transition-colors">Pengaturan</a></li>
            <li>
                <button id="dark-mode-toggle" type="button" class="px-3 py-2 bg-gray-200 text-[#1b2838] dark:bg-gray-700 dark:text-white rounded-xl font-bold transition-colors">
                    Theme
                </button>
            </li>
            @auth
            <li class="border-l border-gray-600 pl-5">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 transition-opacity hover:opacity-85">
                    @if (auth()->user()->profile_image)
                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile image" class="w-9 h-9 rounded-full object-cover shadow-md">
                    @else
                        <div class="w-9 h-9 rounded-full bg-[#66c0f4] text-[#1b2838] flex items-center justify-center font-bold shadow-md">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="leading-tight">
                        <p class="text-white text-sm font-bold">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-[#66c0f4] text-[10px] uppercase tracking-widest">
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                </a>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="bg-[#66c0f4] text-[#1b2838] px-5 py-2 rounded-md font-bold hover:bg-[#8fd6ff] hover:shadow-[0_0_15px_rgba(102,192,244,0.4)] transition-all">

                        Logout
                    </button>
                </form>
            </li>

            @else
            <li>
                <a href="{{ route('login') }}"
                class="bg-[#66c0f4] text-[#1b2838] px-5 py-2 rounded-md font-bold hover:bg-[#8fd6ff] hover:shadow-[0_0_15px_rgba(102,192,244,0.4)] transition-all">
                    Login
                </a>
            </li>
            @endauth
        </ul>
    </nav>
</header>
