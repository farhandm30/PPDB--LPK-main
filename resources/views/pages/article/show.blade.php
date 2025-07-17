@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <!-- Article Header -->
    <section class="bg-gradient-to-r from-green-700 to-green-500 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="mb-4 text-sm">
                    <span class="mr-2">
                        <i class="far fa-calendar-alt"></i> {{ $article->published_at->format('d M Y') }}
                    </span>
                    <span>
                        <i class="far fa-user"></i> {{ $article->user->name ?? 'Admin' }}
                    </span>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $article->title }}</h1>
                <p class="text-lg">{{ $article->excerpt }}</p>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                @if($article->featured_image && file_exists(public_path('storage/' . $article->featured_image)))
                    <div class="mb-8">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-auto rounded-lg shadow-md">
                    </div>
                @endif

                <div class="prose max-w-none">
                    {!! $article->content !!}
                </div>

                <!-- Share Buttons -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Bagikan Artikel:</h3>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            <i class="fab fa-facebook-f mr-2"></i> Facebook
                        </a>
                    
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-800 mb-8">Artikel Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $relatedArticle)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                            <div class="relative">
                                @if($relatedArticle->featured_image && file_exists(public_path('storage/' . $relatedArticle->featured_image)))
                                    <img src="{{ asset('storage/' . $relatedArticle->featured_image) }}" alt="{{ $relatedArticle->title }}" class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-0 right-0 bg-green-600 text-white px-2 py-1 text-xs">
                                    {{ $relatedArticle->published_at->format('d M Y') }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ Str::limit($relatedArticle->title, 50) }}</h3>
                                <a href="{{ url('article/' . $relatedArticle->slug) }}" class="text-green-600 hover:text-green-700 font-medium inline-flex items-center text-sm">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection 