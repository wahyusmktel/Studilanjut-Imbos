<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OrangTuaModel extends Authenticatable
{
    use HasFactory, HasUuids;

    protected $table = 'siswas';

    protected $fillable = [
        'kelas_id', 'program_bimbel_id', 'nama_siswa', 'tgl_lahir', 'tmpt_lahir', 'no_hp', 'nis', 'password', 'foto_siswa', 'status'
    ];

    protected $hidden = [
        'password',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function programBimbel()
    {
        return $this->belongsTo(ProgramBimbel::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
