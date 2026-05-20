@extends('app')

@section('title', 'Steam Wallet Store | Home')

@section('content')
    <section class="relative bg-[#1b2838] overflow-hidden py-24">
        <div class="absolute top-0 left-0 w-full h-full opacity-20 pointer-events-none" 
             style="background: radial-gradient(circle at 50% 50%, #66c0f4 0%, transparent 70%);"></div>
        
        <div class="relative max-w-5xl mx-auto px-6 text-center">
            <span class="bg-[#66c0f4]/20 text-[#66c0f4] px-4 py-1 rounded-full text-xs font-black uppercase tracking-widest mb-4 inline-block">
                Region Indonesia (IDR)
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tighter uppercase italic leading-none">
                Level Up <span class="text-[#66c0f4]">Steam</span> Wallet Kamu Sekarang!
            </h1>
            <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                Jangan biarkan game favoritmu lewat gitu aja. Top up instan, harga paling miring se-Jember, saldo langsung masuk hitungan detik!
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#voucher" class="bg-[#5c7e10] hover:bg-[#78a315] text-white px-10 py-5 rounded-2xl font-black text-xl shadow-xl transition-all hover:-translate-y-1 active:scale-95">
                    BELI SEKARANG JUGA!
                </a>
                <a href="{{ url('/history') }}" class="bg-white/5 border border-white/10 hover:bg-white/10 text-white px-10 py-5 rounded-2xl font-bold text-xl transition-all">
                    Cek Riwayat
                </a>
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 mt-[-40px] relative z-10">
        <div class="bg-white rounded-[2rem] p-6 shadow-2xl border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="bg-[#66c0f4]/10 w-16 h-16 rounded-2xl flex items-center justify-center text-3xl">
                    🌤️
                </div>
                <div>
                    <h2 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Pantauan Cuaca Server</h2>
                    
                    <div id="weather-loading" class="text-sm italic text-gray-500 flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-[#66c0f4]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sinkronisasi satelit...
                    </div>

                    <div id="weather-data" class="hidden items-center gap-3">
                        <h3 class="text-2xl font-black text-[#1b2838] tracking-tight" id="city-name">-</h3>
                        <span class="text-gray-300">|</span>
                        <p class="text-[#66c0f4] font-bold capitalize" id="weather-desc">-</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center md:text-right bg-gray-50 px-8 py-3 rounded-2xl w-full md:w-auto border border-gray-100">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Suhu Udara</p>
                <p class="text-3xl font-black text-[#5c7e10]"><span id="temperature">--</span>°C</p>
            </div>
        </div>
    </section>

    <section id="voucher" class="max-w-7xl mx-auto px-6 py-24 scroll-mt-20">
        <div class="flex flex-col md:flex-row items-end justify-between mb-12 gap-4">
            <div class="max-w-xl">
                <h2 class="text-4xl font-black text-[#1b2838] uppercase italic leading-none mb-2">🔥 Paling Banyak Dicari</h2>
                <p class="text-gray-500 font-medium">Nominal favorit para gamers hari ini. Proses 100% otomatis 24 jam.</p>
            </div>
            <a href="{{ url('/produk-katalog') }}" class="text-[#66c0f4] font-black uppercase text-sm tracking-widest hover:underline flex items-center gap-2">
                Lihat Katalog Lengkap
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($produkRandom as $produk)
            <div class="group bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-2xl hover:border-[#66c0f4]/30 transition-all duration-500 flex flex-col items-center text-center">
                <span class="bg-gray-100 text-gray-400 text-[10px] font-black px-4 py-1 rounded-full mb-6 uppercase tracking-widest">{{ $produk->kategori }}</span>
                
                <div class="relative mb-6">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png?_=20220611141426" class="w-24 transition-transform duration-700 group-hover:rotate-360 group-hover:scale-110">
                </div>

                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Nominal Saldo</h3>
                <p class="text-4xl font-black text-[#1b2838] tracking-tighter mb-4">{{ $produk->nama_barang }}</p>
                
                <div class="w-full bg-gray-50 rounded-2xl p-4 mb-6">
                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Harga Nett</p>
                    <p class="text-2xl font-black text-[#5c7e10]">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                </div>

                <a href="{{ url('/beli') }}" class="w-full bg-[#1b2838] hover:bg-[#66c0f4] text-white py-4 rounded-2xl font-black transition-all shadow-lg hover:shadow-[#66c0f4]/40">
                    Beli Sekarang!
                </a>
            </div>
            @empty
            <div class="md:col-span-3 bg-white rounded-[2.5rem] p-10 border border-gray-100 text-center text-gray-400 font-medium">
                Belum ada produk di database.
            </div>
            @endforelse
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="bg-gray-900 rounded-[3rem] p-12 flex flex-col md:flex-row items-center justify-around gap-12 border border-white/5">
            <div class="text-center">
                <p class="text-4xl font-black text-white mb-1">10rb+</p>
                <p class="text-xs font-bold text-[#66c0f4] uppercase tracking-widest">Transaksi Sukses</p>
            </div>
            <div class="text-center">
                <p class="text-4xl font-black text-white mb-1">24/7</p>
                <p class="text-xs font-bold text-[#66c0f4] uppercase tracking-widest">Proses Otomatis</p>
            </div>
            <div class="text-center">
                <p class="text-4xl font-black text-white mb-1">60 Detik</p>
                <p class="text-xs font-bold text-[#66c0f4] uppercase tracking-widest">Rata-rata Pengiriman</p>
            </div>
        </div>
    </section>

    @auth
    <section class="max-w-5xl mx-auto px-4 sm:px-6 mt-6 relative z-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl sm:rounded-[2rem] p-4 sm:p-6 lg:p-8 border border-gray-100 dark:border-gray-700 shadow-sm transition-colors duration-300">
            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)_auto] items-stretch lg:items-center gap-4 sm:gap-6">
                
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6 min-w-0">
                    <div class="shrink-0 bg-[#5c7e10]/10 text-[#5c7e10] dark:bg-[#78a315]/20 dark:text-[#78a315] w-16 h-16 sm:w-20 sm:h-20 rounded-2xl sm:rounded-3xl flex flex-col items-center justify-center border border-[#5c7e10]/20">
                        <span class="text-2xl sm:text-3xl font-black leading-none">{{ session('visit_count', 1) }}</span>
                        <span class="text-[9px] font-bold uppercase tracking-wider mt-1">Kali</span>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-xl font-black text-[#1b2838] dark:text-white uppercase italic tracking-tighter">📊 Tracker Aktivitas Sesi</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mt-0.5">Sistem memantau intensitas navigasi browser lo di halaman ini.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-3 sm:gap-4 w-full min-w-0">
                    <div class="bg-gray-50 dark:bg-gray-950 px-4 py-3 rounded-2xl border border-gray-100 dark:border-white/5 min-w-0">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Sesi Pertama Dimulai</p>
                        <p class="text-xs sm:text-sm font-bold text-gray-700 dark:text-gray-300 break-words">{{ session('first_visit', '-') }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-950 px-4 py-3 rounded-2xl border border-gray-100 dark:border-white/5 min-w-0">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Aktivitas Terakhir</p>
                        <p class="text-xs sm:text-sm font-bold text-[#66c0f4] break-words">{{ session('last_visit', '-') }}</p>
                    </div>
                </div>

                <div class="w-full lg:w-auto">
                    <form action="{{ route('kunjungan.reset') }}" method="POST" onsubmit="return confirm('Yakin mau mengulang hitungan sesi dari awal bro?')">
                        @csrf
                        <button type="submit" class="w-full lg:w-auto whitespace-nowrap bg-red-500 hover:bg-red-600 active:scale-95 text-white text-xs font-black uppercase tracking-wider px-5 sm:px-6 py-4 rounded-xl transition-all shadow-md shadow-red-500/20">
                            Reset Hitungan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endauth
@endsection

