@extends('app')

@section('title', 'History Pembelian')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="mb-8">
            <h2 class="text-3xl font-black text-[#1b2838] uppercase italic">Riwayat Pembelian</h2>
            <p class="text-gray-500">Lihat dan pantau semua transaksi yang telah dilakukan.</p>
        </div>

        <div class="flex flex-col md:flex-row gap-6 mb-10">
            <div class="flex-1 bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex gap-2">
                <input type="text" placeholder="Cari email atau jenis voucher..."
                       class="flex-1 p-2 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4] transition-all">
                <button class="bg-[#1b2838] text-white px-6 py-2 rounded-xl font-bold hover:bg-black transition-all">
                    Cari
                </button>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-6 overflow-x-auto">
                <span class="text-sm font-bold text-gray-400 uppercase tracking-widest border-r pr-4">Filter</span>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" class="w-4 h-4 accent-green-500 rounded">
                        <span class="text-sm font-medium text-gray-600 group-hover:text-green-600">Success</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" class="w-4 h-4 accent-yellow-500 rounded">
                        <span class="text-sm font-medium text-gray-600 group-hover:text-yellow-600">Pending</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" class="w-4 h-4 accent-red-500 rounded">
                        <span class="text-sm font-medium text-gray-600 group-hover:text-red-600">Failed</span>
                    </label>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-3xl border border-green-100 bg-green-50 p-5 text-sm text-green-900">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-[#1b2838] text-white italic">
                        <tr>
                            <th class="p-5 uppercase text-xs tracking-widest">No</th>
                            <th class="p-5 uppercase text-xs tracking-widest">Email Pembeli</th>
                            <th class="p-5 uppercase text-xs tracking-widest">Voucher</th>
                            <th class="p-5 uppercase text-xs tracking-widest text-center">Jumlah</th>
                            <th class="p-5 uppercase text-xs tracking-widest text-right">Total Bayar</th>
                            <th class="p-5 uppercase text-xs tracking-widest text-center">Status</th>
                            @if(auth()->user()->role === 'admin')
                                <th class="p-5 uppercase text-xs tracking-widest text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-5 font-mono text-gray-400 text-sm">{{ $order->id }}</td>
                            <td class="p-5 font-bold text-gray-800">{{ $order->email }}</td>
                            <td class="p-5 text-gray-600">{{ $order->product->nama_barang ?? 'Produk tidak diketahui' }}</td>
                            <td class="p-5 text-center text-gray-600 font-medium">{{ $order->quantity }}</td>
                            <td class="p-5 text-right font-black text-[#1b2838]">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="p-5">
                                <div class="flex justify-center">
                                    @if($order->status == 'success')
                                        <span class="bg-green-100 text-green-700 text-[10px] font-black px-3 py-1 rounded-full uppercase italic border border-green-200">
                                            Success
                                        </span>
                                    @elseif($order->status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 text-[10px] font-black px-3 py-1 rounded-full uppercase italic border border-yellow-200">
                                            Pending
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 text-[10px] font-black px-3 py-1 rounded-full uppercase italic border border-red-200">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            @if(auth()->user()->role === 'admin')
                                <td class="p-5 text-center">
                                    <form action="{{ route('history.updateStatus', ['order' => $order->id]) }}" method="POST" class="flex flex-col gap-2 items-center justify-center">
                                        @csrf
                                        <select name="status" class="w-full p-2 text-sm bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#66c0f4]">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="success" {{ $order->status === 'success' ? 'selected' : '' }}>Success</option>
                                            <option value="failed" {{ $order->status === 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                        <button type="submit" class="mt-2 px-4 py-2 bg-[#1b2838] text-white text-xs uppercase rounded-xl font-black hover:bg-black transition-all">Update</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'admin' ? 7 : 6 }}" class="p-8 text-center text-gray-500">Belum ada riwayat pembelian untuk akun ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-sm text-gray-400 italic">Pesanan bermasalah? Hubungi kami lewat halaman <a href="{{ url('/help') }}" class="text-[#66c0f4] hover:underline font-bold">Bantuan</a>.</p>
        </div>
    </div>
@endsection
