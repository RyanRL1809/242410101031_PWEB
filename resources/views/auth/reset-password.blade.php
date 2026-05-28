<x-guest-layout>
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#5c7e10]/10 mb-4">
            <svg class="w-8 h-8 text-[#5c7e10]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
        </div>
        <h2 class="text-3xl font-black text-[#1b2838] dark:text-white uppercase italic tracking-tighter">
            Bikin <span class="text-[#5c7e10]">Baru!</span>
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-medium">Bikin sandi yang kuat dan jangan sampai lupa lagi ya.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="email" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#5c7e10] focus:ring-[#5c7e10] rounded-xl transition-all opacity-70 cursor-not-allowed" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password Baru')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="password" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#5c7e10] focus:ring-[#5c7e10] rounded-xl transition-all" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#5c7e10] focus:ring-[#5c7e10] rounded-xl transition-all"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center bg-[#5c7e10] hover:bg-[#78a315] focus:ring-[#5c7e10] text-white py-3.5 rounded-xl font-black text-lg uppercase tracking-widest transition-all shadow-lg border-none">
                {{ __('Reset & Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
