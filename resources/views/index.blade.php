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
            @php
                $terlaris = [
                    ['nom' => '45.000', 'real' => '46.000', 'tag' => 'Paling Cuan'],
                    ['nom' => '90.000', 'real' => '90.500', 'tag' => 'Best Value'],
                    ['nom' => '120.000', 'real' => '122.000', 'tag' => 'Pro Choice'],
                ];
            @endphp

            @foreach($terlaris as $v)
            <div class="group bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-2xl hover:border-[#66c0f4]/30 transition-all duration-500 flex flex-col items-center text-center">
                <span class="bg-gray-100 text-gray-400 text-[10px] font-black px-4 py-1 rounded-full mb-6 uppercase tracking-widest">{{ $v['tag'] }}</span>
                
                <div class="relative mb-6">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png?_=20220611141426" class="w-24 transition-transform duration-700 group-hover:rotate-360 group-hover:scale-110">
                </div>

                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Nominal Saldo</h3>
                <p class="text-4xl font-black text-[#1b2838] tracking-tighter mb-4">Rp{{ $v['nom'] }}</p>
                
                <div class="w-full bg-gray-50 rounded-2xl p-4 mb-6">
                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Harga Nett</p>
                    <p class="text-2xl font-black text-[#5c7e10]">Rp{{ $v['real'] }}</p>
                </div>

                <a href="{{ url('/beli') }}" class="w-full bg-[#1b2838] hover:bg-[#66c0f4] text-white py-4 rounded-2xl font-black transition-all shadow-lg hover:shadow-[#66c0f4]/40">
                    Beli Sekarang!
                </a>
            </div>
            @endforeach
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
@endsection