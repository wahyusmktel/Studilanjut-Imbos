<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramBimbel;
use Illuminate\Http\Request;

class ProgramBimbelController extends Controller
{
    public function index(Request $request)
    {
        $query = ProgramBimbel::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_program', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi_program', 'like', '%' . $search . '%');
        }

        $programBimbels = $query->paginate(10);

        return view('admin.program_bimbel.program_bimbel', compact('programBimbels'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi_program' => 'required|string',
            // 'icon_program' => 'required|string|max:255',
        ]);

        ProgramBimbel::create($validatedData);

        return redirect()->route('admin.program_bimbel.index')->with('success', 'Data Program Bimbel berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi_program' => 'required|string',
            // 'icon_program' => 'required|string|max:255',
        ]);

        $programBimbel = ProgramBimbel::findOrFail($id);
        $programBimbel->update($validatedData);

        return redirect()->route('admin.program_bimbel.index')->with('success', 'Data Program Bimbel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $programBimbel = ProgramBimbel::findOrFail($id);
        $programBimbel->delete();

        // return redirect()->route('admin.program_bimbel.program_bimbel')->with('success', 'Data Program Bimbel berhasil dihapus.');
        return response()->json(['success' => 'Data Program Bimbel berhasil dihapus.']);
    }
}
