<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable; // Untuk autentikasi

class Guru extends Authenticatable // Menggunakan Authenticatable untuk autentikasi
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nama', 'nip', 'mata_pelajaran_id', 'tempat_lahir', 'tanggal_lahir', 'foto','password','foto_sampul','motto'
    ];

    // Menyembunyikan kolom password saat model dikonversi ke array atau JSON
    protected $hidden = [
        'password',
    ];

    // Pastikan password selalu di-hash
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }
}
