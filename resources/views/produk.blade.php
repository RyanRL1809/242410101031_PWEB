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

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                    @csrf <div>
                        <label class="block text-sm font-medium mb-1">Kode Barang</label>
                        <div class="w-full p-2 bg-gray-100 border rounded-lg font-mono text-gray-600">
                            {{ $kodeBerikutnya }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Barang</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Steam Wallet 12K"
                               class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Kategori</label>
                        <select name="kategori" required class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Steam Wallet"    {{ old('kategori') == 'Steam Wallet' ? 'selected' : '' }}>Steam Wallet</option>
                            <option value="Epic Games Wallet">Epic Games Wallet</option>
                            <option value="Ubisoft Wallet">Ubisoft Wallet</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Stok</label>
                            <input type="number" name="stok" value="{{ old('stok') }}" required
                                   class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Harga</label>
                            <input type="number" name="harga" value="{{ old('harga') }}" required
                                   class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Masuk</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" required
                               class="w-full p-2 bg-gray-50 border rounded-lg outline-none focus:border-blue-500">
                    </div>
                    <button type="submit" class="w-full bg-[#1b2838] text-white py-3 rounded-lg font-bold hover:bg-black transition-all">
                        Simpan Produk
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col gap-6 italic">
                    <div class="flex items-center gap-6">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png" class="w-20 opacity-50" alt="icon">
                        <div>
                            <h3 class="text-xl font-bold uppercase tracking-widest text-gray-400">Statistik Produk</h3>
                            <p class="text-sm text-gray-400 italic">Total: {{ $data->total() }} Produk Terdaftar</p>
                        </div>
                    </div>

                    <div class="grid gap-4">
                        <div class="rounded-3xl border border-gray-100 bg-gray-50 p-4">
                            <p class="text-sm text-gray-500">Produk paling banyak dibeli (berdasarkan transaksi sukses):</p>
                        </div>
                        <div class="rounded-3xl border border-gray-100 bg-white p-4">
                            @if($topProducts->isEmpty())
                                <p class="text-gray-500 text-sm">Belum ada data penjualan yang cukup.</p>
                            @else
                                <ol class="list-decimal list-inside space-y-3 text-sm text-gray-700">
                                    @foreach($topProducts as $product)
                                        <li class="flex items-start justify-between gap-4">
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $product->product?->nama_barang ?? 'Produk tidak ditemukan' }}</p>
                                                <p class="text-xs text-gray-500">Kategori: {{ $product->product?->kategori ?? 'Lainnya' }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-black text-[#1b2838]">{{ $product->total_quantity }} voucher</p>
                                                <p class="text-xs text-gray-500">Rp{{ number_format($product->total_revenue, 0, ',', '.') }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            @endif
                        </div>
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
                                        <a href="{{ route('products.edit', $item->id) }}"
                                           class="text-blue-500 hover:underline font-bold px-2">
                                            Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin mau hapus produk ini?')"
                                                class="text-red-500 hover:underline font-bold px-2 cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
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
                    <div class="border-t border-gray-100 bg-white px-4 py-4">
                        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                            <p class="text-sm text-gray-500">
                                Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }}
                                dari {{ $data->total() }} produk
                            </p>
                            <div>
                                {{ $data->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    console.log("Halaman Manajemen Produk Siap Bro!");
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            console.log('Sedang menyimpan produk...');
        });
    });
</script>
@endpush
