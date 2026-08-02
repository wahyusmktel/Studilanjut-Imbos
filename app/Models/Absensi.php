<?php

namespace App\Models;

use App\Scopes\TahunPelajaranScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Absensi extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'guru_id',
        'kelas_id',
        'tanggal',
        'waktu',
        'materi',
        'catatan',
        'foto',
        'tahun_pelajaran_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TahunPelajaranScope);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function tahunPelajaran()
    {
        return $this->belongsTo(TahunPelajaran::class);
    }

    public function details()
    {
        return $this->hasMany(AbsensiDetail::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
