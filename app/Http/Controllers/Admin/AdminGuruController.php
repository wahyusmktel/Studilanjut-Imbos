<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminGuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', '%' . $search . '%');
        }

        $gurus = $query->simplePaginate(30)->appends(['search' => $request->input('search')]);
        $mataPelajarans = MataPelajaran::all();

        return view('admin.guru.data_guru', compact('gurus', 'mataPelajarans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'mata_pelajaran_id' => 'required|uuid',
            // 'tempat_lahir' => 'required|string|max:255',
            // 'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|max:2048',
            'motto' => 'nullable',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $data['id'] = Str::uuid();
        Guru::create($data);

        return redirect()->route('admin.guru.data_guru')->with('success', 'Data Guru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'mata_pelajaran_id' => 'required|uuid',
            // 'tempat_lahir' => 'required|string|max:255',
            // 'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|max:2048',
            'motto' => 'nullable',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->hasFile('foto')) {
            if ($guru->foto && \Storage::disk('public')->exists($guru->foto)) {
                \Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $guru->update($data);

        return redirect()->route('admin.guru.data_guru')->with('success', 'Data Guru berhasil diupdate.');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        if ($guru->foto && \Storage::disk('public')->exists($guru->foto)) {
            \Storage::disk('public')->delete($guru->foto);
        }
        $guru->delete();

        // return redirect()->route('admin.guru.data_guru')->with('success', 'Data Guru berhasil dihapus.');
        return response()->json(['success' => 'Data Guru berhasil dihapus.']);
    }
}
