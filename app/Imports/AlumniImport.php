<?php

namespace App\Imports;

use App\Models\Alumni;
use App\Models\JenisPt;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AlumniImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Ambil jenis_perguruan_tinggi_id dari nama_jenis_pt
            $jenisPerguruanTinggi = JenisPt::where('nama_jenis_pt', $row['nama_jenis_pt'])->first();

            if ($jenisPerguruanTinggi) {
                Alumni::updateOrCreate(
                    ['nama_alumni' => $row['nama_alumni']],
                    [
                        'nama_alumni' => $row['nama_alumni'],
                        'jenis_perguruan_tinggi_id' => $jenisPerguruanTinggi->id,
                        'nama_universitas' => $row['nama_universitas'],
                        'foto' => $row['foto'], // Pastikan foto sudah diunggah dan disimpan di direktori yang benar
                        'tahun_lulusan' => $row['tahun_lulusan'],
                        // 'status' => $row['status'], // Jika ada
                    ]
                );
            } else {
                // Log atau berikan pesan error jika jenis perguruan tinggi tidak ditemukan
            }
        }
    }
}
