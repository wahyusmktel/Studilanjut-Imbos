<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisPt;
use Illuminate\Http\Request;

class AdminJenisPtController extends Controller
{
    public function index()
    {
        $jenisPts = JenisPt::all();
        return view('admin.jenis_pt.index', compact('jenisPts'));
    }
}
