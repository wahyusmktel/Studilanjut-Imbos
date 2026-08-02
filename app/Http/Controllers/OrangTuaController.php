<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\MataPelajaran;
use App\Models\SertifikatPerkembangan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SertifikatTryout;
use App\Models\SettingSertifikat;
use App\Models\AbsensiDetail;
use App\Models\TahunPelajaran;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class OrangTuaController extends Controller
{
    public function index()
    {
        $siswa = Auth::guard('parent')->user();
        $mataPelajarans = collect();
        $statusKedinasan = null;

        // --- PERUBAHAN DIMULAI DI SINI ---

        // Cek dulu apakah siswa punya relasi kelas yang valid
        if ($siswa && $siswa->kelas) {
            $statusKedinasan = $siswa->kelas->status_kedinasan;

            // Menyaring mata pelajaran berdasarkan status kedinasan
            if ($statusKedinasan === 1) {
                $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
            } elseif ($statusKedinasan === 0) {
                $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
            } else {
                $mataPelajarans = MataPelajaran::all();
            }
        }

        // 2. Dapatkan tahun pelajaran yang aktif
        $tahunPelajaranAktif = TahunPelajaran::where('status', true)->first();

        // 3. Siapkan query untuk Nilai
        $nilaiQuery = Nilai::where('siswa_id', $siswa->id)
            ->with(['tryout.tahunPelajaran', 'mataPelajaran']);

        // 4. Filter nilai berdasarkan tahun pelajaran aktif
        if ($tahunPelajaranAktif) {
            $nilaiQuery->whereHas('tryout', function ($q) use ($tahunPelajaranAktif) {
                $q->where('tahun_pelajaran_id', $tahunPelajaranAktif->id);
            });
        } else {
            // Jika tidak ada tahun aktif, jangan tampilkan nilai apa pun
            $nilaiQuery->whereRaw('1 = 0');
        }

        $nilaiCollection = $nilaiQuery->get();

        // Filter lagi untuk memastikan tidak ada tryout yang null (pengaman tambahan)
        $nilai = $nilaiCollection->filter(function ($n) {
            return $n->tryout !== null;
        })->sortBy(function ($n) {
            return $n->tryout?->nama_tryout;
        })->groupBy('tryout_id');

        // --- PERUBAHAN SELESAI ---

        return view('dashboard_orang_tua', compact('siswa', 'nilai', 'mataPelajarans', 'statusKedinasan', 'tahunPelajaranAktif'));
    }
    // public function index()
    // {
    //     $siswa = Auth::guard('parent')->user();

    //     // Ambil nilai status_kedinasan dari kelas siswa
    //     $statusKedinasan = $siswa->kelas->status_kedinasan;

    //     // Menyaring mata pelajaran berdasarkan status_kedinasan
    //     if ($statusKedinasan === 1) {
    //         $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
    //     } elseif ($statusKedinasan === 0) {
    //         $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
    //     } else {
    //         // Jika status_kedinasan adalah 2, ambil semua mata pelajaran
    //         $mataPelajarans = MataPelajaran::all();
    //     }

    //     // $nilai = Nilai::where('siswa_id', $siswa->id)
    //     //     ->with(['tryout.tahunPelajaran', 'mataPelajaran'])
    //     //     ->get()
    //     //     ->sortBy(function ($nilai) {
    //     //         return $nilai->tryout->nama_tryout;
    //     //     })
    //     //     ->groupBy('tryout_id');
    //     // Ambil koleksi nilai terlebih dahulu
    //     $nilaiCollection = Nilai::where('siswa_id', $siswa->id)
    //         ->with(['tryout.tahunPelajaran', 'mataPelajaran'])
    //         ->get();

    //     // Filter nilai yang relasi tryout-nya tidak null (tidak terhapus)
    //     $nilai = $nilaiCollection->filter(function ($nilai) {
    //         return $nilai->tryout !== null;
    //     })->sortBy(function ($nilai) {
    //         // Gunakan nullsafe operator untuk keamanan ekstra
    //         return $nilai->tryout?->nama_tryout;
    //     })->groupBy('tryout_id');
    //     // $mataPelajarans = MataPelajaran::all(); // Pastikan ini dikirim ke view

    //     $statusKedinasan = $siswa->kelas->status_kedinasan;

    //     return view('dashboard_orang_tua', compact('siswa', 'nilai', 'mataPelajarans', 'statusKedinasan'));
    // }

    public function downloadSertifikat(Request $request, $id)
    {
        $siswa = Siswa::with('kelas', 'programBimbel')->findOrFail($id);

        if (!$siswa->kelas) {
            return redirect()->back()->with('error', 'Siswa tidak terdaftar di kelas manapun.');
        }

        $tahunPelajaranAktif = TahunPelajaran::where('status', true)->first();

        if (!$tahunPelajaranAktif) {
            return redirect()->back()->with('error', 'Tidak ada Tahun Pelajaran yang aktif.');
        }

        $nilai = $siswa->nilais()
            ->whereHas('tryout', function ($query) use ($tahunPelajaranAktif) {
                $query->where('tahun_pelajaran_id', $tahunPelajaranAktif->id);
            })
            ->with(['mataPelajaran', 'tryout.tahunPelajaran'])
            ->get()
            ->sortBy(function ($nilai) {
                return $nilai->tryout?->nama_tryout;
            })
            ->groupBy('tryout_id');

        if ($nilai->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data nilai untuk diunduh pada tahun pelajaran aktif.');
        }

        $statusKedinasan = $siswa->kelas->status_kedinasan;

        if ($statusKedinasan === 1) {
            $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
        } elseif ($statusKedinasan === 0) {
            $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
        } else {
            $mataPelajarans = MataPelajaran::all();
        }

        $mataPelajaransFalse = $mataPelajarans->where('opsi_test_tps', false);
        $mataPelajaransTrue = $mataPelajarans->where('opsi_test_tps', true);

        // --- PERBAIKAN DI SINI ---
        // Menghapus 'tahun_pelajaran_id' dari query karena kolomnya tidak ada di tabel
        $sertifikatperkembangan = SertifikatPerkembangan::firstOrCreate(
            ['siswa_id' => $id],
            ['no_sertifikat' => strtoupper(Str::random(10)), 'status' => true]
        );
        // --- AKHIR PERBAIKAN ---

        $settingSertifikat = SettingSertifikat::where('status', true)->first();

        $pdf = Pdf::loadView('sertifikat_orang_tua', compact('siswa', 'nilai', 'mataPelajaransFalse', 'mataPelajaransTrue', 'sertifikatperkembangan', 'statusKedinasan', 'mataPelajarans', 'settingSertifikat'))
            ->setPaper('a4', 'landscape');

        $fileName = 'Rapor_Perkembangan_' . str_replace(' ', '_', $siswa->nama_siswa) . '_' . date('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }

    public function downloadSertifikatTryout(Request $request, $id, $tryout_id)
    {
        $siswa = Siswa::with(['kelas', 'nilais' => function ($query) use ($tryout_id) {
            $query->where('tryout_id', $tryout_id)->with('mataPelajaran', 'tryout.tahunPelajaran');
        }])->findOrFail($id);

        if (!$siswa->kelas) {
            return redirect()->back()->with('error', 'Siswa tidak terdaftar di kelas manapun.');
        }

        $nilai = $siswa->nilais->groupBy('tryout_id');

        if ($nilai->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data nilai untuk tryout ini.');
        }

        $statusKedinasan = $siswa->kelas->status_kedinasan;

        if ($statusKedinasan === 1) {
            $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
        } elseif ($statusKedinasan === 0) {
            $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
        } else {
            $mataPelajarans = MataPelajaran::all();
        }

        $mataPelajaransFalse = $mataPelajarans->where('opsi_test_tps', false);
        $mataPelajaransTrue = $mataPelajarans->where('opsi_test_tps', true);

        $sertifikat = SertifikatTryout::firstOrCreate(
            ['siswa_id' => $id, 'tryout_id' => $tryout_id],
            ['no_sertifikat' => strtoupper(Str::random(10)), 'status' => true]
        );

        $settingSertifikat = SettingSertifikat::where('status', true)->first();

        $src = null;
        if ($siswa->foto_siswa && Storage::disk('public')->exists($siswa->foto_siswa)) {
            $imagePath = storage_path('app/public/' . $siswa->foto_siswa);
            try {
                $imageData = base64_encode(file_get_contents($imagePath));
                $src = 'data:image/png;base64,' . $imageData;
            } catch (\Exception $e) {
                // Biarkan $src null jika file tidak bisa dibaca
            }
        }

        $pdf = Pdf::loadView('sertifikat_orang_tua_tryout', compact('siswa', 'nilai', 'mataPelajaransFalse', 'mataPelajaransTrue', 'sertifikat', 'settingSertifikat', 'src'))
            ->setPaper('a4', 'landscape');

        $tryoutName = $nilai->first()->first()->tryout?->nama_tryout ?? 'Tryout';
        $filename = 'Sertifikat_' . str_replace(' ', '_', $siswa->nama_siswa) . '_' . str_replace(' ', '_', $tryoutName) . '_' . date('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    // public function downloadSertifikat(Request $request, $id)
    // {
    //     $siswa = Siswa::with(['kelas', 'nilais.mataPelajaran', 'nilais.tryout.tahunPelajaran'])->findOrFail($id);


    //     // $mataPelajarans = MataPelajaran::all();

    //     // Mengambil status_kedinasan dari kelas siswa
    //     $statusKedinasan = $siswa->kelas->status_kedinasan;

    //     // Menyaring mata pelajaran berdasarkan status_kedinasan
    //     if ($statusKedinasan === 1) {
    //         $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
    //     } elseif ($statusKedinasan === 0) {
    //         $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
    //     } else {
    //         // Jika status_kedinasan adalah 2, ambil semua mata pelajaran
    //         $mataPelajarans = MataPelajaran::all();
    //     }

    //     // $nilai = $siswa->nilais->groupBy('tryout_id');

    //     // Mengurutkan nilai berdasarkan nama tryout
    //     // $nilai = $siswa->nilais->sortBy(function ($nilai) {
    //     //     return $nilai->tryout->nama_tryout;
    //     // })->groupBy('tryout_id');
    //     // Filter nilai yang relasi tryout-nya tidak null sebelum diurutkan
    //     $nilai = $siswa->nilais->filter(function ($n) {
    //         return $n->tryout !== null;
    //     })->sortBy(function ($nilai) {
    //         return $nilai->tryout?->nama_tryout;
    //     })->groupBy('tryout_id');

    //     // Pisahkan mata pelajaran berdasarkan opsi_test_tps
    //     $mataPelajaransFalse = $mataPelajarans->where('opsi_test_tps', false);
    //     $mataPelajaransTrue = $mataPelajarans->where('opsi_test_tps', true);

    //     // Check if sertifikat exists
    //     $sertifikatperkembangan = SertifikatPerkembangan::firstOrCreate(
    //         ['siswa_id' => $id],
    //         ['no_sertifikat' => strtoupper(Str::random(10)), 'status' => true]
    //     );

    //     // Fetch the active setting sertifikat
    //     $settingSertifikat = SettingSertifikat::where('status', true)->first();

    //     $pdf = Pdf::loadView('sertifikat_orang_tua', compact('siswa', 'nilai', 'mataPelajaransFalse', 'mataPelajaransTrue', 'sertifikatperkembangan', 'statusKedinasan', 'mataPelajarans', 'settingSertifikat'))
    //         ->setPaper('a4', 'landscape');

    //     // return $pdf->download('sertifikat.pdf');

    //     $fileName = 'Sertifikat_perkembangan_' . str_replace(' ', '_', $siswa->nama_siswa) . '_' . date('Ymd_His') . '.pdf';

    //     return $pdf->download($fileName);
    // }

    // public function downloadSertifikatTryout(Request $request, $id, $tryout_id)
    // {
    //     $siswa = Siswa::with(['kelas', 'nilais' => function ($query) use ($tryout_id) {
    //         $query->where('tryout_id', $tryout_id)->with('mataPelajaran', 'tryout.tahunPelajaran');
    //     }])->findOrFail($id);

    //     // $mataPelajarans = MataPelajaran::all();

    //     // Mengambil status_kedinasan dari kelas siswa
    //     $statusKedinasan = $siswa->kelas->status_kedinasan;

    //     // Menyaring mata pelajaran berdasarkan status_kedinasan
    //     if ($statusKedinasan === 1) {
    //         $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
    //     } elseif ($statusKedinasan === 0) {
    //         $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
    //     } else {
    //         // Jika status_kedinasan adalah 2, ambil semua mata pelajaran
    //         $mataPelajarans = MataPelajaran::all();
    //     }

    //     // Mengurutkan nilai berdasarkan nama tryout
    //     // $nilai = $siswa->nilais->sortBy(function ($nilai) {
    //     //     return $nilai->tryout->nama_tryout;
    //     // })->groupBy('tryout_id');
    //     // Filter nilai yang relasi tryout-nya tidak null sebelum diurutkan
    //     $nilai = $siswa->nilais->filter(function ($n) {
    //         return $n->tryout !== null;
    //     })->sortBy(function ($nilai) {
    //         return $nilai->tryout?->nama_tryout;
    //     })->groupBy('tryout_id');

    //     // Pisahkan mata pelajaran berdasarkan opsi_test_tps
    //     $mataPelajaransFalse = $mataPelajarans->where('opsi_test_tps', false);
    //     $mataPelajaransTrue = $mataPelajarans->where('opsi_test_tps', true);

    //     // Check if sertifikat exists
    //     $sertifikat = SertifikatTryout::firstOrCreate(
    //         ['siswa_id' => $id, 'tryout_id' => $tryout_id],
    //         ['no_sertifikat' => strtoupper(Str::random(10)), 'status' => true]
    //     );

    //     // Generate barcode for the sertifikat as base64
    //     // $barcode = generateQrCodeBase64($sertifikat->no_sertifikat);

    //     // Fetch the active setting sertifikat
    //     $settingSertifikat = SettingSertifikat::where('status', true)->first();

    //     // Encode image to Base64
    //     $imagePath = url('storage/' . $siswa->foto_siswa);
    //     $imageData = base64_encode(file_get_contents($imagePath));
    //     $src = 'data:image/png;base64,' . $imageData;

    //     $pdf = Pdf::loadView('sertifikat_orang_tua_tryout', compact('siswa', 'nilai', 'mataPelajaransFalse', 'mataPelajaransTrue', 'sertifikat', 'settingSertifikat', 'src'))
    //         ->setPaper('a4', 'landscape');

    //     $filename = 'Sertifikat_' . $siswa->nama_siswa . '_Tryout_' . $nilai->first()->first()->tryout->nama_tryout . '_' . date('Ymd_His') . '.pdf';

    //     return $pdf->download($filename);
    // }

    public function showLoginForm()
    {
        if (Auth::guard('parent')->check()) {
            return redirect()->route('orang_tua.index');
        }
        return view('orang_tua');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nis', 'password');

        if (Auth::guard('parent')->attempt($credentials)) {
            return redirect()->intended(route('orang_tua.index'));
        }

        // return redirect()->back()->withErrors(['nis' => 'NIS atau password salah.']);
        return redirect()->back()->with('error', 'NIS atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::guard('parent')->logout();
        return redirect()->route('parent.login');
    }

    public function detailAbsensi(Request $request)
    {
        $siswa = Auth::guard('parent')->user();

        // --- PERUBAHAN DIMULAI DI SINI ---
        $tahunPelajaranAktif = TahunPelajaran::where('status', true)->first();

        $query = AbsensiDetail::with('absensi.guru', 'absensi.kelas', 'absensi.guru.mataPelajaran')
            ->where('siswa_id', $siswa->id);

        // Filter absensi berdasarkan tahun pelajaran aktif
        if ($tahunPelajaranAktif) {
            $query->whereHas('absensi.kelas', function ($q) use ($tahunPelajaranAktif) {
                $q->where('tahun_pelajaran_id', $tahunPelajaranAktif->id);
            });
        } else {
            $query->whereRaw('1 = 0'); // Tidak menampilkan data jika tidak ada tahun aktif
        }
        // --- PERUBAHAN SELESAI ---

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

        $totalQuery = clone $query;
        $hadirCount = (clone $totalQuery)->where('kehadiran', 1)->count();
        $tidakHadirCount = (clone $totalQuery)->where('kehadiran', 0)->count();
        $sakitCount = (clone $totalQuery)->where('kehadiran', 2)->count();
        $absensiDetails = $query->paginate(10);

        $mataPelajarans = collect();
        if ($siswa && $siswa->kelas) {
            $statusKedinasan = $siswa->kelas->status_kedinasan;
            if ($statusKedinasan === 1) {
                $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
            } elseif ($statusKedinasan === 0) {
                $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
            } else {
                $mataPelajarans = MataPelajaran::all();
            }
        }

        return view('detail_absensi', compact('absensiDetails', 'siswa', 'mataPelajarans', 'request', 'hadirCount', 'tidakHadirCount', 'sakitCount', 'tahunPelajaranAktif'));
    }

    // public function detailAbsensi(Request $request)
    // {
    //     // Ambil data siswa yang sedang login
    //     $siswa = Auth::guard('parent')->user();

    //     // Membuat query untuk mengambil data absensi siswa berdasarkan filter yang diberikan
    //     $query = AbsensiDetail::with('absensi.guru', 'absensi.kelas', 'absensi.guru.mataPelajaran')
    //         ->where('siswa_id', $siswa->id);

    //     // Filter berdasarkan tanggal mulai dan akhir jika tersedia
    //     if ($request->has('start_date') && $request->has('end_date')) {
    //         $query->whereHas('absensi', function ($q) use ($request) {
    //             $q->whereBetween('tanggal', [$request->start_date, $request->end_date]);
    //         });
    //     }

    //     // Filter berdasarkan mata pelajaran yang diikuti oleh siswa
    //     if ($request->has('mata_pelajaran_id') && $request->mata_pelajaran_id != '') {
    //         $query->whereHas('absensi.guru.mataPelajaran', function ($q) use ($request) {
    //             $q->where('id', $request->mata_pelajaran_id);
    //         });
    //     }

    //     // Clone query untuk perhitungan total data tanpa paginasi
    //     $totalQuery = clone $query;

    //     // Hitung jumlah kehadiran untuk setiap kategori dari seluruh data (tanpa paginasi)
    //     // Clone query untuk menghitung jumlah kehadiran yang hadir
    //     $hadirCount = (clone $totalQuery)->where('kehadiran', 1)->count();

    //     // Clone query untuk menghitung jumlah yang tidak hadir
    //     $tidakHadirCount = (clone $totalQuery)->where('kehadiran', 0)->count();

    //     // Clone query untuk menghitung jumlah yang sakit
    //     $sakitCount = (clone $totalQuery)->where('kehadiran', 2)->count();

    //     // Kembalikan query utama untuk paginasi
    //     $absensiDetails = $query->paginate(10);

    //     // Filter mata pelajaran berdasarkan status kedinasan siswa
    //     $statusKedinasan = $siswa->kelas->status_kedinasan;
    //     if ($statusKedinasan === 1) {
    //         $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
    //     } elseif ($statusKedinasan === 0) {
    //         $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
    //     } else {
    //         $mataPelajarans = MataPelajaran::all();
    //     }

    //     // Mengirim data yang dibutuhkan ke view
    //     return view('detail_absensi', compact('absensiDetails', 'siswa', 'mataPelajarans', 'request', 'hadirCount', 'tidakHadirCount', 'sakitCount'));
    // }

    public function showSertifikatTryout(Request $request, $id, $tryout_id)
    {
        $siswa = Siswa::with(['kelas', 'nilais' => function ($query) use ($tryout_id) {
            $query->where('tryout_id', $tryout_id)->with('mataPelajaran', 'tryout.tahunPelajaran');
        }])->findOrFail($id);

        // Mengambil status_kedinasan dari kelas siswa
        $statusKedinasan = $siswa->kelas->status_kedinasan;

        // Menyaring mata pelajaran berdasarkan status_kedinasan
        if ($statusKedinasan === 1) {
            $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
        } elseif ($statusKedinasan === 0) {
            $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
        } else {
            // Jika status_kedinasan adalah 2, ambil semua mata pelajaran
            $mataPelajarans = MataPelajaran::all();
        }

        // Mengurutkan nilai berdasarkan nama tryout
        // $nilai = $siswa->nilais->sortBy(function ($nilai) {
        //     return $nilai->tryout->nama_tryout;
        // })->groupBy('tryout_id');
        $nilai = $siswa->nilais->filter(function ($n) {
            return $n->tryout !== null;
        })->sortBy(function ($nilai) {
            return $nilai->tryout?->nama_tryout;
        })->groupBy('tryout_id');

        // Pisahkan mata pelajaran berdasarkan opsi_test_tps
        $mataPelajaransFalse = $mataPelajarans->where('opsi_test_tps', false);
        $mataPelajaransTrue = $mataPelajarans->where('opsi_test_tps', true);

        // Check if sertifikat exists
        $sertifikat = SertifikatTryout::firstOrCreate(
            ['siswa_id' => $id, 'tryout_id' => $tryout_id],
            ['no_sertifikat' => strtoupper(Str::random(10)), 'status' => true]
        );

        // Fetch the active setting sertifikat
        $settingSertifikat = SettingSertifikat::where('status', true)->first();

        // Menampilkan view tanpa mendownload PDF
        return view('sertifikat_orang_tua_tryout', compact('siswa', 'nilai', 'mataPelajaransFalse', 'mataPelajaransTrue', 'sertifikat', 'settingSertifikat'));
    }
}
