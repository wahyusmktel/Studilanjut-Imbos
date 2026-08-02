<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Komentar extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['berita_id', 'nama_komentator', 'isi_komentar', 'status'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }

    // public function tanggapan()
    // {
    //     return $this->hasOne(Tanggapan::class, 'komentar_id');
    // }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'komentar_id');
    }
}
