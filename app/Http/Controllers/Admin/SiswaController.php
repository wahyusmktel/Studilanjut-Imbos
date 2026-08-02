<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\ProgramBimbel;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = Siswa::query();

    //     if ($request->has('search')) {
    //         $search = $request->input('search');
    //         $query->where('nama_siswa', 'like', '%' . $search . '%')
    //             ->orWhere('nis', 'like', '%' . $search . '%');
    //     }

    //     $siswas = $query->paginate(10);
    //     $kelas = Kelas::all();
    //     $programBimbels = ProgramBimbel::all();

    //     return view('admin.siswa.index', compact('siswas', 'kelas', 'programBimbels'));
    // }

    public function index(Request $request)
    {
        // --- PERUBAHAN DIMULAI DI SINI ---

        // 2. Dapatkan tahun pelajaran yang statusnya aktif
        $tahunPelajaranAktif = TahunPelajaran::where('status', true)->first();

        // 3. Siapkan query builder untuk Siswa dan eager load relasi untuk optimasi
        $query = Siswa::query()->with(['kelas', 'programBimbel']);

        $kelas = collect(); // Inisialisasi sebagai koleksi kosong

        if ($tahunPelajaranAktif) {
            // 4. Dapatkan ID semua kelas yang termasuk dalam tahun pelajaran aktif
            $kelasAktifIds = Kelas::where('tahun_pelajaran_id', $tahunPelajaranAktif->id)->pluck('id');

            // 5. Filter siswa berdasarkan kelas_id yang aktif saja
            $query->whereIn('kelas_id', $kelasAktifIds);

            // 6. Ambil data kelas yang aktif saja untuk dropdown di form tambah/edit
            $kelas = Kelas::where('tahun_pelajaran_id', $tahunPelajaranAktif->id)->orderBy('nama_kelas', 'asc')->get();
        } else {
            // Jika tidak ada tahun pelajaran aktif, jangan tampilkan siswa sama sekali untuk mencegah error
            $query->whereRaw('1 = 0');
        }

        // Logika pencarian tetap ada
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }

        $siswas = $query->paginate(10);
        $programBimbels = ProgramBimbel::all();

        // --- PERUBAHAN SELESAI ---

        return view('admin.siswa.index', compact('siswas', 'kelas', 'programBimbels', 'tahunPelajaranAktif'));
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'kelas_id' => 'required|uuid',
    //         'program_bimbel_id' => 'required|uuid',
    //         'nama_siswa' => 'required|string|max:255',
    //         'tgl_lahir' => 'nullable|date',
    //         'tmpt_lahir' => 'nullable|string|max:255',
    //         'no_hp' => 'nullable|string|max:15',
    //         'nis' => 'required|integer|unique:siswas,nis',
    //         'password' => 'required|string|max:255',
    //         'foto' => 'nullable|image|max:2048',
    //     ]);

    //     if ($request->hasFile('foto')) {
    //         $data['foto_siswa'] = $request->file('foto')->store('foto_siswa', 'public');
    //     }

    //     $data['id'] = Str::uuid();
    //     $data['password'] = Hash::make($data['password']);
    //     $data['status'] = true;

    //     Siswa::create($data);

    //     return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        try {
            // Validasi data
            $data = $request->validate([
                'kelas_id' => 'required|uuid',
                'program_bimbel_id' => 'required|uuid',
                'nama_siswa' => 'required|string|max:255',
                'tgl_lahir' => 'nullable|date',
                'tmpt_lahir' => 'nullable|string|max:255',
                'no_hp' => 'nullable|string|max:15',
                'nis' => 'required|integer|unique:siswas,nis',
                'password' => 'required|string|max:255',
                'foto' => 'nullable|image|max:2048',
            ], [
                'kelas_id.required' => 'Kelas harus dipilih.',
                'kelas_id.uuid' => 'Format ID kelas tidak valid.',
                'program_bimbel_id.required' => 'Program bimbel harus dipilih.',
                'program_bimbel_id.uuid' => 'Format ID program bimbel tidak valid.',
                'nama_siswa.required' => 'Nama siswa wajib diisi.',
                'nama_siswa.string' => 'Nama siswa harus berupa teks.',
                'nama_siswa.max' => 'Nama siswa maksimal 255 karakter.',
                'tgl_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
                'tmpt_lahir.max' => 'Tempat lahir maksimal 255 karakter.',
                'no_hp.max' => 'Nomor HP maksimal 15 karakter.',
                'nis.required' => 'NIS wajib diisi.',
                'nis.integer' => 'NIS harus berupa angka.',
                'nis.unique' => 'NIS sudah terdaftar.',
                'password.required' => 'Password wajib diisi.',
                'password.string' => 'Password harus berupa teks.',
                'password.max' => 'Password maksimal 255 karakter.',
                'foto.image' => 'Foto harus berupa file gambar.',
                'foto.max' => 'Ukuran foto maksimal 2MB.',
            ]);

            // Cek apakah ada file foto yang diupload
            if ($request->hasFile('foto')) {
                $data['foto_siswa'] = $request->file('foto')->store('foto_siswa', 'public');
            }

            // Generate UUID untuk id dan enkripsi password
            $data['id'] = Str::uuid();
            $data['password'] = Hash::make($data['password']);
            $data['status'] = true;

            // Simpan data siswa
            Siswa::create($data);

            // Redirect jika berhasil
            return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Kembalikan ke halaman sebelumnya dengan error message
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data siswa. ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            $data = $request->validate([
                'kelas_id' => 'required|uuid',
                'program_bimbel_id' => 'required|uuid',
                'nama_siswa' => 'required|string|max:255',
                'tgl_lahir' => 'nullable|date',
                'tmpt_lahir' => 'nullable|string|max:255',
                'no_hp' => 'nullable|string|max:15',
                'nis' => 'required|integer|unique:siswas,nis,' . $siswa->id,
                'password' => 'nullable|string|max:255|confirmed',
                'foto' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                if ($siswa->foto_siswa && \Storage::disk('public')->exists($siswa->foto_siswa)) {
                    \Storage::disk('public')->delete($siswa->foto_siswa);
                }
                $data['foto_siswa'] = $request->file('foto')->store('foto_siswa', 'public');
            }

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->input('password'));
            } else {
                unset($data['password']);
            }

            $siswa->update($data);

            return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->route('admin.siswa.index')->with('error', 'Terjadi kesalahan saat mengupdate data siswa.');
        }
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        // return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa berhasil dihapus.');
        return response()->json(['success' => 'Data Siswa berhasil dihapus.']);
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data siswa berhasil diimport.');
    }
}
