<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kelasData = [
            ['nama_kelas' => 'Kelas 1', 'tingkat_kelas' => '1'],
            ['nama_kelas' => 'Kelas 2', 'tingkat_kelas' => '2'],
            ['nama_kelas' => 'Kelas 3', 'tingkat_kelas' => '3'],
            ['nama_kelas' => 'Kelas 4', 'tingkat_kelas' => '4'],
            ['nama_kelas' => 'Kelas 5', 'tingkat_kelas' => '5'],
            ['nama_kelas' => 'Kelas 6', 'tingkat_kelas' => '6'],
            ['nama_kelas' => 'Kelas 7', 'tingkat_kelas' => '7'],
            ['nama_kelas' => 'Kelas 8', 'tingkat_kelas' => '8'],
            ['nama_kelas' => 'Kelas 9', 'tingkat_kelas' => '9'],
            ['nama_kelas' => 'Kelas 10', 'tingkat_kelas' => '10'],
        ];

        foreach ($kelasData as $data) {
            Kelas::create($data);
        }
    }
}
