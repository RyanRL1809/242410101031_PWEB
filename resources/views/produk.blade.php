@extends('app')

@section('title', 'Admin - Manajemen Produk')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Inventaris</h1>
            <p class="text-gray-500">Tambah atau perbarui stok produk voucher Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 h-fit">
                <h2 class="text-lg font-bold mb-4">Input Produk Baru</h2>
                
                <form action="{{ route('produk.store') }}" method="POST" class="space-y-4">
                    @csrf <div>
                        <label class="block text-sm font-medium mb-1">Kode Barang</label>
                        <input type="text" name="kode" required placeholder="Contoh: SW-001"
                               class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Barang</label>
                        <input type="text" name="nama" required placeholder="Contoh: Steam Wallet 12K"
                               class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Kategori</label>
                        <select name="kategori" required class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Steam Wallet">Steam Wallet</option>
                            <option value="Epic Games Wallet">Epic Games Wallet</option>
                            <option value="Ubisoft Wallet">Ubisoft Wallet</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Stok</label>
                            <input type="number" name="stok" required
                                   class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Harga</label>
                            <input type="number" name="harga" required
                                   class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Masuk</label>
                        <input type="date" name="tanggal" required
                               class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                    </div>
                    <button type="submit" class="w-full bg-[#1b2838] text-white py-3 rounded-lg font-bold hover:bg-black transition-all">
                        Simpan Produk
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-6 italic">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png" class="w-20 opacity-50" alt="icon">
                    <div>
                        <h3 class="text-xl font-bold uppercase tracking-widest text-gray-400">Statistik Produk</h3>
                        <p class="text-sm text-gray-400 italic">Total: {{ count($data) }} Produk Terdaftar</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 bg-gray-50 border-b flex justify-between items-center">
                        <h2 class="font-bold uppercase italic text-sm">Data Produk</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-100 text-gray-600 uppercase text-[10px] font-bold">
                                <tr>
                                    <th class="p-4">Kode</th>
                                    <th class="p-4">Nama</th>
                                    <th class="p-4">Kategori</th>
                                    <th class="p-4">Stok</th>
                                    <th class="p-4">Harga</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($data as $item) <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="p-4 font-mono text-gray-400 text-xs">{{ $item->kode_barang }}</td>
                                    <td class="p-4 font-bold text-gray-800 tracking-tight">{{ $item->nama_barang }}</td>
                                    <td class="p-4 text-gray-500">{{ $item->kategori }}</td>
                                    <td class="p-4">{{ $item->stok }}</td>
                                    <td class="p-4 font-bold text-[#5c7e10]">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="p-4 text-center">
                                        <button class="text-blue-500 hover:underline font-bold px-2">Edit</button>
                                        <a href="{{ route('produk.delete', $item->id) }}" 
                                           onclick="return confirm('Yakin mau hapus produk ini?')"
                                           class="text-red-500 hover:underline font-bold px-2 cursor-pointer">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                
                                @if(count($data) == 0)
                                <tr>
                                    <td colspan="6" class="p-10 text-center text-gray-400 italic">Belum ada data produk.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection