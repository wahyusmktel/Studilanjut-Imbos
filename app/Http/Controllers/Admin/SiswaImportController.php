<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $import = new SiswaImport;
        Excel::import($import, $request->file('file'));
        $summary = $import->summary();

        return redirect()->back()
            ->with('success', 'Proses import selesai. '.$summary['imported'].' data berhasil diimport.')
            ->with('import_summary', $summary);
    }
}
