@extends('app')

@section('title', 'Bantuan & Panduan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="bg-[#1b2838] rounded-[3rem] p-12 text-center text-white shadow-2xl mb-16 relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-4xl font-black mb-4 italic uppercase">Butuh Bantuan?</h2>
                <p class="text-blue-100 mb-10 opacity-80 font-medium">Pilih panduan yang kamu butuhkan untuk mempermudah transaksimu.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#beli" class="bg-white text-[#1b2838] px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform shadow-lg">
                        Cara Beli Voucher
                    </a>
                    <a href="#redeem" class="bg-[#66c0f4] text-[#1b2838] px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform shadow-lg">
                        Cara Redeem Steam
                    </a>
                    <a href="#kontak" class="bg-transparent border-2 border-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-[#1b2838] transition-all">
                        Hubungi CS
                    </a>
                </div>
            </div>
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <section id="beli" class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="bg-green-100 p-3 rounded-2xl text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-800 uppercase italic">Cara Membeli Voucher</h3>
                </div>
                <ol class="space-y-4 text-gray-600">
                    <li class="flex gap-4">
                        <span class="font-black text-[#66c0f4]">01.</span>
                        <p>Pilih nominal voucher yang kamu inginkan di halaman <span class="font-bold">Home</span>.</p>
                    </li>
                    <li class="flex gap-4">
                        <span class="font-black text-[#66c0f4]">02.</span>
                        <p>Isi data email dan pilih metode pembayaran yang tersedia.</p>
                    </li>
                    <li class="flex gap-4">
                        <span class="font-black text-[#66c0f4]">03.</span>
                        <p>Klik tombol <span class="font-bold text-red-500">Beli</span> dan selesaikan pembayaran sesuai instruksi.</p>
                    </li>
                    <li class="flex gap-4">
                        <span class="font-black text-[#66c0f4]">04.</span>
                        <p>Voucher akan dikirim otomatis ke email atau muncul di riwayat transaksi.</p>
                    </li>
                </ol>
            </section>

            <section id="redeem" class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="bg-blue-100 p-3 rounded-2xl text-[#66c0f4]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-800 uppercase italic">Cara Redeem Steam</h3>
                </div>
                <ul class="space-y-4 text-gray-600">
                    <li class="flex gap-4">
                        <span class="font-black text-[#1b2838]">✓</span>
                        <p>Buka aplikasi Steam dan login ke akun kamu.</p>
                    </li>
                    <li class="flex gap-4">
                        <span class="font-black text-[#1b2838]">✓</span>
                        <p>Klik menu <span class="font-bold">Games</span> di pojok kiri atas.</p>
                    </li>
                    <li class="flex gap-4">
                        <span class="font-black text-[#1b2838]">✓</span>
                        <p>Pilih <span class="italic font-medium">"Redeem a Steam Wallet Code"</span>.</p>
                    </li>
                    <li class="flex gap-4">
                        <span class="font-black text-[#1b2838]">✓</span>
                        <p>Masukkan kode yang kamu dapatkan, lalu klik <span class="font-bold">Confirm</span>.</p>
                    </li>
                </ul>
            </section>
        </div>
        <section id="kontak" class="max-w-4xl mx-auto mt-16 mb-20 px-6">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <div class="text-center mb-8">
                    <h3 class="text-xl font-black text-[#1b2838] uppercase italic">Hubungi Kami</h3>
                    <p class="text-sm text-gray-500 mt-1">Jika butuh bantuan lebih lanjut, silakan hubungi tim kami:</p>
                </div>

                <div class="flex flex-col md:flex-row justify-center items-center gap-8 md:gap-12">
                    <div class="flex items-center gap-3">
                        <div class="text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                            </svg>
    
                        </div>
                        
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">WhatsApp</p>
                            <a href="https://wa.me/082140479007" class="text-sm font-bold text-gray-800 hover:text-green-600">0821-2345-678</a>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-pink-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                                <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Instagram</p>
                            <a href="https://www.instagram.com/rynrlim_" class="text-sm font-bold text-gray-800 hover:text-pink-600">@rynrlim_</a>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                            </svg>
                        </div>
                
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Email</p>
                            <a href="mailto:242410101031@mail.unej.ac.id" class="text-sm font-bold text-gray-800 hover:text-blue-600">242410101031@mail.unej.ac.id</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection