<x-guest-layout>
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#66c0f4]/10 mb-4">
            <svg class="w-8 h-8 text-[#66c0f4]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
        </div>
        <h2 class="text-3xl font-black text-[#1b2838] dark:text-white uppercase italic tracking-tighter">
            Welcome <span class="text-[#66c0f4]">Back!</span>
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-medium">Masuk untuk top up Steam Wallet lo lagi.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="email" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#66c0f4] focus:ring-[#66c0f4] rounded-xl transition-all" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="gamer@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="password" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#66c0f4] focus:ring-[#66c0f4] rounded-xl transition-all"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-[#66c0f4] shadow-sm focus:ring-[#66c0f4]" name="remember">
                <span class="ms-2 text-sm font-medium text-gray-600 dark:text-gray-400 group-hover:text-[#1b2838] dark:group-hover:text-white transition-colors">{{ __('Ingat Saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-bold text-[#66c0f4] hover:text-[#4a90e2] transition-colors" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center bg-[#5c7e10] hover:bg-[#78a315] active:bg-[#48630c] focus:ring-[#5c7e10] text-white py-3.5 rounded-xl font-black text-lg uppercase tracking-widest transition-all shadow-lg border-none">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Belum punya akun? <a href="{{ route('register') }}" class="text-[#66c0f4] font-bold hover:underline">Daftar di sini</a></p>
        </div>
    </form>
</x-guest-layout>
