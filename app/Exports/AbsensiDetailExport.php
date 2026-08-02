<?php

namespace App\Exports;

use App\Models\AbsensiDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AbsensiDetailExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    private $siswaId;
    private $startDate;
    private $endDate;
    private $mataPelajaranId;

    public function __construct($siswaId, $startDate, $endDate, $mataPelajaranId)
    {
        $this->siswaId = $siswaId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->mataPelajaranId = $mataPelajaranId;
    }

    public function view(): View
    {
        $query = AbsensiDetail::with('siswa.kelas', 'siswa.programBimbel', 'absensi.guru', 'absensi.kelas', 'absensi.guru.mataPelajaran')
            ->where('siswa_id', $this->siswaId);

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

        $absensiDetails = $query->get();

        return view('admin.absensi.detail_export', [
            'absensiDetails' => $absensiDetails,
            'siswa' => $absensiDetails->first()->siswa ?? null,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate
        ]);
    }

    public function title(): string
    {
        return 'Detail Absensi';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Page setup
                $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
                $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

                // Styles for the headers
                $sheet->getStyle('A6:E6')->getFont()->setBold(true);
                $sheet->getStyle('A6:E6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('A6:E6')->getFill()->getStartColor()->setARGB('FFD3D3D3');
                $sheet->getRowDimension('6')->setRowHeight(20);

                // Remove borders from first 5 rows
                $sheet->getStyle('A1:E5')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE);

                // Borders for all cells from row 6 onwards
                $sheet->getStyle('A6:E' . $sheet->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Bold and merge the summary rows
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle('A' . ($highestRow - 2) . ':E' . $highestRow)->getFont()->setBold(true);
                $sheet->mergeCells('A' . ($highestRow - 2) . ':E' . ($highestRow - 2));
                $sheet->mergeCells('A' . ($highestRow - 1) . ':E' . ($highestRow - 1));
                $sheet->mergeCells('A' . $highestRow . ':E' . $highestRow);
            },
        ];
    }
}
