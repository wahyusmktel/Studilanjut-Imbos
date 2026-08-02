<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProgramBimbel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_program',
        'deskripsi_program',
        'icon_program',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public $incrementing = false;

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'program_bimbel_id');
    }
}
