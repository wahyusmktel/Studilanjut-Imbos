<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPt;

class JenisPerguruanTinggisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_jenis_pt' => 'PTK (Perguruan Tinggi Kedinasan)'],
            ['nama_jenis_pt' => 'PTN (Perguruan Tinggi Negeri)'],
            ['nama_jenis_pt' => 'PTKIN (Perguruan Tinggi Islam Negeri)'],
            ['nama_jenis_pt' => 'PTS (Perguruan Tinggi Swasta)'],
        ];

        foreach ($data as $item) {
            JenisPt::create($item);
        }
    }
}
