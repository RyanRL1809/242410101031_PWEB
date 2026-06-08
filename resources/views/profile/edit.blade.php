@extends('app')

@section('title', 'Profil Saya')

@section('content')
    <div class="py-12">
        <div class="mx-auto w-full max-w-4xl px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="mx-auto w-full overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-950 shadow-xl">
                <div class="p-6 sm:p-8 text-white">
                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-4">
                            @if(auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile image" class="h-20 w-20 rounded-full object-cover shadow-lg" />
                            @else
                                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white/10 text-2xl font-semibold text-slate-100 shadow-lg">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif

                            <div>
                                <p class="text-sm uppercase tracking-[0.24em] text-slate-300">Akun</p>
                                <h1 class="text-3xl font-bold text-white">{{ auth()->user()->name }}</h1>
                                <p class="mt-1 text-sm text-slate-300">{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <div class="rounded-3xl border border-white/10 bg-white/10 px-4 py-3 text-sm text-slate-200 shadow-inner">
                            <p class="font-semibold text-white">Profil</p>
                            <p class="mt-1">Kelola informasi akun dan keamanan di sini.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto w-full max-w-3xl space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="max-w-xl mx-auto">
                        <h2 class="text-lg font-semibold text-slate-800">Keluar Akun</h2>
                        <p class="mt-1 text-sm text-slate-500">Kamu akan keluar dari sesi ini di perangkat sekarang.</p>

                        <form method="POST" action="{{ route('logout') }}" class="mt-4">
                            @csrf
                            <button type="submit" class="px-5 py-2 rounded-xl bg-[red] text-[white] hover:bg-[darkred] transition-all">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
