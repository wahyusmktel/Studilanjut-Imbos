<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumniFormatExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'nama_alumni',
            'jenis_perguruan_tinggi_id',
            'nama_universitas',
            'foto',
            'status'
        ];
    }

    public function array(): array
    {
        return [
            ['John Doe', '8bb88f3a-428b-453d-998c-bba0264195d1', 'Universitas A', 'link_foto.jpg', 1],
            ['Jane Doe', 'bba0264195d1-8bb88f3a-428b-453d-998c', 'Universitas B', 'link_foto.jpg', 1],
            // Tambahkan contoh data lainnya jika diperlukan
        ];
    }
}
