@extends('app')

@section('title', 'Form Pemesanan Voucher')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="mb-6">
                    <h2 class="text-2xl font-black text-[#1b2838] uppercase italic">Form Pembelian</h2>
                    <p class="text-sm text-gray-400">Lengkapi data untuk memproses pesanan.</p>
                </div>
                @if(session('success'))
                    <div class="mb-6 rounded-3xl border border-green-100 bg-green-50 p-5 text-sm text-green-900">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-3xl border border-red-100 bg-red-50 p-5 text-sm text-red-900">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(isset($product))
                <div class="mb-6 rounded-3xl border border-blue-100 bg-blue-50 p-5 text-sm text-blue-900">
                    <p class="font-bold">Produk yang dipilih:</p>
                    <p>Nama Voucher: <span class="font-semibold">{{ $product->nama_barang }}</span></p>
                    <p>Kategori: <span class="font-semibold">{{ $product->kategori }}</span></p>
                    <p>Harga satuan: <span class="font-semibold">Rp{{ number_format($product->harga, 0, ',', '.') }}</span></p>
                </div>
                @endif

                <form action="{{ route('beli.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    @if(isset($product))
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @endif

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Nama Lengkap</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]" placeholder="0812xxxxxxxx">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Nama Voucher</label>
                        <input type="text" name="nama_voucher" value="{{ old('nama_voucher', $product->nama_barang ?? '') }}" class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]" placeholder="Nama voucher" {{ isset($product) ? 'readonly' : '' }}>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Kategori</label>
                        <select name="kategori" class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                            <option value="Steam Wallet" {{ (old('kategori', $product->kategori ?? '') === 'Steam Wallet') ? 'selected' : '' }}>Steam Wallet</option>
                            <option value="Epic Games Wallet" {{ (old('kategori', $product->kategori ?? '') === 'Epic Games Wallet') ? 'selected' : '' }}>Epic Games Wallet</option>
                            <option value="Ubisoft Wallet" {{ (old('kategori', $product->kategori ?? '') === 'Ubisoft Wallet') ? 'selected' : '' }}>Ubisoft Wallet</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Jumlah</label>
                        <input type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" required class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Metode Pembayaran</label>
                        <select name="payment_method" required class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                            <option value="QRIS" {{ old('payment_method') === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                            <option value="E-wallet" {{ old('payment_method') === 'E-wallet' ? 'selected' : '' }}>E-wallet</option>
                            <option value="Virtual Account" {{ old('payment_method') === 'Virtual Account' ? 'selected' : '' }}>Virtual Account</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit" class="w-full bg-[#1b2838] text-white py-4 rounded-xl font-black text-lg hover:bg-black shadow-lg transition-all transform active:scale-95">
                            KONFIRMASI PESANAN
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                @if(isset($product))
                    <h3 class="text-lg font-black text-[#1b2838] uppercase tracking-tight mb-4">Ringkasan Pesanan</h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="rounded-3xl border border-gray-100 bg-gray-50 p-4">
                            <p class="font-bold text-gray-800">Produk</p>
                            <p>{{ $product->nama_barang }}</p>
                            <p class="text-xs text-gray-400">{{ $product->kategori }}</p>
                        </div>
                        <div class="rounded-3xl border border-gray-100 bg-gray-50 p-4">
                            <p class="font-bold text-gray-800">Harga</p>
                            <p>Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="rounded-3xl border border-gray-100 bg-gray-50 p-4">
                            <p class="font-bold text-gray-800">Jumlah Pesanan</p>
                            <p>{{ old('quantity', 1) }} buah</p>
                        </div>
                        <div class="rounded-3xl border border-gray-100 bg-gray-50 p-4">
                            <p class="font-bold text-gray-800">Total Perkiraan</p>
                            <p class="text-[#1b2838] font-black">Rp{{ number_format(($product->harga * (old('quantity', 1))), 0, ',', '.') }}</p>
                        </div>
                    </div>
                @else
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png?_=20220611141426" class="w-40 mb-4 opacity-20 group-hover:rotate-12 transition-transform duration-500" alt="logo">
                        <h3 class="text-sm font-black text-gray-300 uppercase tracking-widest italic">Statistik</h3>
                    </div>
                @endif
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
