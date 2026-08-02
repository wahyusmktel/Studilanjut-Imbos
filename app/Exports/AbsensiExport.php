<?php

namespace App\Exports;

use App\Models\AbsensiDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Str;

class AbsensiExport implements FromCollection, WithHeadings, WithStyles, WithEvents, WithColumnWidths, WithCustomStartCell
{
    protected $startDate;
    protected $endDate;
    protected $mataPelajaranId;
    protected $kelasId;

    protected $totalHadir = 0;
    protected $totalTidakHadir = 0;
    protected $totalSakit = 0;

    public function __construct($startDate, $endDate, $mataPelajaranId, $kelasId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->mataPelajaranId = $mataPelajaranId;
        $this->kelasId = $kelasId;
    }

    public function collection()
    {
        $query = AbsensiDetail::with('siswa', 'absensi.guru', 'absensi.kelas', 'absensi.guru.mataPelajaran');

        if ($this->startDate && $this->endDate) {
            $query->whereHas('absensi', function($q) {
                $q->whereBetween('tanggal', [$this->startDate, $this->endDate]);
            });
        }

        if ($this->mataPelajaranId) {
            $query->whereHas('absensi.guru.mataPelajaran', function ($q) {
                $q->where('id', $this->mataPelajaranId);
            });
        }

        if ($this->kelasId) {
            $query->whereHas('absensi.kelas', function ($q) {
                $q->where('id', $this->kelasId);
            });
        }

        $absensiDetails = $query->get();

        $data = $absensiDetails->map(function ($detail) {
            if ($detail->kehadiran == 1) {
                $this->totalHadir++;
            } elseif ($detail->kehadiran == 0) {
                $this->totalTidakHadir++;
            } elseif ($detail->kehadiran == 2) {
                $this->totalSakit++;
            }

            return [
                'Nama Siswa' => $detail->siswa->nama_siswa,
                'Kelas' => $detail->absensi->kelas->nama_kelas,
                'Mata Pelajaran' => $detail->absensi->guru->mataPelajaran->namaMataPelajaran,
                'Guru' => $detail->absensi->guru->nama,
                'Tanggal' => \Carbon\Carbon::parse($detail->absensi->tanggal)->format('d-m-Y'),
                'Kehadiran' => $detail->kehadiran == 1 ? 'Hadir' : ($detail->kehadiran == 0 ? 'Tidak Hadir' : 'Sakit'),
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Kelas',
            'Mata Pelajaran',
            'Guru',
            'Tanggal',
            'Kehadiran',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D3D3D3']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function title(): string
    {
        return 'Absensi';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT)
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->setCellValue('A1', 'LAPORAN KEHADIRAN ABSENSI BIMBEL SISWA');
                $sheet->setCellValue('A2', 'Laporan data dari tanggal ' . \Carbon\Carbon::parse($this->startDate)->format('d-m-Y') . ' sampai ' . \Carbon\Carbon::parse($this->endDate)->format('d-m-Y'));
                $sheet->getStyle('A1:A2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Set styles for the first row
                $sheet->getStyle('A4:F4')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D3D3D3']
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Set row height
                foreach (range(1, $sheet->getHighestRow()) as $row) {
                    $sheet->getRowDimension($row)->setRowHeight(20);
                }

                // Add border to all cells
                $sheet->getStyle('A4:F' . $sheet->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Set date format for "Tanggal" column
                $sheet->getStyle('E5:E' . $sheet->getHighestRow())->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);

                // Add summary row
                // $lastRow = $sheet->getHighestRow() + 1;
                // $sheet->setCellValue('A' . $lastRow, 'Jumlah Kehadiran: ' . $this->totalHadir);
                // $sheet->setCellValue('B' . $lastRow, 'Jumlah Ketidakhadiran: ' . $this->totalTidakHadir);
                // $sheet->setCellValue('C' . $lastRow, 'Jumlah Sakit: ' . $this->totalSakit);

                // $sheet->mergeCells('A' . $lastRow . ':F' . $lastRow);
                // $sheet->getStyle('A' . $lastRow . ':F' . $lastRow)->applyFromArray([
                //     'font' => ['bold' => true],
                //     'alignment' => [
                //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                //         'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                //     ],
                //     'borders' => [
                //         'top' => [
                //             'borderStyle' => Border::BORDER_THIN,
                //             'color' => ['argb' => '000000'],
                //         ],
                //     ],
                // ]);

                // Add summary row
                $lastRow = $sheet->getHighestRow() + 1;
                $sheet->setCellValue('A' . $lastRow, 'Jumlah Kehadiran: ' . $this->totalHadir);
                $sheet->mergeCells('A' . $lastRow . ':F' . $lastRow);
                $sheet->getStyle('A' . $lastRow . ':F' . $lastRow)->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Add ketidakhadiran summary row
                $sheet->setCellValue('A' . ($lastRow + 1), 'Jumlah Ketidakhadiran: ' . $this->totalTidakHadir);
                $sheet->mergeCells('A' . ($lastRow + 1) . ':F' . ($lastRow + 1));
                $sheet->getStyle('A' . ($lastRow + 1) . ':F' . ($lastRow + 1))->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Add sakit summary row
                $sheet->setCellValue('A' . ($lastRow + 2), 'Jumlah Sakit: ' . $this->totalSakit);
                $sheet->mergeCells('A' . ($lastRow + 2) . ':F' . ($lastRow + 2));
                $sheet->getStyle('A' . ($lastRow + 2) . ':F' . ($lastRow + 2))->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 15,
            'C' => 25,
            'D' => 20,
            'E' => 15,
            'F' => 15,
        ];
    }
}
