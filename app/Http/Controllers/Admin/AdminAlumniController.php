<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\JenisPt;
use Illuminate\Http\Request;
use App\Imports\AlumniImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ImportAlumniRequest;
use App\Exports\AlumniFormatExport;

class AdminAlumniController extends Controller
{
    public function index(Request $request)
    {

        $query = Alumni::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_alumni', 'like', '%' . $search . '%');
        }

        $alumnis = $query->simplePaginate(10)->appends(['search' => $request->input('search')]);
        $jenisPts = JenisPt::all();
        return view('admin.alumni.index', compact('alumnis', 'jenisPts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alumni' => 'required|string|max:255',
            'jenis_perguruan_tinggi_id' => 'required|uuid',
            'nama_universitas' => 'required|string|max:255',
            'tahun_lulusan' => 'required|integer|digits:4|min:1900|max:' . date('Y'),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $alumni = new Alumni();
        $alumni->nama_alumni = $request->nama_alumni;
        $alumni->jenis_perguruan_tinggi_id = $request->jenis_perguruan_tinggi_id;
        $alumni->nama_universitas = $request->nama_universitas;
        $alumni->tahun_lulusan = $request->tahun_lulusan;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_alumni', $filename);
            $alumni->foto = 'foto_alumni/' . $filename;
        }

        $alumni->status = true;
        $alumni->save();

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alumni' => 'required',
            'jenis_perguruan_tinggi_id' => 'required',
            'nama_universitas' => 'required',
            'tahun_lulusan' => 'required|integer|digits:4|min:1900|max:' . date('Y'),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $alumni = Alumni::findOrFail($id);
        $alumni->nama_alumni = $request->nama_alumni;
        $alumni->jenis_perguruan_tinggi_id = $request->jenis_perguruan_tinggi_id;
        $alumni->nama_universitas = $request->nama_universitas;
        $alumni->tahun_lulusan = $request->tahun_lulusan;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_alumni', 'public');
            $alumni->foto = $fotoPath;
        }

        $alumni->save();

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->delete();

        return response()->json(['message' => 'Data alumni berhasil dihapus.']);
    }

    // public function import(ImportAlumniRequest $request)
    // {
    //     Excel::import(new AlumniImport, $request->file('file'));

    //     return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diimport.');
    // }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new AlumniImport, $request->file('file'));

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diimpor.');
    }

    public function downloadFormat()
    {
        return Excel::download(new AlumniFormatExport, 'format_import_alumni.xlsx');
    }

}
