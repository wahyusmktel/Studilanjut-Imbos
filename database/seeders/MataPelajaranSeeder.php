<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $mataPelajarans = [
            'Matematika', 'Fisika', 'Kimia', 'Biologi', 'Bahasa Indonesia',
            'Bahasa Inggris', 'Sejarah', 'Geografi', 'Ekonomi', 'Sosiologi',
            'Pendidikan Agama', 'Pendidikan Kewarganegaraan', 'Seni Budaya', 'Penjaskes',
            'Teknologi Informasi', 'Bahasa Jepang', 'Bahasa Jerman', 'Bahasa Arab',
            'Keterampilan', 'Kesehatan'
        ];

        foreach ($mataPelajarans as $mataPelajaran) {
            DB::table('mata_pelajarans')->insert([
                'id' => (string) Str::uuid(),
                'namaMataPelajaran' => $mataPelajaran,
                'status' => 'Aktif', // atau bisa juga 'Non-Aktif'
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
