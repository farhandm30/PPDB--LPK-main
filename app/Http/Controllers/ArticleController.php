<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index()
    {
        $articles = Article::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('pages.article.index', compact('articles'));
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.article.show', compact('article', 'relatedArticles'));
    }
}
