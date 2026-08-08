<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\ProgramBimbel;
use App\Models\Siswa;
use App\Models\TahunPelajaran;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToCollection, WithHeadingRow
{
    private $tahunPelajaranAktif;

    private array $seenNis = [];

    private array $summary = [
        'total' => 0,
        'imported' => 0,
        'duplicates' => [],
        'failed' => [],
    ];

    public function __construct()
    {
        $this->tahunPelajaranAktif = TahunPelajaran::where('status', true)->first();
    }

    public function collection(Collection $rows): void
    {
        $this->summary['total'] = $rows->count();

        foreach ($rows as $index => $row) {
            $excelRow = $index + 2;
            $data = is_array($row) ? $row : $row->toArray();
            $nis = trim((string) ($data['nis'] ?? ''));
            $name = trim((string) ($data['nama_siswa'] ?? ''));

            if ($nis === '' || ! preg_match('/^\d+$/', $nis)) {
                $this->addFailed($excelRow, $nis, $name, 'NIS wajib diisi dan harus berupa angka.');

                continue;
            }

            if ($name === '') {
                $this->addFailed($excelRow, $nis, $name, 'Nama siswa wajib diisi.');

                continue;
            }

            if (isset($this->seenNis[$nis])) {
                $this->addDuplicate($excelRow, $nis, $name, 'NIS duplikat di dalam file Excel (baris '.$this->seenNis[$nis].').');

                continue;
            }

            $this->seenNis[$nis] = $excelRow;

            if (Siswa::where('nis', (int) $nis)->exists()) {
                $this->addDuplicate($excelRow, $nis, $name, 'NIS sudah terdaftar di database.');

                continue;
            }

            try {
                if (! $this->tahunPelajaranAktif) {
                    throw new \RuntimeException('Tidak ada tahun pelajaran aktif.');
                }

                $kelasName = trim((string) ($data['kelompok'] ?? ''));
                $programName = trim((string) ($data['nama_program'] ?? ''));
                $kelas = Kelas::where('nama_kelas', $kelasName)
                    ->where('tahun_pelajaran_id', $this->tahunPelajaranAktif->id)
                    ->first();
                $programBimbel = ProgramBimbel::where('nama_program', $programName)->first();

                if (! $kelas) {
                    throw new \RuntimeException("Kelas '{$kelasName}' untuk tahun pelajaran aktif tidak ditemukan.");
                }

                if (! $programBimbel) {
                    throw new \RuntimeException("Program Bimbel '{$programName}' tidak ditemukan.");
                }

                $password = trim((string) ($data['password'] ?? ''));
                if ($password === '') {
                    throw new \RuntimeException('Password wajib diisi.');
                }

                Siswa::create([
                    'id' => Str::uuid(),
                    'kelas_id' => $kelas->id,
                    'program_bimbel_id' => $programBimbel->id,
                    'nama_siswa' => $name,
                    'tgl_lahir' => $this->parseDate($data['tgl_lahir'] ?? null),
                    'tmpt_lahir' => $data['tmpt_lahir'] ?? null,
                    'no_hp' => $data['no_hp'] ?? null,
                    'foto_siswa' => $data['foto_siswa'] ?? null,
                    'nis' => (int) $nis,
                    'password' => Hash::make($password),
                    'status' => true,
                ]);

                $this->summary['imported']++;
            } catch (\Throwable $exception) {
                $this->addFailed($excelRow, $nis, $name, $exception->getMessage());
            }
        }
    }

    public function summary(): array
    {
        $this->summary['duplicate_count'] = count($this->summary['duplicates']);
        $this->summary['failed_count'] = count($this->summary['failed']);

        return $this->summary;
    }

    private function parseDate(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return is_numeric($value)
            ? Date::excelToDateTimeObject($value)->format('Y-m-d')
            : Carbon::parse($value)->format('Y-m-d');
    }

    private function addDuplicate(int $row, string $nis, string $name, string $reason): void
    {
        $this->summary['duplicates'][] = compact('row', 'nis', 'name', 'reason');
    }

    private function addFailed(int $row, string $nis, string $name, string $reason): void
    {
        $this->summary['failed'][] = compact('row', 'nis', 'name', 'reason');
    }
}
