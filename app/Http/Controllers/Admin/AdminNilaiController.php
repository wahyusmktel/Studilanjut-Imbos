<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Tryout;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiTemplateExport;
use App\Imports\NilaiImport;

class AdminNilaiController extends Controller
{
    public function index(Request $request)
    {
        // --- MULAI PERUBAHAN LOGIKA ---

        // 1. Selalu mulai dengan Tahun Pelajaran yang aktif
        $tahunAktif = TahunPelajaran::where('status', 1)->first();

        $tahunPelajarans = TahunPelajaran::orderBy('nama_tahun_pelajaran', 'desc')->get();

        // 2. Siapkan variabel untuk dikirim ke view
        $tryouts = collect();
        $nilais = collect();

        // 3. Hanya jalankan query jika ada tahun pelajaran yang aktif
        if ($tahunAktif) {
            // Ambil SEMUA tryout yang termasuk dalam tahun pelajaran aktif
            $tryouts = Tryout::where('tahun_pelajaran_id', $tahunAktif->id)->get();

            // Ambil filter dari request
            $tryoutId = $request->input('tryout_id');
            $kelasId = $request->input('kelas_id');
            $search = $request->input('search');

            // 4. Bangun query utama dari Nilai, pastikan terhubung dengan Tryout yang valid
            $query = Nilai::query()->whereHas('tryout', function ($q) use ($tahunAktif) {
                $q->where('tahun_pelajaran_id', $tahunAktif->id);
            });

            // Terapkan filter tambahan jika ada
            if ($search) {
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', '%' . $search . '%');
                });
            }

            if ($tryoutId) {
                $query->where('tryout_id', $tryoutId);
            }

            if ($kelasId) {
                $query->whereHas('siswa', function ($q) use ($kelasId) {
                    $q->where('kelas_id', $kelasId);
                });
            }

            $nilais = $query->with(['siswa.kelas', 'tryout', 'mataPelajaran'])->paginate(10)->appends($request->all());
        }

        // Ambil semua kelas untuk filter dropdown
        $kelas = Kelas::all(); // Ini sudah otomatis terfilter oleh scope yang kita pasang sebelumnya

        // Ambil data nilai yang sudah ada untuk form (logika ini bisa disederhanakan nanti jika perlu)
        $siswas = $request->input('kelas_id') ? Siswa::where('kelas_id', $request->input('kelas_id'))->get() : collect();
        $existingNilai = Nilai::where('tryout_id', $request->input('tryout_id'))
            ->whereIn('siswa_id', $siswas->pluck('id'))
            ->get()
            ->groupBy('siswa_id')
            ->map(function ($items) {
                return $items->keyBy('mata_pelajaran_id');
            });

        // Kirim semua data yang dibutuhkan ke view
        return view('admin.nilai.data_nilai', [
            'nilais' => $nilais,
            'tahunAktif' => $tahunAktif, // Kirim objek tahun aktif
            'tahunPelajarans' => $tahunPelajarans,
            'tryouts' => $tryouts,
            'kelas' => $kelas,
            'siswas' => $siswas,
            'existingNilai' => $existingNilai,
            // Kirim kembali nilai filter untuk ditampilkan di form
            'tryoutId' => $request->input('tryout_id'),
            'kelasId' => $request->input('kelas_id'),
            'search' => $request->input('search'),
            // Variabel lain jika masih dibutuhkan oleh view
            'mataPelajarans' => MataPelajaran::all(),
            'isKedinasan' => $request->input('kelas_id') ? (Kelas::find($request->input('kelas_id'))->status_kedinasan ?? false) : false
        ]);
    }

    public function getTryouts(Request $request)
    {
        $tryouts = Tryout::where('tahun_pelajaran_id', $request->tahun_pelajaran_id)->pluck('nama_tryout', 'id');

        return response()->json($tryouts);
    }

    // public function getTryouts(Request $request)
    // {
    //     $tahunPelajaranId = $request->input('tahun_pelajaran_id');
    //     \Log::info('Fetching tryouts for tahun_pelajaran_id: ' . $tahunPelajaranId);
    //     $tryouts = Tryout::where('tahun_pelajaran_id', $tahunPelajaranId)->pluck('nama_tryout', 'id');
    //     \Log::info('Fetched tryouts: ' . $tryouts->toJson());

    //     return response()->json($tryouts);
    // }


    // public function getSiswas(Request $request)
    // {
    //     try {
    //         // \Log::info('Fetching siswas for kelas_id: ' . $request->kelas_id . ' and tryout_id: ' . $request->tryout_id);

    //         // Mengambil siswa dengan nilai yang sesuai dengan tryout yang dipilih
    //         $siswas = Siswa::with(['nilais' => function($query) use ($request) {
    //             $query->where('tryout_id', $request->tryout_id);
    //         }])->where('kelas_id', $request->kelas_id)->get();

    //         // Cek status kedinasan kelas
    //         $isKedinasan = false;
    //         $kelas = Kelas::find($request->kelas_id);
    //         if ($kelas && $kelas->status_kedinasan) {
    //             $isKedinasan = true;
    //         }

    //         // Fetch mata pelajaran sesuai kondisi kedinasan
    //         $mataPelajarans = MataPelajaran::all();
    //         if ($isKedinasan) {
    //             $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
    //         }

    //         // \Log::info('Fetched siswas: ' . $siswas->toJson());
    //         // return response()->json($siswas);
    //         return response()->json(['siswas' => $siswas, 'mataPelajarans' => $mataPelajarans]);
    //     } catch (\Exception $e) {
    //         // \Log::error('Error fetching siswas: ' . $e->getMessage());
    //         return response()->json(['error' => 'Error fetching siswas'], 500);
    //     }
    // }

    // public function getSiswas(Request $request)
    // {
    //     try {
    //         // Mengambil siswa dengan nilai yang sesuai dengan tryout yang dipilih
    //         $siswas = Siswa::with(['nilais' => function($query) use ($request) {
    //             $query->where('tryout_id', $request->tryout_id);
    //         }])->where('kelas_id', $request->kelas_id)->get();

    //         // Cek status kedinasan kelas
    //         $kelas = Kelas::find($request->kelas_id);
    //         $isKedinasan = $kelas ? $kelas->status_kedinasan : false;

    //         // Fetch mata pelajaran sesuai kondisi kedinasan
    //         $mataPelajarans = MataPelajaran::where(function ($query) use ($isKedinasan) {
    //             if ($isKedinasan === true) {
    //                 // Jika kelas memiliki status kedinasan true, ambil mata pelajaran dengan opsi_kedinasan true
    //                 $query->where('opsi_kedinasan', true);
    //             } elseif ($isKedinasan === false) {
    //                 // Jika kelas memiliki status kedinasan false, ambil mata pelajaran dengan opsi_kedinasan false
    //                 $query->where('opsi_kedinasan', false);
    //             } elseif ($isKedinasan === 2) {
    //                 // Jika kelas memiliki status kedinasan 2, ambil semua mata pelajaran
    //                 $query->orWhere('opsi_kedinasan', 2)
    //                       ->orWhere('opsi_kedinasan', true)
    //                       ->orWhere('opsi_kedinasan', false);
    //             }
    //         })
    //         ->get();

    //         return response()->json([
    //             'siswas' => $siswas,
    //             'mataPelajarans' => $mataPelajarans,
    //             'isKedinasan' => $isKedinasan
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Error fetching siswas'], 500);
    //     }
    // }

    public function getSiswas(Request $request)
    {
        try {
            // Mengambil siswa dengan nilai yang sesuai dengan tryout yang dipilih
            $siswas = Siswa::with(['nilais' => function ($query) use ($request) {
                $query->where('tryout_id', $request->tryout_id);
            }])->where('kelas_id', $request->kelas_id)->get();

            // Cek status kedinasan kelas
            $kelas = Kelas::find($request->kelas_id);
            $statusKedinasan = $kelas ? $kelas->status_kedinasan : false;

            // Fetch mata pelajaran sesuai kondisi kedinasan
            $mataPelajarans = MataPelajaran::where(function ($query) use ($statusKedinasan) {
                if ($statusKedinasan === 1) {
                    // Jika kelas memiliki status kedinasan true, ambil mata pelajaran dengan opsi_kedinasan true
                    $query->where('opsi_kedinasan', true);
                } elseif ($statusKedinasan === 0) {
                    // Jika kelas tidak memiliki status kedinasan, ambil mata pelajaran dengan opsi_kedinasan false
                    $query->where('opsi_kedinasan', false);
                }
                // Jika status_kedinasan adalah 2, ambil semua mata pelajaran (tidak ada kondisi tambahan yang diperlukan)
            })->get();

            return response()->json([
                'siswas' => $siswas,
                'mataPelajarans' => $mataPelajarans,
                'statusKedinasan' => $statusKedinasan
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching siswas'], 500);
        }
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'nilai.*.*' => 'required|integer|min:10|max:100',
    //         'tryout_id' => 'required|uuid',
    //     ]);

    //     foreach ($data['nilai'] as $siswaId => $nilaiPerPelajaran) {
    //         foreach ($nilaiPerPelajaran as $mataPelajaranId => $nilai) {
    //             Nilai::updateOrCreate(
    //                 [
    //                     'siswa_id' => $siswaId,
    //                     'mata_pelajaran_id' => $mataPelajaranId,
    //                     'tryout_id' => $data['tryout_id'],
    //                 ],
    //                 [
    //                     'nilai' => $nilai,
    //                     'status' => true,
    //                 ]
    //             );
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    // }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nilai' => 'array',
            // 'nilai.*.*' => 'nullable|integer|min:10|max:1000',
            'nilai.*.*' => 'nullable|numeric|min:10|max:1000',
            'tryout_id' => 'required|uuid',
        ]);

        // Iterasi melalui nilai-nilai yang diinputkan
        foreach ($request->input('nilai', []) as $siswaId => $nilaiPerPelajaran) {
            foreach ($nilaiPerPelajaran as $mataPelajaranId => $nilai) {
                // Cek apakah nilai tidak null sebelum disimpan
                if (!is_null($nilai)) {
                    Nilai::updateOrCreate(
                        [
                            'siswa_id' => $siswaId,
                            'mata_pelajaran_id' => $mataPelajaranId,
                            'tryout_id' => $request->tryout_id,
                        ],
                        [
                            'nilai' => $nilai,
                            'status' => true,
                        ]
                    );
                }
            }
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }

    public function nilaiSiswaIndex(Request $request)
    {
        // --- PERUBAHAN DIMULAI DI SINI ---
        $search = $request->input('search');

        // 1. Dapatkan tahun pelajaran yang statusnya aktif
        $tahunPelajaranAktif = TahunPelajaran::where('status', true)->first();

        // 2. Siapkan query builder untuk Siswa
        $query = Siswa::with('kelas');

        // 3. Filter siswa berdasarkan tahun pelajaran aktif
        if ($tahunPelajaranAktif) {
            // Dapatkan ID semua kelas yang termasuk dalam tahun pelajaran aktif
            $kelasAktifIds = Kelas::where('tahun_pelajaran_id', $tahunPelajaranAktif->id)->pluck('id');

            // Filter siswa yang ada di dalam kelas-kelas aktif tersebut
            $query->whereIn('kelas_id', $kelasAktifIds);
        } else {
            // Jika tidak ada tahun pelajaran yang aktif, jangan tampilkan siswa sama sekali
            // untuk mencegah error data lama.
            $query->whereRaw('1 = 0');
        }

        // 4. Terapkan filter pencarian jika ada
        if ($search) {
            $query->where('nama_siswa', 'like', '%' . $search . '%');
        }

        $siswas = $query->paginate(10);
        // --- PERUBAHAN SELESAI ---

        return view('admin.nilai.nilai_siswa', compact('siswas', 'search'));
    }

    public function detail(Request $request, $id)
    {
        // --- PERUBAHAN DIMULAI DI SINI ---

        // 1. Dapatkan tahun pelajaran yang aktif secara otomatis.
        $tahunPelajaranAktif = TahunPelajaran::where('status', true)->first();
        $tryoutId = $request->input('tryout_id');

        // Jika tidak ada tahun pelajaran aktif, kembalikan dengan pesan.
        if (!$tahunPelajaranAktif) {
            return redirect()->route('admin.nilai-siswa.index')->with('error', 'Tidak ada tahun pelajaran yang aktif. Silakan atur terlebih dahulu.');
        }

        // 2. Ambil data siswa dengan nilai yang sudah difilter di level query.
        // Ini lebih efisien daripada memuat semua nilai lalu memfilternya di PHP.
        $siswa = Siswa::with(['kelas', 'nilais' => function ($query) use ($tahunPelajaranAktif) {
            $query->whereHas('tryout', function ($subQuery) use ($tahunPelajaranAktif) {
                $subQuery->where('tahun_pelajaran_id', $tahunPelajaranAktif->id);
            })->with(['mataPelajaran', 'tryout.tahunPelajaran']);
        }])->findOrFail($id);

        // 3. Filter lebih lanjut berdasarkan tryout jika dipilih.
        if ($tryoutId) {
            $siswa->nilais = $siswa->nilais->where('tryout_id', $tryoutId);
        }

        // 4. Ambil daftar tryout hanya dari tahun pelajaran yang aktif.
        $tryouts = Tryout::where('tahun_pelajaran_id', $tahunPelajaranAktif->id)->get();

        // 5. Kirim data tahun pelajaran aktif ke view.
        return view('admin.nilai.detail', compact('siswa', 'tahunPelajaranAktif', 'tryouts', 'tryoutId'));

        // --- AKHIR PERUBAHAN ---
    }


    // public function detail(Request $request, $id)
    // {
    //     $tahunPelajaranId = $request->input('tahun_pelajaran_id');
    //     $tryoutId = $request->input('tryout_id');

    //     // \Log::info('Fetching details for siswa_id: ' . $id);
    //     // \Log::info('tahun_pelajaran_id: ' . $tahunPelajaranId);
    //     // \Log::info('tryout_id: ' . $tryoutId);

    //     $siswa = Siswa::with(['kelas', 'nilais.mataPelajaran', 'nilais.tryout.tahunPelajaran'])->findOrFail($id);

    //     if ($tahunPelajaranId) {
    //         $siswa->nilais = $siswa->nilais->filter(function ($nilai) use ($tahunPelajaranId) {
    //             return $nilai->tryout->tahun_pelajaran_id == $tahunPelajaranId;
    //         });
    //         // \Log::info('Filtered nilais by tahun_pelajaran_id: ' . $siswa->nilais->toJson());
    //     }

    //     if ($tryoutId) {
    //         $siswa->nilais = $siswa->nilais->where('tryout_id', $tryoutId);
    //         // \Log::info('Filtered nilais by tryout_id: ' . $siswa->nilais->toJson());
    //     }

    //     $tahunPelajarans = TahunPelajaran::all();
    //     $tryouts = $tahunPelajaranId ? Tryout::where('tahun_pelajaran_id', $tahunPelajaranId)->get() : collect();

    //     // \Log::info('Returning view with siswa: ' . $siswa->toJson());

    //     return view('admin.nilai.detail', compact('siswa', 'tahunPelajarans', 'tryouts', 'tahunPelajaranId', 'tryoutId'));
    // }

    public function downloadSertifikat(Request $request, $id)
    {
        $tahunPelajaranId = $request->input('tahun_pelajaran_id');
        $tryoutId = $request->input('tryout_id');

        $siswa = Siswa::with(['kelas', 'nilais.mataPelajaran', 'nilais.tryout.tahunPelajaran'])->findOrFail($id);

        if ($tahunPelajaranId) {
            $siswa->nilais = $siswa->nilais->filter(function ($nilai) use ($tahunPelajaranId) {
                return $nilai->tryout->tahun_pelajaran_id == $tahunPelajaranId;
            });
        }

        if ($tryoutId) {
            $siswa->nilais = $siswa->nilais->where('tryout_id', $tryoutId);
        }

        $pdf = Pdf::loadView('admin.nilai.sertifikat', compact('siswa', 'tahunPelajaranId', 'tryoutId'));

        return $pdf->download('sertifikat.pdf');
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);

        $data = $request->validate([
            // 'tryout_id' => 'required|uuid',
            // 'mata_pelajaran_id' => 'required|uuid',
            // 'siswa_id' => 'required|uuid',
            // 'nilai' => 'required|integer|between:10,1000',
            'nilai' => 'required|numeric|between:10,1000',
        ]);

        $nilai->update($data);

        // return redirect()->route('admin.nilai.index')->with('success', 'Data Nilai berhasil diupdate.');
        return back()->with('success', 'Nilai berhasil diupdate.');
    }

    // public function destroy($id)
    // {
    //     $nilai = Nilai::findOrFail($id);
    //     $nilai->delete();

    //     // return redirect()->route('admin.nilai.index')->with('success', 'Data Nilai berhasil dihapus.');
    //     return response()->json(['success' => 'Data Nilai berhasil dihapus.']);
    // }

    public function destroy($id)
    {
        // Cek apakah ada data nilais dengan siswa_id yang diberikan
        $nilais = Nilai::where('siswa_id', $id);

        if ($nilais->count() > 0) {
            // Hapus semua data nilais berdasarkan siswa_id yang diberikan
            $nilais->delete();
            return response()->json(['success' => 'Data Nilai berhasil dihapus.']);
        } else {
            // Mengembalikan respons JSON gagal jika tidak ada data yang ditemukan
            return response()->json(['error' => 'Data Nilai tidak ditemukan.'], 404);
        }
    }

    public function hapusBerdasarkanNilai($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return response()->json(['success' => 'Data Nilai berhasil dihapus.']);
    }

    public function downloadTemplate(Request $request)
    {
        $tryoutId = $request->input('tryout_id');
        $kelasId = $request->input('kelas_id');

        if (!$tryoutId || !$kelasId) {
            return redirect()->back()->with('error', 'Tahun Pelajaran dan Kelas harus dipilih.');
        }

        $tryout = Tryout::find($tryoutId);
        $kelas = Kelas::find($kelasId);

        // Menentukan mata pelajaran yang ditampilkan berdasarkan status_kedinasan
        if ($kelas->status_kedinasan == 1) {
            // Jika status_kedinasan adalah 1, ambil mata pelajaran dengan opsi_kedinasan true
            $mataPelajarans = MataPelajaran::where('opsi_kedinasan', true)->get();
        } elseif ($kelas->status_kedinasan == 0) {
            // Jika status_kedinasan adalah 0, ambil mata pelajaran dengan opsi_kedinasan false
            $mataPelajarans = MataPelajaran::where('opsi_kedinasan', false)->get();
        } else {
            // Jika status_kedinasan adalah 2, ambil semua mata pelajaran
            $mataPelajarans = MataPelajaran::all();
        }

        // $mataPelajarans = MataPelajaran::all();

        $siswas = Siswa::where('kelas_id', $kelasId)->get();

        $data = [
            'tryout' => $tryout,
            'kelas' => $kelas,
            'mataPelajarans' => $mataPelajarans,
            'siswas' => $siswas,
        ];

        return Excel::download(new NilaiTemplateExport($data), 'template_import_nilai.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new NilaiImport, $request->file('file'));

        return redirect()->back()->with('success', 'Nilai berhasil diimport.');
    }

    public function hapusSemua(Request $request)
    {
        $tahunPelajaranId = $request->input('tahun_pelajaran_id');
        $tryoutId = $request->input('tryout_id');
        $kelasId = $request->input('kelas_id');

        // Menghapus data nilai berdasarkan filter yang diterima
        $nilais = Nilai::where('tryout_id', $tryoutId)
            ->whereHas('siswa', function ($query) use ($kelasId) {
                $query->where('kelas_id', $kelasId);
            });

        $jumlahDihapus = $nilais->delete(); // Menghapus

        return response()->json(['success' => "$jumlahDihapus data nilai berhasil dihapus."]);
    }
}
