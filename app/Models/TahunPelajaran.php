<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TahunPelajaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_pelajarans';

    protected $fillable = [
        'id',
        'nama_tahun_pelajaran',
        'semester',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public $incrementing = false;
    protected $keyType = 'uuid';

    public function tryouts()
    {
        return $this->hasMany(Tryout::class, 'tahun_pelajaran_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
