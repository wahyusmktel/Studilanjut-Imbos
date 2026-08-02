<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Tanggapan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tanggapan_komentars';

    protected $fillable = ['komentar_id', 'author_id', 'isi_tanggapan', 'status'];

    public function komentar()
    {
        return $this->belongsTo(Komentar::class);
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
}
