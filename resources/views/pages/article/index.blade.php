@extends('layouts.app')

@section('title', 'Berita & Artikel')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-700 to-green-500 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Berita & Artikel</h1>
                <p class="text-lg max-w-2xl mx-auto">
                    Informasi terbaru seputar kegiatan dan program di sekolah kami.
                </p>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 h-full flex flex-col">
                        <div class="relative">
                            @if($article->featured_image && file_exists(public_path('storage/' . $article->featured_image)))
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-0 right-0 bg-green-600 text-white px-3 py-1 text-sm">
                                {{ $article->published_at ? $article->published_at->format('d M Y') : now()->format('d M Y') }}
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $article->title }}</h3>
                            <p class="text-gray-600 mb-4 flex-1">{{ $article->excerpt }}</p>
                            <div>
                                <a href="{{ url('article/' . $article->slug) }}" class="text-green-600 hover:text-green-700 font-medium inline-flex items-center">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-600">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
@endsection 