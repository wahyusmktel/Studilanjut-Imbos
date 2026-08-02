<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'tryout_id', 'mata_pelajaran_id', 'siswa_id', 'nilai', 'status'
    ];

    protected $keyType = 'uuid';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    protected $casts = [
        'nilai' => 'float',
    ];

    public function tryout()
    {
        return $this->belongsTo(Tryout::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
