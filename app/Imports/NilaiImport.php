<?php

namespace App\Imports;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Tryout;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NilaiImport implements ToCollection, WithHeadingRow
{
    protected $columnMapping;

    public function __construct()
    {
        // Ambil semua nama mata pelajaran dari database dan buat peta mapping
        $mataPelajaran = MataPelajaran::all();
        $this->columnMapping = $mataPelajaran->mapWithKeys(function ($item) {
            return [$item->kode_mapel => $item->id];
        })->toArray();
    }

    public function collection(Collection $rows)
    {
        DB::transaction(function() use ($rows) {
            foreach ($rows as $row) {
                // Log the row for debugging
                Log::info('Processing row: ' . json_encode($row));

                // Get Siswa
                $siswa = Siswa::where('nama_siswa', $row['nama_siswa'])->first();
                // $tryout = Tryout::where('nama_tryout', $row['tryout'])->first();
                // Get Tryout with status true
                $tryout = Tryout::where('nama_tryout', $row['tryout'])->where('status', true)->first();

                if (!$siswa) {
                    Log::warning("Siswa dengan nama {$row['nama_siswa']} tidak ditemukan");
                    continue;
                }

                if (!$tryout) {
                    Log::warning("Tryout dengan nama {$row['tryout']} tidak ditemukan");
                    continue;
                }

                // Process each MataPelajaran and save the score
                foreach ($row as $key => $value) {
                    if (!in_array($key, ['no', 'nama_siswa', 'tryout']) && !empty($value)) {
                        if (isset($this->columnMapping[$key])) {
                            $mataPelajaranId = $this->columnMapping[$key];

                            Nilai::updateOrCreate(
                                [
                                    'siswa_id' => $siswa->id,
                                    'mata_pelajaran_id' => $mataPelajaranId,
                                    'tryout_id' => $tryout->id,
                                ],
                                [
                                    // 'nilai' => $value,
                                    'nilai' => str_replace(',', '.', $value),
                                    'status' => true,
                                ]
                            );
                        } else {
                            Log::warning("Mata pelajaran dengan kode {$key} tidak ditemukan di database");
                        }
                    }
                }
            }
        });
    }
}
