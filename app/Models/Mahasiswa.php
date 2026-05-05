<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim', 'nama', 'email', 'jurusan', 'ipk', 'semester', 'aktif', 'foto'
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'ipk' => 'double',
        'semester' => 'integer',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function mataKuliahs()
    {
        return $this->belongsToMany(MataKuliah::class, 'krs');
    }
}