<x-guest-layout>
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-500/10 mb-4">
            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h2 class="text-3xl font-black text-[#1b2838] dark:text-white uppercase italic tracking-tighter">
            Verifikasi <span class="text-yellow-500">Email!</span>
        </h2>
    </div>

    <div class="mb-4 text-sm text-gray-500 dark:text-gray-400 font-medium text-center">
        {{ __('Welcome to the club! Sebelum belanja, tolong cek inbox email lu dan klik link verifikasi yang kita kirim. Kalau gak masuk, klik tombol di bawah buat kirim ulang.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-bold text-sm text-center text-[#5c7e10] bg-[#5c7e10]/10 p-3 rounded-lg border border-[#5c7e10]/20">
            {{ __('Link verifikasi baru udah kita tembak ke email lu, silakan dicek bro!') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full justify-center bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-500 text-white py-3.5 rounded-xl font-black text-lg uppercase tracking-widest transition-all shadow-lg border-none">
                {{ __('Kirim Ulang Link') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm font-bold text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors">
                {{ __('Atau Log Out dulu') }}
            </button>
        </form>
    </div>
</x-guest-layout>
