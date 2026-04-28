@extends('app')

@section('title', 'Form Pembelian Voucher')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="mb-6">
                    <h2 class="text-2xl font-black text-[#1b2838] uppercase italic">Form Pembelian</h2>
                    <p class="text-sm text-gray-400">Lengkapi data untuk memproses pesanan.</p>
                </div>
                
                <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Email</label>
                        <input type="email" class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Nama Voucher</label>
                        <input type="text" class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Kategori</label>
                        <select class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                            <option>Steam Wallet</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Metode Pembayaran</label>
                        <select class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                            <option>QRIS</option>
                            <option>E-wallet</option>
                            <option>Virtual Account</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="w-full bg-[#1b2838] text-white py-4 rounded-xl font-black text-lg hover:bg-black shadow-lg transition-all transform active:scale-95">
                            BELI SEKARANG JUGA
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png?_=20220611141426" class="w-40 mb-4 opacity-20 group-hover:rotate-12 transition-transform duration-500" alt="logo">
                <h3 class="text-sm font-black text-gray-300 uppercase tracking-widest italic">Statistik</h3>
            </div>
        </div>

        <section class="mt-16 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-xl font-black text-[#1b2838] uppercase italic mb-6">Top Pembeli</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[#1b2838] text-white italic text-xs uppercase">
                        <tr>
                            <th class="p-4">No</th>
                            <th class="p-4">Nama</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Jumlah</th>
                            <th class="p-4 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 font-mono text-gray-400">01</td>
                            <td class="p-4 font-bold">Rayn</td>
                            <td class="p-4 text-gray-500 tracking-tighter">Steam Wallet</td>
                            <td class="p-4">30</td>
                            <td class="p-4 text-right font-black text-[#1b2838]">Rp1.500.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection