@props(['judul', 'nilai', 'ikon', 'warna'])

<div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5 hover:shadow-lg transition-all duration-300">
    <div class="{{ $warna }} w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shadow-inner">
        {!! $ikon !!}
    </div>
    
    <div>
        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ $judul }}</h3>
        <p class="text-3xl font-black text-[#1b2838]">{{ $nilai }}</p>
    </div>
</div>