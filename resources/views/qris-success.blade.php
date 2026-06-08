@extends('app')

@section('title', 'Pembayaran Berhasil')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-black text-[#1b2838]">Pembayaran Direkam</h1>
                <p class="text-gray-500 mt-2">Pesanan kamu telah dicatat sebagai proses. Tunggu konfirmasi admin untuk status akhir.</p>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                    <p class="text-xs uppercase tracking-widest text-gray-400 mb-4">Detail Pesanan</p>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Nomor Pesanan</span>
                            <span class="font-semibold">#{{ $order->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Produk</span>
                            <span class="font-semibold">{{ optional($order->product)->nama_barang ?? 'Voucher' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Jumlah</span>
                            <span class="font-semibold">{{ $order->quantity }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Metode Pembayaran</span>
                            <span class="font-semibold">{{ $order->payment_method }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Status</span>
                            <span class="font-semibold text-yellow-600">Proses</span>
                        </div>
                        <div class="flex justify-between pt-4 border-t border-gray-200">
                            <span class="font-bold">Total Dibayar</span>
                            <span class="font-bold text-[#1b2838]">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-gray-100 bg-blue-50 p-6">
                    <p class="text-xs uppercase tracking-widest text-blue-700 mb-4">Langkah Selanjutnya</p>
                    <ol class="list-decimal list-inside text-sm space-y-3 text-blue-900">
                        <li>Simpan nomor pesanan kamu.</li>
                        <li>Periksa email atau halaman history untuk detail lebih lanjut.</li>
                        <li>Jika perlu, hubungi admin untuk konfirmasi manual.</li>
                    </ol>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-3xl bg-[#1b2838] px-8 py-4 text-sm font-black uppercase text-white shadow-lg hover:bg-black transition-all">
                    Kembali ke Home
                </a>
            </div>
        </div>
    </div>
@endsection
