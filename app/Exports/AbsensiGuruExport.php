<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AbsensiGuruExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    private $startDate;
    private $endDate;
    private $guruId;

    public function __construct($startDate, $endDate, $guruId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->guruId = $guruId;
    }

    public function view(): View
    {
        $query = Absensi::with('guru.mataPelajaran', 'kelas');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('tanggal', [$this->startDate, $this->endDate]);
        }

        if ($this->guruId) {
            $query->where('guru_id', $this->guruId);
        }

        $absensiData = $query->get();

        return view('admin.absensi.guru_export', [
            'absensiData' => $absensiData,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'guru' => $absensiData->first()->guru ?? null,
        ]);
    }

    public function title(): string
    {
        return 'Absensi Guru';
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
                $sheet->getStyle('A6:F6')->getFont()->setBold(true);
                $sheet->getStyle('A6:F6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $sheet->getStyle('A6:F6')->getFill()->getStartColor()->setARGB('FFD3D3D3');
                $sheet->getRowDimension('6')->setRowHeight(20);

                // Remove borders from first 5 rows
                $sheet->getStyle('A1:F5')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE);

                // Borders for all cells from row 6 onwards
                $sheet->getStyle('A6:F' . $sheet->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Bold and merge the summary rows
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle('A' . ($highestRow) . ':F' . ($highestRow))->getFont()->setBold(true);
                $sheet->mergeCells('A' . ($highestRow) . ':F' . ($highestRow));
            },
        ];
    }
}
