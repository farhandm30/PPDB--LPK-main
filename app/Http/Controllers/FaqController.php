<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     */
    public function index()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.faq.index', compact('faqs'));
    }
}
