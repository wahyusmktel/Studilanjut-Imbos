<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramBimbel;

class ProgramBimbelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $programBimbels = [
            ['nama_program' => 'Program 1', 'deskripsi_program' => 'Deskripsi Program 1', 'icon_program' => 'icon1.png'],
            ['nama_program' => 'Program 2', 'deskripsi_program' => 'Deskripsi Program 2', 'icon_program' => 'icon2.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
            ['nama_program' => 'Program 3', 'deskripsi_program' => 'Deskripsi Program 3', 'icon_program' => 'icon3.png'],
        ];

        foreach ($programBimbels as $program) {
            ProgramBimbel::create($program);
        }
    }
}
