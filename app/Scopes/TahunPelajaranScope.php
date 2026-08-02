<?php

namespace App\Scopes;

use App\Models\TahunPelajaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Cache;

class TahunPelajaranScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Coba ambil tahun pelajaran aktif dari cache dulu agar lebih cepat
        $tahunAktif = Cache::remember('tahun_pelajaran_aktif', 60, function () {
            // Jika tidak ada di cache, query ke database
            // Menggunakan `true` atau `1` sama saja untuk status boolean/integer
            return TahunPelajaran::where('status', 1)->first();
        });

        // Jika ada tahun pelajaran yang aktif, terapkan filter
        if ($tahunAktif) {
            $builder->where($model->getTable() . '.tahun_pelajaran_id', $tahunAktif->id);
        }
    }
}
