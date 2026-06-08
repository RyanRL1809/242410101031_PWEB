<section class="space-y-6">
    <header>
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">{{ __('Informasi Profil') }}</h2>
                <p class="mt-2 text-sm text-slate-600">{{ __('Perbarui nama, email, dan foto profil Anda agar tetap terbaru.') }}</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                <p class="font-semibold">{{ __('Akun aktif') }}</p>
                <p class="mt-1">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')

        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
            <div class="grid gap-6 lg:grid-cols-3 lg:items-center">
                <div>
                    <x-input-label for="profile_image" :value="__('Foto Profil')" />
                    <p class="mt-1 text-sm text-slate-500">{{ __('Upload foto untuk tampilkan identitas Anda.') }}</p>
                </div>

                <div class="lg:col-span-2">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <div class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-full bg-white text-3xl font-semibold text-slate-600 shadow-sm">
                            @if ($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile image" class="h-full w-full object-cover" />
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="flex-1">
                            <input id="profile_image" name="profile_image" type="file" class="block w-full text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:text-white file:shadow-sm" accept=".jpg,.jpeg,.png,.webp">
                            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-6">
                <div>
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-3 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-700">
                            <p>{{ __('Alamat email Anda belum terverifikasi.') }}</p>
                            <button form="send-verification" class="mt-2 inline-flex rounded-full bg-amber-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">{{ __('Kirim ulang tautan verifikasi') }}</button>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm font-medium text-emerald-600">{{ __('Tautan verifikasi baru telah dikirim ke email Anda.') }}</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-slate-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
