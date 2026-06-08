@extends('app')

@section('title', 'Admin - Daftar Akun Pelanggan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Akun Pelanggan</h1>
            <p class="text-gray-500">Lihat semua akun pelanggan yang terdaftar.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total pelanggan terdaftar:</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $users->count() }}</p>
                </div>
                <div class="text-sm text-gray-500">Diurutkan berdasarkan pendaftaran terbaru.</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-4">Nama</th>
                            <th class="px-4 py-4">Email</th>
                            <th class="px-4 py-4">Role</th>
                            <th class="px-4 py-4">Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-4 py-4 font-semibold text-gray-800">{{ $user->name }}</td>
                                <td class="px-4 py-4 text-gray-600">{{ $user->email }}</td>
                                <td class="px-4 py-4 text-gray-600">{{ ucfirst($user->role) }}</td>
                                <td class="px-4 py-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-gray-500 italic">Belum ada akun pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
