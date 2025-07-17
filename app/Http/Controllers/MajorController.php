<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('pages.majors.index', compact('jurusans'));
    }

    public function show($kode_jurusan)
    {
        $jurusan = Jurusan::where('kode_jurusan', $kode_jurusan)->firstOrFail();
        return view('pages.majors.show', compact('jurusan'));
    }
}