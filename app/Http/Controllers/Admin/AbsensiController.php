<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiDetail;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use App\Models\Siswa;
use App\Exports\AbsensiDetailExport;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = AbsensiDetail::with('siswa', 'absensi.guru', 'absensi.kelas', 'absensi.guru.mataPelajaran')->whereHas('absensi');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereHas('absensi', function ($q) use ($request) {
                $q->whereBetween('tanggal', [$request->start_date, $request->end_date]);
            });
        }

        if ($request->filled('mata_pelajaran_id')) {
            $query->whereHas('absensi.guru.mataPelajaran', function ($q) use ($request) {
                $q->where('id', $request->mata_pelajaran_id);
            });
        }

        if ($request->filled('kelas_id')) {
            $query->whereHas('absensi.kelas', function ($q) use ($request) {
                $q->where('id', $request->kelas_id);
            });
        }

        $absensiDetails = $query->paginate(10);
        $mataPelajarans = MataPelajaran::all();
        $kelases = Kelas::all();

        return view('admin.absensi.data_absensi', compact('absensiDetails', 'mataPelajarans', 'kelases'));
    }

    public function export(Request $request)
    {
        return Excel::download(new AbsensiExport($request->start_date, $request->end_date, $request->mata_pelajaran_id, $request->kelas_id), 'absensi.xlsx');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:absensi_details,id',
            'kehadiran' => 'required|in:0,1,2',
        ]);

        $absensiDetail = AbsensiDetail::findOrFail($request->id);
        $absensiDetail->kehadiran = $request->kehadiran;
        $absensiDetail->save();

        return redirect()->route('admin.absensi.index')->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    public function detail(Request $request, $siswa_id)
    {
        $query = AbsensiDetail::with('absensi.guru', 'absensi.kelas', 'absensi.guru.mataPelajaran')
            ->where('siswa_id', $siswa_id)
            ->whereHas('absensi');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereHas('absensi', function ($q) use ($request) {
                $q->whereBetween('tanggal', [$request->start_date, $request->end_date]);
            });
        }

        if ($request->has('mata_pelajaran_id') && $request->mata_pelajaran_id != '') {
            $query->whereHas('absensi.guru.mataPelajaran', function ($q) use ($request) {
                $q->where('id', $request->mata_pelajaran_id);
            });
        }

        // $absensiDetails = $query->get();
        $absensiDetails = $query->paginate(10);

        $siswa = Siswa::findOrFail($siswa_id);
        $mataPelajarans = MataPelajaran::all();

        return view('admin.absensi.detail_absensi', compact('absensiDetails', 'siswa', 'mataPelajarans', 'request'));
    }

    public function exportDetail($id, Request $request)
    {
        return Excel::download(new AbsensiDetailExport($id, $request->start_date, $request->end_date, $request->mata_pelajaran_id), 'absensi_detail.xlsx');
    }
}
