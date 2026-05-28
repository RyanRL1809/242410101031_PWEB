<x-guest-layout>
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-500/10 mb-4">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
        </div>
        <h2 class="text-3xl font-black text-[#1b2838] dark:text-white uppercase italic tracking-tighter">
            Security <span class="text-red-500">Check</span>
        </h2>
    </div>

    <div class="mb-6 text-sm text-gray-500 dark:text-gray-400 font-medium text-center">
        {{ __('Area ini butuh akses tingkat tinggi bro. Tolong masukin ulang password lu buat mastiin ini beneran lu.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password Saat Ini')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="password" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-red-500 focus:ring-red-500 rounded-xl transition-all"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center bg-red-500 hover:bg-red-600 focus:ring-red-500 text-white py-3.5 rounded-xl font-black text-lg uppercase tracking-widest transition-all shadow-lg border-none">
                {{ __('Konfirmasi Akses') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
