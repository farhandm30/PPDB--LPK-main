<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->get('category', 'all');

        $query = Gallery::active()->ordered();

        if ($selectedCategory !== 'all') {
            $query->byCategory($selectedCategory);
        }

        $galleries = $query->paginate(12);
        $categories = Gallery::getCategories();

        return view('pages.gallery.index', compact('galleries', 'categories', 'selectedCategory'));
    }
}
