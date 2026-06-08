<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-center">
                    <h2 class="text-3xl font-black text-gray-900 mb-6">Selamat datang di Dashboard</h2>
                    <p class="text-gray-500 mb-8">Akses cepat ke katalog produk dan mulai beli sekarang.</p>
                    <a href="{{ route('katalog') }}" class="inline-flex items-center justify-center rounded-3xl bg-[#1b2838] px-8 py-4 text-sm font-black uppercase text-white shadow-lg hover:bg-black transition-all">
                        Beli Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
