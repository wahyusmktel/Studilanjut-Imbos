<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SertifikatPerkembangan extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['siswa_id', 'no_sertifikat', 'status'];

    protected $keyType = 'string';
    public $incrementing = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
