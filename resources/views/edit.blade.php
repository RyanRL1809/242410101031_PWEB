@extends('app')

@section('title', 'Edit Produk')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Produk</h1>
            <p class="text-gray-500">Perbarui data produk yang sudah tersimpan.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium mb-1">Kode Barang</label>
                    <input type="text" name="kode_barang" required
                        value="{{ old('kode_barang', $product->kode_barang) }}"
                        class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Nama Barang</label>
                    <input type="text" name="nama_barang" required
                        value="{{ old('nama_barang', $product->nama_barang) }}"
                        class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Kategori</label>
                    <select name="kategori" required
                        class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                        <option value="Steam Wallet" {{ old('kategori', $product->kategori) == 'Steam Wallet' ? 'selected' : '' }}>Steam Wallet</option>
                        <option value="Epic Games Wallet" {{ old('kategori', $product->kategori) == 'Epic Games Wallet' ? 'selected' : '' }}>Epic Games Wallet</option>
                        <option value="Ubisoft Wallet" {{ old('kategori', $product->kategori) == 'Ubisoft Wallet' ? 'selected' : '' }}>Ubisoft Wallet</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Stok</label>
                        <input type="number" name="stok" required
                            value="{{ old('stok', $product->stok) }}"
                            class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Harga</label>
                        <input type="number" name="harga" required
                            value="{{ old('harga', $product->harga) }}"
                            class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" required
                        value="{{ old('tanggal_masuk', $product->tanggal_masuk) }}"
                        class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="bg-[#1b2838] text-white px-6 py-3 rounded-lg font-bold hover:bg-black transition-all">
                        Update Produk
                    </button>
                    <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
