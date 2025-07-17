<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pendaftaran;
use App\Models\Pengaturan;
use App\Models\TahunAjaran;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::getActiveTestimonials();
        return view('pages.home.index', compact('testimonials'));
    }
}
