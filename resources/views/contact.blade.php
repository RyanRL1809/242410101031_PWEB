@extends('app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 mt-10">
    <h1 class="text-4xl font-black text-[#1b2838] uppercase italic mb-6">Hubungi Kami</h1>
    <p class="text-gray-500 mb-8">Punya kendala pas top-up? Admin kami siap bantu 24/7 bro!</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-6 bg-[#66c0f4]/10 rounded-2xl">
            <h3 class="font-black text-[#1b2838] uppercase text-xs mb-2">WhatsApp Admin</h3>
            <p class="text-lg font-bold text-[#66c0f4]">+62 812-3456-7890</p>
        </div>
        <div class="p-6 bg-[#5c7e10]/10 rounded-2xl">
            <h3 class="font-black text-[#1b2838] uppercase text-xs mb-2">Email Support</h3>
            <p class="text-lg font-bold text-[#5c7e10]">242410101031@mail.unej.ac.id</p>
        </div>
    </div>
</div>
@endsection