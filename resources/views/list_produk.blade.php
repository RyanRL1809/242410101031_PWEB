@extends('app')

@section('title', 'Katalog Lengkap Steam Wallet')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-black text-[#1b2838] uppercase italic tracking-tighter">Katalog <span class="text-[#66c0f4]">Lengkap</span></h1>
        <p class="text-gray-500 font-medium">Temukan semua nominal Steam Wallet IDR dengan harga terbaik di Jember.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">
        
        <aside class="w-full lg:w-1/4">
            <div class="space-y-6"> 
                <div class="bg-white p-6 rounded-4xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest mb-6 border-b pb-2">Filter Harga</h3>
                    
                    <div class="space-y-4">
                        @foreach(['Semua Harga', 'Dibawah Rp50.000', 'Rp50.000 - Rp200.000', 'Diatas Rp200.000'] as $range)
                        <label class="flex items-center group cursor-pointer">
                            <input type="radio" name="filter_harga" value="{{ $range }}"
                                class="filterHarga w-5 h-5 border-gray-300 text-[#66c0f4] focus:ring-[#66c0f4]"
                                {{ $loop->first ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-600 group-hover:text-[#1b2838] font-medium transition-colors">{{ $range }}</span>
                        </label>
                        @endforeach
                    </div>
                    
                    <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest mt-10 mb-6 border-b pb-2">Status Stok</h3>
                    <div class="space-y-4">
                        <label class="flex items-center group cursor-pointer">
                            <input type="checkbox" id="filterStok" checked class="w-5 h-5 rounded border-gray-300 text-[#5c7e10] focus:ring-[#5c7e10]">
                            <span class="ml-3 text-gray-600 font-medium">Tampilkan Stok Ready</span>
                        </label>
                    </div>

                    <button class="reset-filter w-full mt-8 bg-gray-100 hover:bg-gray-200 text-gray-600 py-3 rounded-xl font-bold text-sm transition-all">
                        Reset Filter
                    </button>
                </div>
            </div>
        </aside>

        <main class="flex-1">
            <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-100 flex items-center mb-8 gap-3">
                <div class="pl-4 text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" id="searchInput" placeholder="Cari nominal saldo (contoh: 12000)..." 
                       class="flex-1 py-3 bg-transparent outline-none text-[#1b2838] font-medium placeholder:text-gray-300">
            </div>

            <div class="flex items-center justify-between mb-6 px-2">
                <p class="text-sm text-gray-400 font-medium">
                    Menampilkan <span id="productCount" class="text-[#1b2838] font-bold">{{ count($data) }}</span> produk Steam Wallet
                </p>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-gray-400 uppercase">Urutkan:</span>
                    <select id="sortOrder" class="text-sm font-bold text-[#1b2838] bg-transparent outline-none cursor-pointer">
                        <option value="termurah">Harga Termurah</option>
                        <option value="termahal">Harga Termahal</option>
                    </select>
                </div>
            </div>

            <div id="appData"
                data-produk='@json($data)'
                data-url-beli="{{ url('/beli') }}"
                class="hidden">
            </div>

            <div id="productContainer" class="grid grid-cols-2 lg:grid-cols-3 gap-6"></div>
        </main>
    </div>
</div>
@endsection