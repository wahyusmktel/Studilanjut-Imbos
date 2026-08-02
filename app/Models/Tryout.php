<?php

namespace App\Models;

use App\Scopes\TahunPelajaranScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tryout extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tahun_pelajaran_id',
        'nama_tryout',
        'status'
    ];

    protected $keyType = 'uuid';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TahunPelajaranScope);

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    // public function tahunPelajaran()
    // {
    //     return $this->belongsTo(TahunPelajaran::class);
    // }

    public function tahunPelajaran()
    {
        return $this->belongsTo(TahunPelajaran::class, 'tahun_pelajaran_id', 'id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'tryout_id', 'id');
    }
}
