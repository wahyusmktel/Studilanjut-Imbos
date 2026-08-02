<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonials extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id', 'rating', 'isi_testimonial', 'status'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
