<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AbsensiDetail extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'absensi_id', 'siswa_id', 'kehadiran'
    ];

    // Mengaktifkan timestamps
    public $timestamps = true;

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
