<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nim' => '242410101001',
                'nama' => 'Liem',
                'email' => 'liem@mail.unej.ac.id',
                'jurusan' => 'SI',
                'ipk' => 3.85,
                'semester' => 4,
                'aktif' => true,
                'foto' => null
            ],
            [
                'nim' => '242410101002',
                'nama' => 'Ryan',
                'email' => 'ryan@mail.unej.ac.id',
                'jurusan' => 'SI',
                'ipk' => 3.70,
                'semester' => 4,
                'aktif' => true,
                'foto' => null
            ],
            [
                'nim' => '242410101003',
                'nama' => 'Mark',
                'email' => 'mark@mail.unej.ac.id',
                'jurusan' => 'TI',
                'ipk' => 3.50,
                'semester' => 2,
                'aktif' => false,
                'foto' => null
            ],
        ];

        foreach ($data as $item) {
            Mahasiswa::create($item);
        }
    }
}