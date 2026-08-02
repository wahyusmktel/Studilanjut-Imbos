<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\ProgramBimbel;
use App\Models\Siswa;
use App\Models\TahunPelajaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToModel, WithHeadingRow
{
    private $tahunPelajaranAktif;

    public function __construct()
    {
        // Mengambil tahun pelajaran yang aktif saat proses import dimulai
        $this->tahunPelajaranAktif = TahunPelajaran::where('status', true)->first();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Jika tidak ada tahun pelajaran aktif, hentikan proses import
        if (!$this->tahunPelajaranAktif) {
            throw new \Exception('Tidak ada tahun pelajaran yang aktif. Silakan atur terlebih dahulu.');
        }

        // --- PERUBAHAN DI SINI ---
        // Mencari kelas berdasarkan nama DAN ID tahun pelajaran yang aktif
        $kelas = Kelas::where('nama_kelas', $row['kelompok'])
            ->where('tahun_pelajaran_id', $this->tahunPelajaranAktif->id)
            ->first();

        $programBimbel = ProgramBimbel::where('nama_program', $row['nama_program'])->first();

        // Jika kelas untuk tahun ajaran aktif tidak ditemukan, atau program bimbel tidak ada, lemparkan error
        if (!$kelas) {
            throw new \Exception("Kelas '{$row['kelompok']}' untuk tahun pelajaran aktif tidak ditemukan. Pastikan nama kelas dan tahun pelajarannya sesuai.");
        }
        if (!$programBimbel) {
            throw new \Exception("Program Bimbel '{$row['nama_program']}' tidak ditemukan.");
        }
        // --- AKHIR PERUBAHAN ---

        // Konversi tanggal dari format Excel jika perlu
        $tgl_lahir = null;
        if (!empty($row['tgl_lahir'])) {
            $tgl_lahir = is_numeric($row['tgl_lahir'])
                ? Date::excelToDateTimeObject($row['tgl_lahir'])->format('Y-m-d')
                : \Carbon\Carbon::parse($row['tgl_lahir'])->format('Y-m-d');
        }


        // Periksa apakah siswa sudah ada berdasarkan NIS, lalu update atau create
        $siswa = Siswa::where('nis', $row['nis'])->first();

        if ($siswa) {
            // Jika siswa sudah ada, perbarui data
            $siswa->update([
                'kelas_id' => $kelas->id,
                'program_bimbel_id' => $programBimbel->id,
                'nama_siswa' => $row['nama_siswa'],
                'tgl_lahir' => $tgl_lahir,
                'tmpt_lahir' => $row['tmpt_lahir'],
                'no_hp' => $row['no_hp'],
                'foto_siswa' => $row['foto_siswa'],
                'password' => Hash::make($row['password']),
                'status' => true,
            ]);
            return null; // Tidak return model karena sudah di-update
        } else {
            // Jika siswa belum ada, buat data baru
            return new Siswa([
                'id' => Str::uuid(),
                'kelas_id' => $kelas->id,
                'program_bimbel_id' => $programBimbel->id,
                'nama_siswa' => $row['nama_siswa'],
                'tgl_lahir' => $tgl_lahir,
                'tmpt_lahir' => $row['tmpt_lahir'],
                'no_hp' => $row['no_hp'],
                'foto_siswa' => $row['foto_siswa'],
                'nis' => $row['nis'],
                'password' => Hash::make($row['password']),
                'status' => true,
            ]);
        }
    }
}
