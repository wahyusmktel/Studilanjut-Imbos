<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\ProgramBimbel;
use App\Models\Tryout;
use App\Models\TahunPelajaran;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahMataPelajaran = MataPelajaran::count();
        $jumlahNilai = Nilai::count();
        $jumlahKelas = Kelas::count();
        $jumlahProgramBimbel = ProgramBimbel::count();
        $jumlahTryout = Tryout::count();
        $jumlahTahunPelajaran = TahunPelajaran::count();

        // 1. Dapatkan Tahun Pelajaran Aktif
        $tahunPelajaranAktif = TahunPelajaran::active()->first();

        $chartLabels = [];
        $chartData = [];
        $topSiswa = collect();

        if ($tahunPelajaranAktif) {
            // 2. Data untuk Interactive Chart: Rata-rata nilai per Tryout di Tahun Pelajaran Aktif
            $tryouts = Tryout::where('tahun_pelajaran_id', $tahunPelajaranAktif->id)
                ->orderBy('created_at', 'asc')
                ->get();

            foreach ($tryouts as $tryout) {
                $chartLabels[] = $tryout->nama_tryout;
                // Rata-rata nilai keseluruhan siswa pada tryout ini
                $rataRataTryout = Nilai::where('tryout_id', $tryout->id)->avg('nilai');
                $chartData[] = $rataRataTryout ? round($rataRataTryout, 2) : 0;
            }

            // 3. Data untuk Widget "Nilai Terbaik": Top 5 Siswa berdasarkan rata-rata nilai Tryout di Tahun Pelajaran Aktif
            $topSiswaData = Nilai::select('siswa_id', DB::raw('AVG(nilai) as rata_rata_nilai'))
                ->whereIn('tryout_id', $tryouts->pluck('id'))
                ->groupBy('siswa_id')
                ->orderByDesc('rata_rata_nilai')
                ->take(5)
                ->get();

            $topSiswaIds = $topSiswaData->pluck('siswa_id');
            $siswaInstances = Siswa::with('kelas')->whereIn('id', $topSiswaIds)->get()->keyBy('id');

            $topSiswa = $topSiswaData->map(function ($item) use ($siswaInstances) {
                $siswa = $siswaInstances->get($item->siswa_id);
                return (object)[
                    'nama_siswa' => $siswa ? $siswa->nama_siswa : 'Unknown',
                    'nama_kelas' => ($siswa && $siswa->kelas) ? $siswa->kelas->nama_kelas : 'Unknown',
                    'rata_rata_nilai' => round($item->rata_rata_nilai, 2),
                    'foto_siswa' => $siswa ? $siswa->foto_siswa : null,
                ];
            });
        }

        // 4. Data untuk Chart Kehadiran 30 Hari Terakhir
        $thirtyDaysAgo = Carbon::now()->subDays(30)->toDateString();
        $absensiData = Absensi::withCount(['details' => function($query) {
                // Kehadiran = 1 berarti Hadir
                $query->where('kehadiran', 1);
            }])
            ->where('tanggal', '>=', $thirtyDaysAgo)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->groupBy('tanggal');

        $attendanceChartLabels = [];
        $attendanceChartData = [];

        foreach($absensiData as $tanggal => $absensis) {
            $attendanceChartLabels[] = Carbon::parse($tanggal)->format('d M');
            $attendanceChartData[] = $absensis->sum('details_count');
        }

        // 5. Data untuk Widget Siswa Paling Disiplin (Top 5 Kehadiran)
        $topAttendance = collect();
        if ($tahunPelajaranAktif) {
            $topAttendanceData = AbsensiDetail::select('siswa_id', DB::raw('count(*) as total_hadir'))
                ->where('kehadiran', 1)
                ->whereHas('absensi', function($q) use ($tahunPelajaranAktif) {
                    $q->where('tahun_pelajaran_id', $tahunPelajaranAktif->id);
                })
                ->groupBy('siswa_id')
                ->orderByDesc('total_hadir')
                ->take(5)
                ->get();

            $topAttendanceIds = $topAttendanceData->pluck('siswa_id');
            $siswaAttendanceInstances = Siswa::with('kelas')->whereIn('id', $topAttendanceIds)->get()->keyBy('id');

            $topAttendance = $topAttendanceData->map(function ($item) use ($siswaAttendanceInstances) {
                $siswa = $siswaAttendanceInstances->get($item->siswa_id);
                return (object)[
                    'nama_siswa' => $siswa ? $siswa->nama_siswa : 'Unknown',
                    'nama_kelas' => ($siswa && $siswa->kelas) ? $siswa->kelas->nama_kelas : 'Unknown',
                    'total_hadir' => $item->total_hadir,
                    'foto_siswa' => $siswa ? $siswa->foto_siswa : null,
                ];
            });
        }

        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahMataPelajaran',
            'jumlahNilai',
            'jumlahKelas',
            'jumlahProgramBimbel',
            'jumlahTryout',
            'jumlahTahunPelajaran',
            'tahunPelajaranAktif',
            'chartLabels',
            'chartData',
            'topSiswa',
            'attendanceChartLabels',
            'attendanceChartData',
            'topAttendance'
        ));
    }
}
