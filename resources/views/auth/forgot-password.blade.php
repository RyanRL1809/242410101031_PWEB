<x-guest-layout>
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#66c0f4]/10 mb-4">
            <svg class="w-8 h-8 text-[#66c0f4]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <h2 class="text-3xl font-black text-[#1b2838] dark:text-white uppercase italic tracking-tighter">
            Lupa <span class="text-[#66c0f4]">Password?</span>
        </h2>
    </div>

    <div class="mb-6 text-sm text-gray-500 dark:text-gray-400 font-medium text-center">
        {{ __('Santai bro, masukin aja email lu di bawah. Nanti sistem kita bakal ngirim link buat bikin password baru biar lu bisa lanjut top up lagi.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="email" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#66c0f4] focus:ring-[#66c0f4] rounded-xl transition-all" type="email" name="email" :value="old('email')" required autofocus placeholder="gamer@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center bg-[#1b2838] dark:bg-[#66c0f4] hover:bg-[#2c3e50] dark:hover:bg-[#4a90e2] text-white dark:text-[#1b2838] py-3.5 rounded-xl font-black text-lg uppercase tracking-widest transition-all shadow-lg border-none">
                {{ __('Kirim Link Reset') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 dark:text-gray-400 font-bold hover:text-[#66c0f4] dark:hover:text-[#66c0f4] transition-colors">← Balik ke Login</a>
        </div>
    </form>
</x-guest-layout>
