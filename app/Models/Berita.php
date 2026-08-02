<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Berita extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'judul_berita', 
        'isi_berita', 
        'foto', 
        'kategori_id', 
        'author_id', 
        'status', 
        'file'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'berita_id');
    }
    
}
