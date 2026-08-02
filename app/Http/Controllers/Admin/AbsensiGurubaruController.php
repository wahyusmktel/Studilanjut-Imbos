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
        $query = Absensi::with('guru', 'kelas', 'guru.mataPelajaran');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        if ($request->has('guru_id') && $request->guru_id != '') {
            $query->where('guru_id', $request->guru_id);
        }

        $absensis = $query->paginate(10);
        $gurus = Guru::all();
        $mataPelajarans = MataPelajaran::all();

        // Prepare data for the chart per month
        $attendanceChartData = $this->prepareMonthlyAttendanceChartData($absensis);

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
        $monthlyAttendance = [];

        foreach ($absensis as $absensi) {
            $month = \Carbon\Carbon::parse($absensi->tanggal)->format('Y-m');

            if (!isset($monthlyAttendance[$month])) {
                $monthlyAttendance[$month] = 0;
            }

            $monthlyAttendance[$month]++;
        }

        ksort($monthlyAttendance);

        $labels = array_keys($monthlyAttendance);
        $data = array_values($monthlyAttendance);

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

}
