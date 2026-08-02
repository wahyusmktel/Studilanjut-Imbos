<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JenisPt extends Model
{
    use HasFactory;

    protected $table = 'jenis_perguruan_tinggis';

    protected $fillable = ['nama_jenis_pt', 'status'];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function alumnis()
    {
        return $this->hasMany(Alumni::class, 'jenis_perguruan_tinggi_id');
    }
}
