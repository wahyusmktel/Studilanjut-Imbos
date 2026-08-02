<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Alumni extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nama_alumni',
        'jenis_perguruan_tinggi_id',
        'nama_universitas',
        'foto',
        'tahun_lulusan',
        'status'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function jenisPt()
    {
        return $this->belongsTo(JenisPt::class, 'jenis_perguruan_tinggi_id');
    }
}
