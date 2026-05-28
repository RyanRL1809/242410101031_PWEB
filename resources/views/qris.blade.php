@extends('app')

@section('title', 'Pembayaran QRIS')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-black text-[#1b2838]">Pembayaran QRIS</h1>
                    <p class="text-gray-500 mt-2">Scan QRIS di bawah ini untuk menyelesaikan pembayaran pesananmu.</p>
                </div>
                <div class="text-right">
                    <p class="text-sm uppercase text-gray-400">Nomor Pesanan</p>
                    <p class="text-xl font-bold text-[#1b2838]">#{{ $order->id }}</p>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 lg:grid-cols-[1.5fr_1fr] gap-8">
                <div class="space-y-6">
                    <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                        <p class="text-sm text-gray-500 uppercase tracking-widest mb-3">Ringkasan Pesanan</p>
                        <div class="grid gap-3 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Produk</span>
                                <span class="font-semibold">{{ optional($order->product)->nama_barang ?? 'Voucher' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Kategori</span>
                                <span class="font-semibold">{{ optional($order->product)->kategori ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Jumlah</span>
                                <span class="font-semibold">{{ $order->quantity }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Metode</span>
                                <span class="font-semibold">{{ $order->payment_method }}</span>
                            </div>
                            <div class="flex justify-between pt-4 border-t border-gray-200">
                                <span class="font-bold">Total</span>
                                <span class="font-bold text-[#1b2838]">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-gray-100 bg-blue-50 p-6 text-blue-900">
                        <p class="font-bold mb-2">Instruksi Pembayaran</p>
                        <ol class="list-decimal list-inside text-sm space-y-2">
                            <li>Buka aplikasi pembayaran yang mendukung QRIS.</li>
                            <li>Scan kode QR di sisi kanan.</li>
                            <li>Pastikan nominal Rp{{ number_format($order->total, 0, ',', '.') }}.</li>
                            <li>Selesaikan pembayaran dan simpan bukti transaksi.</li>
                        </ol>
                    </div>
                </div>

                <div class="rounded-3xl border border-gray-100 bg-white p-6 text-center">
                    <p class="text-sm uppercase text-gray-400 tracking-widest mb-4">Kode QRIS</p>
                    <div class="inline-block rounded-3xl border border-gray-200 p-4 bg-gray-50">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=280x280&data={{ $qrData }}" alt="QRIS code" class="mx-auto" />
                    </div>
                    <p class="mt-6 text-sm text-gray-500">Kode Transaksi</p>
                    <p class="mt-2 font-bold text-[#1b2838]">{{ $qrisCode }}</p>
                </div>
            </div>

            <div class="mt-10 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="bg-[#f8fafc] rounded-3xl border border-gray-100 p-6 flex-1">
                    <p class="text-sm text-gray-500">Catatan: ini adalah tampilan QRIS simulasi. Jika ingin membuat alur pembayaran nyata, sambungkan dengan gateway pembayaran atau API bank yang sesuai.</p>
                </div>
                <div>
                    <form action="{{ route('beli.complete', ['order' => $order->id]) }}" method="POST" class="mt-2 lg:mt-0">
                        @csrf
                        <button type="submit" class="w-full rounded-3xl bg-[#1b2838] px-6 py-4 text-sm font-black uppercase text-white shadow-lg hover:bg-black transition-all">
                            Continue ke Status Sukses
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
