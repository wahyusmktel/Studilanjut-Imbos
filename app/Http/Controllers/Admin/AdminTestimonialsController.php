<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonials;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminTestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonials::with('alumni')->get();
        $alumnis = Alumni::all();
        return view('admin.testimonials.index', compact('testimonials', 'alumnis'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alumni_id' => 'required|exists:alumnis,id',
            'rating' => 'required|integer|min:1|max:5',
            'isi_testimonial' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Testimonials::create([
            'id' => Str::uuid(),
            'alumni_id' => $request->alumni_id,
            'rating' => $request->rating,
            'isi_testimonial' => $request->isi_testimonial,
            'status' => true,
        ]);

        return response()->json(['message' => 'Testimonial berhasil ditambahkan!'], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alumni_id' => 'required|exists:alumnis,id',
            'rating' => 'required|integer|min:1|max:5',
            'isi_testimonial' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $testimonial = Testimonials::findOrFail($id);
        $testimonial->update([
            'alumni_id' => $request->alumni_id,
            'rating' => $request->rating,
            'isi_testimonial' => $request->isi_testimonial,
        ]);

        return response()->json(['message' => 'Testimonial berhasil diupdate!'], 200);
    }

    public function destroy($id)
    {
        $testimonial = Testimonials::findOrFail($id);
        $testimonial->delete();

        return response()->json(['message' => 'Testimonial berhasil dihapus!'], 200);
    }
}
