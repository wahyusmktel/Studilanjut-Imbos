<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapSesiAbsensiExport;

class AdminRekapAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::with(['guru.mataPelajaran', 'kelas', 'details.siswa'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('waktu', 'desc');

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('filter_status')) {
            if ($request->filter_status === 'ada_tidak_hadir') {
                $query->whereHas('details', function ($q) {
                    $q->whereIn('kehadiran', [0, 2, 3, 4]); // alpa, sakit, pulang, izin
                });
            } elseif ($request->filter_status === 'hadir_semua') {
                $query->whereDoesntHave('details', function ($q) {
                    $q->whereIn('kehadiran', [0, 2, 3, 4]);
                });
            }
        }

        $sesiAbsensis = $query->paginate(15)->appends($request->all());
        $kelases = Kelas::orderBy('nama_kelas', 'asc')->get();

        return view('admin.rekap_absensi.index', compact('sesiAbsensis', 'kelases', 'request'));
    }

    public function show($id)
    {
        $absensi = Absensi::with(['guru.mataPelajaran', 'kelas', 'details.siswa.kelas'])
            ->findOrFail($id);

        $details = $absensi->details;

        $hadirList = $details->where('kehadiran', 1);
        $alpaList = $details->where('kehadiran', 0);
        $sakitList = $details->where('kehadiran', 2);
        $izinList = $details->where('kehadiran', 4);
        $pulangList = $details->where('kehadiran', 3);

        $tidakHadirTotal = $alpaList->count() + $sakitList->count() + $izinList->count() + $pulangList->count();

        return view('admin.rekap_absensi.show', compact(
            'absensi',
            'details',
            'hadirList',
            'alpaList',
            'sakitList',
            'izinList',
            'pulangList',
            'tidakHadirTotal'
        ));
    }

    public function export($id)
    {
        $absensi = Absensi::with('kelas')->findOrFail($id);
        $fileName = 'Rekap_Absensi_' . str_replace(' ', '_', $absensi->kelas->nama_kelas ?? 'Tim') . '_' . $absensi->tanggal . '.xlsx';
        return Excel::download(new RekapSesiAbsensiExport($id), $fileName);
    }
}
