<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\ProgramBimbel;
use App\Models\Siswa;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminKelasController extends Controller
{
    public function index(Request $request)
    {
        $query = Kelas::query()->withCount('anggota');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_kelas', 'like', '%'.$search.'%')
                ->orWhere('tingkat_kelas', 'like', '%'.$search.'%');
        }

        $kelas = $query->paginate(10);

        return view('admin.kelas.data_kelas', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat_kelas' => 'required|string|max:255',
            'status_kedinasan' => 'required',
        ]);

        // --- MULAI PERUBAHAN ---
        // 1. Cari Tahun Pelajaran yang aktif
        $tahunAktif = TahunPelajaran::where('status', 1)->first();

        // 2. Jika tidak ada yang aktif, kembalikan dengan pesan error
        if (! $tahunAktif) {
            return redirect()->route('admin.kelas.index')->with('error', 'Gagal menambah kelas. Tidak ada Tahun Pelajaran yang aktif.');
        }

        // 3. Gabungkan request dengan tahun_pelajaran_id
        $data = array_merge($request->all(), [
            'tahun_pelajaran_id' => $tahunAktif->id,
        ]);

        Kelas::create($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat_kelas' => 'required|string|max:255',
            'status_kedinasan' => 'required',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        return redirect()->route('admin.kelas.index')->with('success', 'Data Kelas berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        // return redirect()->route('admin.kelas.index')->with('success', 'Data Kelas berhasil dihapus.');
        return response()->json(['success' => 'Data Kelas berhasil dihapus.']);
    }

    public function anggota(Kelas $kelas)
    {
        $members = $kelas->anggota()->orderBy('nama_siswa')->get();
        $programIds = $members->pluck('pivot.program_bimbel_id')->filter()->unique();
        $programsById = ProgramBimbel::whereIn('id', $programIds)->get()->keyBy('id');
        $memberIds = $members->pluck('id');
        $availableStudents = Siswa::whereNotIn('id', $memberIds)
            ->orderBy('nama_siswa')
            ->get();
        $programBimbels = ProgramBimbel::orderBy('nama_program')->get();

        return view('admin.kelas.anggota', compact('kelas', 'members', 'availableStudents', 'programBimbels', 'programsById'));
    }

    public function tambahAnggota(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'siswa_id' => ['required', 'uuid', 'exists:siswas,id'],
            'program_bimbel_id' => ['required', 'uuid', 'exists:program_bimbels,id'],
        ]);

        $alreadyInClass = DB::table('kelas_siswa')
            ->where('kelas_id', $kelas->id)
            ->where('siswa_id', $validated['siswa_id'])
            ->exists();

        if ($alreadyInClass) {
            return back()->with('error', 'Siswa tersebut sudah menjadi anggota kelas ini.');
        }

        $sameProgram = DB::table('kelas_siswa')
            ->where('siswa_id', $validated['siswa_id'])
            ->where('program_bimbel_id', $validated['program_bimbel_id'])
            ->exists();

        if ($sameProgram) {
            return back()->with('error', 'Siswa sudah mengikuti program bimbel tersebut di kelas lain. Gunakan program yang berbeda.');
        }

        DB::transaction(function () use ($kelas, $validated): void {
            DB::table('kelas_siswa')->insert([
                'kelas_id' => $kelas->id,
                'siswa_id' => $validated['siswa_id'],
                'program_bimbel_id' => $validated['program_bimbel_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $siswa = Siswa::findOrFail($validated['siswa_id']);
            if ($siswa->kelas_id === null) {
                $siswa->update([
                    'kelas_id' => $kelas->id,
                    'program_bimbel_id' => $validated['program_bimbel_id'],
                ]);
            }
        });

        return back()->with('success', 'Anggota berhasil ditambahkan ke kelas.');
    }

    public function keluarkanAnggota(Kelas $kelas, Siswa $siswa)
    {
        $membership = DB::table('kelas_siswa')
            ->where('kelas_id', $kelas->id)
            ->where('siswa_id', $siswa->id)
            ->first();

        if (! $membership) {
            return back()->with('error', 'Siswa tersebut bukan anggota kelas ini.');
        }

        DB::transaction(function () use ($kelas, $siswa): void {
            DB::table('kelas_siswa')
                ->where('kelas_id', $kelas->id)
                ->where('siswa_id', $siswa->id)
                ->delete();

            if ($siswa->kelas_id === $kelas->id) {
                $replacement = DB::table('kelas_siswa')
                    ->where('siswa_id', $siswa->id)
                    ->orderBy('created_at')
                    ->first();

                $siswa->update([
                    'kelas_id' => $replacement?->kelas_id,
                    'program_bimbel_id' => $replacement?->program_bimbel_id ?? $siswa->program_bimbel_id,
                ]);
            }
        });

        return back()->with('success', 'Siswa berhasil dikeluarkan dari kelas.');
    }
}
