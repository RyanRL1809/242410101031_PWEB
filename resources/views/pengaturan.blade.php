@extends('app')

@section('title', 'Steam Wallet Store | Pengaturan')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-700 shadow-sm">
        <h1 class="text-3xl font-black text-[#1b2838] dark:text-white uppercase italic tracking-tighter mb-2">⚙️ Pengaturan Preferensi</h1>
        <p class="text-gray-500 dark:text-gray-400 font-medium mb-8">Sesuaikan kenyamanan tampilan Steam Store lo di sini.</p>

        <form id="preferences-form" class="space-y-6">
            <div>
                <label class="block text-sm font-black text-gray-400 dark:text-gray-300 uppercase tracking-widest mb-3">Pilihan Tema</label>
                <div class="grid grid-cols-3 gap-4">
                    @foreach(['light' => '☀️ Light Mode', 'dark' => '🌙 Dark Mode', 'system' => '💻 System'] as $key => $label)
                    <label class="flex items-center justify-center p-4 border dark:border-gray-600 rounded-2xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                        <input type="radio" name="theme" value="{{ $key }}" class="mr-3 text-[#66c0f4] focus:ring-[#66c0f4]" {{ $theme == $key ? 'checked' : '' }}>
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label for="font_size" class="block text-sm font-black text-gray-400 dark:text-gray-300 uppercase tracking-widest mb-3">Ukuran Font</label>
                <select id="font_size" name="font_size" class="w-full p-4 border dark:border-gray-600 bg-white dark:bg-gray-700 rounded-2xl font-bold text-gray-700 dark:text-gray-200 focus:ring-[#66c0f4] outline-none">
                    <option value="kecil" {{ $fontSize == 'kecil' ? 'selected' : '' }}>Kecil (14px)</option>
                    <option value="normal" {{ $fontSize == 'normal' ? 'selected' : '' }}>Normal (16px)</option>
                    <option value="besar" {{ $fontSize == 'besar' ? 'selected' : '' }}>Besar (18px)</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-[#5c7e10] hover:bg-[#78a315] text-white py-4 rounded-2xl font-black text-lg shadow-lg transition-all">
                SIMPAN PREFERENSI
            </button>
        </form>
    </div>
</div>
@endsection