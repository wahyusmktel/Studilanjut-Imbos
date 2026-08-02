<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SettingSertifikat extends Model
{
    use HasFactory;

    protected $table = 'setting_sertifikats';

    protected $fillable = [
        'id',
        'nama_template',
        'logo_1',
        'logo_2',
        'watermark',
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
}
