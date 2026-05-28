<x-guest-layout>
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#5c7e10]/10 mb-4">
            <svg class="w-8 h-8 text-[#5c7e10]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
        <h2 class="text-3xl font-black text-[#1b2838] dark:text-white uppercase italic tracking-tighter">
            Join The <span class="text-[#5c7e10]">Squad!</span>
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-medium">Bikin akun baru dan dapetin harga termurah se-Jember.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Username')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="name" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#5c7e10] focus:ring-[#5c7e10] rounded-xl transition-all" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Player" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="email" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#5c7e10] focus:ring-[#5c7e10] rounded-xl transition-all" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="gamer@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="password" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#5c7e10] focus:ring-[#5c7e10] rounded-xl transition-all"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-xs" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full p-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-[#5c7e10] focus:ring-[#5c7e10] rounded-xl transition-all"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-6">
            <x-primary-button class="w-full justify-center bg-[#1b2838] dark:bg-[#66c0f4] hover:bg-[#2c3e50] dark:hover:bg-[#4a90e2] focus:ring-[#1b2838] dark:focus:ring-[#66c0f4] text-white dark:text-[#1b2838] py-3.5 rounded-xl font-black text-lg uppercase tracking-widest transition-all shadow-lg border-none">
                {{ __('Daftar Akun') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Udah punya akun? <a href="{{ route('login') }}" class="text-[#5c7e10] font-bold hover:underline">Gas Login</a></p>
        </div>
    </form>
</x-guest-layout>
