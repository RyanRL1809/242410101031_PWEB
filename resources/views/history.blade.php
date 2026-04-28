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
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                            $history = [
                                ['id' => 1, 'email' => 'rayn@email.com', 'item' => 'Steam 45K', 'qty' => 2, 'total' => 'Rp90.000', 'status' => 'success'],
                                ['id' => 2, 'email' => 'sight@email.com', 'item' => 'Steam 90K', 'qty' => 1, 'total' => 'Rp90.000', 'status' => 'pending'],
                                ['id' => 3, 'email' => 'bless@email.com', 'item' => 'Steam 120K', 'qty' => 1, 'total' => 'Rp120.000', 'status' => 'failed'],
                            ];
                        @endphp

                        @foreach($history as $h)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-5 font-mono text-gray-400 text-sm">{{ $h['id'] }}</td>
                            <td class="p-5 font-bold text-gray-800">{{ $h['email'] }}</td>
                            <td class="p-5 text-gray-600">{{ $h['item'] }}</td>
                            <td class="p-5 text-center text-gray-600 font-medium">{{ $h['qty'] }}</td>
                            <td class="p-5 text-right font-black text-[#1b2838]">{{ $h['total'] }}</td>
                            <td class="p-5">
                                <div class="flex justify-center">
                                    @if($h['status'] == 'success')
                                        <span class="bg-green-100 text-green-700 text-[10px] font-black px-3 py-1 rounded-full uppercase italic border border-green-200">
                                            Success
                                        </span>
                                    @elseif($h['status'] == 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 text-[10px] font-black px-3 py-1 rounded-full uppercase italic border border-yellow-200">
                                            Pending
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 text-[10px] font-black px-3 py-1 rounded-full uppercase italic border border-red-200">
                                            Failed
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-sm text-gray-400 italic">Pesanan bermasalah? Hubungi kami lewat halaman <a href="{{ url('/help') }}" class="text-[#66c0f4] hover:underline font-bold">Bantuan</a>.</p>
        </div>
    </div>
@endsection