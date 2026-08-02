<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiGuruExport;
use App\Models\AbsensiDetail;

class AbsensiGurubaruController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::with('guru', 'kelas', 'guru.mataPelajaran')->orderBy('tanggal', 'desc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('guru_id')) {
            $query->where('guru_id', $request->guru_id);
        }

        $absensis = $query->paginate(10)->appends($request->all());
        $gurus = Guru::all();
        $mataPelajarans = MataPelajaran::all();

        // Prepare chart data from ALL matching records, not just current paginated 10 items
        $chartQuery = Absensi::query();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $chartQuery->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('guru_id')) {
            $chartQuery->where('guru_id', $request->guru_id);
        }
        $allChartAbsensis = $chartQuery->get();

        $attendanceChartData = $this->prepareMonthlyAttendanceChartData($allChartAbsensis);

        return view('admin.absensi_guru.index', compact('absensis', 'gurus', 'mataPelajarans', 'attendanceChartData'));
    }

    public function show($id)
    {
        $absensi = Absensi::with('guru', 'kelas', 'guru.mataPelajaran')->findOrFail($id);
        return view('admin.absensi_guru.show', compact('absensi'));
    }

    public function export(Request $request)
    {
        return Excel::download(new AbsensiGuruExport($request->start_date, $request->end_date, $request->guru_id), 'absensi_guru.xlsx');
    }

    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);

        // Hapus absensi details yang terkait
        AbsensiDetail::where('absensi_id', $id)->delete();

        // Hapus absensi
        $absensi->delete();

        return response()->json(['success' => true, 'message' => 'Data absensi berhasil dihapus.']);
    }

    private function prepareMonthlyAttendanceChartData($absensis)
    {
        $monthlyData = [];

        foreach ($absensis as $absensi) {
            if (!$absensi->tanggal) continue;
            $carbonDate = \Carbon\Carbon::parse($absensi->tanggal);
            $sortKey = $carbonDate->format('Y-m');
            $monthName = ucfirst($carbonDate->locale('id')->isoFormat('MMMM YYYY'));

            if (!isset($monthlyData[$sortKey])) {
                $monthlyData[$sortKey] = [
                    'label' => $monthName,
                    'count' => 0
                ];
            }

            $monthlyData[$sortKey]['count']++;
        }

        ksort($monthlyData);

        $labels = [];
        $data = [];

        foreach ($monthlyData as $item) {
            $labels[] = $item['label'];
            $data[] = $item['count'];
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

}
