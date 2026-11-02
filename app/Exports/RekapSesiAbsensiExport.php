<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class RekapSesiAbsensiExport implements FromCollection, WithHeadings, WithStyles, WithCustomStartCell, WithEvents, WithColumnWidths, WithTitle
{
    protected $absensiId;
    protected $absensi;
    protected $totalHadir = 0;
    protected $totalAlpa = 0;
    protected $totalSakit = 0;
    protected $totalIzin = 0;
    protected $totalPulang = 0;

    public function __construct($absensiId)
    {
        $this->absensiId = $absensiId;
        $this->absensi = Absensi::with(['guru.mataPelajaran', 'kelas', 'details.siswa'])->findOrFail($absensiId);
    }

    public function title(): string
    {
        return 'Rekap ' . ($this->absensi->kelas->nama_kelas ?? 'Sesi');
    }

    public function collection()
    {
        $no = 1;
        return $this->absensi->details->map(function ($detail) use (&$no) {
            $statusStr = 'Hadir';
            if ($detail->kehadiran == 1) {
                $statusStr = 'Hadir';
                $this->totalHadir++;
            } elseif ($detail->kehadiran == 0) {
                $statusStr = 'Alpa (Tanpa Keterangan)';
                $this->totalAlpa++;
            } elseif ($detail->kehadiran == 2) {
                $statusStr = 'Sakit';
                $this->totalSakit++;
            } elseif ($detail->kehadiran == 4) {
                $statusStr = 'Izin';
                $this->totalIzin++;
            } elseif ($detail->kehadiran == 3) {
                $statusStr = 'Pulang';
                $this->totalPulang++;
            }

            return [
                'No' => $no++,
                'Nama Siswa' => $detail->siswa->nama_siswa ?? '-',
                'Status Kehadiran' => $statusStr,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap Siswa',
            'Status Kehadiran',
        ];
    }

    public function startCell(): string
    {
        return 'A7';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 40,
            'C' => 28,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            7 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1E3A8A'], // Navy
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Header Information
                $sheet->mergeCells('A1:C1');
                $sheet->setCellValue('A1', 'LAPORAN EVALUASI KEHADIRAN SESI TIM BIMBEL');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1E3A8A']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                $sheet->setCellValue('A3', 'Tim Bimbel / Kelas');
                $sheet->setCellValue('B3', ': ' . ($this->absensi->kelas->nama_kelas ?? '-'));
                $sheet->setCellValue('A4', 'Hari, Tanggal');
                $sheet->setCellValue('B4', ': ' . Carbon::parse($this->absensi->tanggal)->locale('id')->isoFormat('dddd, D MMMM Y') . ' (' . $this->absensi->waktu . ' WIB)');
                $sheet->setCellValue('A5', 'Pengampu & Mapel');
                $sheet->setCellValue('B5', ': ' . ($this->absensi->guru->nama ?? '-') . ' - ' . ($this->absensi->guru->mataPelajaran->namaMataPelajaran ?? '-'));

                $sheet->getStyle('A3:A5')->applyFromArray(['font' => ['bold' => true, 'size' => 10]]);

                $highestRow = $sheet->getHighestRow();

                // Borders for table data
                $sheet->getStyle('A7:C' . $highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CBD5E1'],
                        ],
                    ],
                    'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
                ]);

                // Alignment
                $sheet->getStyle('A8:A' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C8:C' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Summary Row
                $summaryStart = $highestRow + 2;
                $sheet->setCellValue('B' . $summaryStart, 'Total Siswa Terdaftar');
                $sheet->setCellValue('C' . $summaryStart, $this->absensi->details->count() . ' Siswa');

                $sheet->setCellValue('B' . ($summaryStart + 1), 'Jumlah Hadir');
                $sheet->setCellValue('C' . ($summaryStart + 1), $this->totalHadir . ' Siswa');

                $sheet->setCellValue('B' . ($summaryStart + 2), 'Jumlah Alpa (Tanpa Keterangan)');
                $sheet->setCellValue('C' . ($summaryStart + 2), $this->totalAlpa . ' Siswa');

                $sheet->setCellValue('B' . ($summaryStart + 3), 'Jumlah Sakit');
                $sheet->setCellValue('C' . ($summaryStart + 3), $this->totalSakit . ' Siswa');

                $sheet->setCellValue('B' . ($summaryStart + 4), 'Jumlah Izin');
                $sheet->setCellValue('C' . ($summaryStart + 4), $this->totalIzin . ' Siswa');

                $sheet->setCellValue('B' . ($summaryStart + 5), 'Jumlah Pulang');
                $sheet->setCellValue('C' . ($summaryStart + 5), $this->totalPulang . ' Siswa');

                $sheet->getStyle('B' . $summaryStart . ':C' . ($summaryStart + 5))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'E2E8F0'],
                        ],
                    ],
                    'font' => ['size' => 10],
                ]);
                $sheet->getStyle('B' . $summaryStart . ':B' . ($summaryStart + 5))->getFont()->setBold(true);
                $sheet->getStyle('C' . $summaryStart . ':C' . ($summaryStart + 5))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
