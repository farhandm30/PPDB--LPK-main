@extends('layouts.app')

@section('title', 'Galeri')

@push('styles')
<style>
    .gallery-filter {
        background: white;
        border-radius: 50px;
        padding: 8px 24px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #6b7280;
        font-weight: 500;
        display: inline-block;
        margin: 4px;
    }
    
    .gallery-filter:hover {
        border-color: #10b981;
        color: #10b981;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        text-decoration: none;
    }
    
    .gallery-filter.active {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-color: #10b981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }
    
    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: end;
        padding: 20px;
    }
    
    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }
    
    .gallery-content {
        color: white;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover .gallery-content {
        transform: translateY(0);
    }
    
    .gallery-category-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .category-kegiatan {
        background: rgba(16, 185, 129, 0.9);
        color: white;
    }
    
    .category-prestasi {
        background: rgba(245, 158, 11, 0.9);
        color: white;
    }
    
    .category-fasilitas {
        background: rgba(59, 130, 246, 0.9);
        color: white;
    }
    
    .category-umum {
        background: rgba(107, 114, 128, 0.9);
        color: white;
    }
    
    /* Lightbox styles */
    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .lightbox-content {
        max-width: 90vw;
        max-height: 90vh;
        position: relative;
    }
    
    .lightbox img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }
    
    .lightbox-close {
        position: absolute;
        top: -40px;
        right: 0;
        color: white;
        font-size: 30px;
        cursor: pointer;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transition: background 0.3s ease;
    }
    
    .lightbox-close:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    .lightbox-info {
        position: absolute;
        bottom: -60px;
        left: 0;
        right: 0;
        color: white;
        text-align: center;
    }
    
    .lightbox-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 4px;
    }
    
    .lightbox-description {
        font-size: 14px;
        opacity: 0.8;
    }
    
    /* Loading animation */
    .gallery-loading {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
    }
    
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #e5e7eb;
        border-top: 4px solid #10b981;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Mobile responsive */
    @media (max-width: 768px) {
        .gallery-item img {
            height: 200px;
        }
        
        .gallery-filter {
            padding: 6px 16px;
            font-size: 14px;
            margin: 2px;
        }
        
        .lightbox-content {
            max-width: 95vw;
            max-height: 85vh;
        }
        
        .lightbox-close {
            top: -30px;
            font-size: 24px;
            width: 30px;
            height: 30px;
        }
        
        .lightbox-info {
            bottom: -50px;
        }
        
        .lightbox-title {
            font-size: 16px;
        }
        
        .lightbox-description {
            font-size: 12px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Header Section -->
    <section class="bg-gradient-to-r from-green-700 to-green-500 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Galeri</h1>
                <p class="text-lg md:text-xl text-green-100 max-w-2xl mx-auto">
                    Kumpulan foto kegiatan, prestasi, dan fasilitas di LPK kami
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Filter -->
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Filter Kategori</h2>
                <div class="flex flex-wrap justify-center">
                    <a href="{{ route('gallery') }}" 
                        class="gallery-filter {{ $selectedCategory === 'all' ? 'active' : '' }}">
                        Semua
                    </a>
                    @foreach($categories as $key => $label)
                        <a href="{{ route('gallery', ['category' => $key]) }}" 
                            class="gallery-filter {{ $selectedCategory === $key ? 'active' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($galleries as $gallery)
                    <div class="gallery-item" 
                        data-title="{{ $gallery->title }}"
                        data-description="{{ $gallery->description }}"
                        data-image="{{ $gallery->image_url }}"
                        onclick="openLightbox(this)">
                        
                        <img src="{{ $gallery->image_url }}" 
                            alt="{{ $gallery->title }}"
                            loading="lazy">
                        
                        <div class="gallery-category-badge category-{{ $gallery->category }}">
                            {{ $gallery->category_label }}
                        </div>
                        
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h3 class="font-bold text-lg mb-2">{{ $gallery->title }}</h3>
                                @if($gallery->description)
                                    <p class="text-sm opacity-90">{{ Str::limit($gallery->description, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-images text-6xl"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-600 mb-2">Belum Ada Galeri</h3>
                        <p class="text-gray-500">
                            @if($selectedCategory !== 'all')
                                Tidak ada galeri untuk kategori "{{ $categories[$selectedCategory] ?? $selectedCategory }}".
                            @else
                                Galeri sedang dalam proses penambahan konten.
                            @endif
                        </p>
                        @if($selectedCategory !== 'all')
                            <a href="{{ route('gallery') }}" class="inline-block mt-4 text-green-600 hover:text-green-700 font-medium">
                                Lihat Semua Galeri
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($galleries->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $galleries->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <div class="lightbox-close" onclick="closeLightbox()">
                <i class="fas fa-times"></i>
            </div>
            <img id="lightbox-image" src="" alt="">
            <div class="lightbox-info">
                <div class="lightbox-title" id="lightbox-title"></div>
                <div class="lightbox-description" id="lightbox-description"></div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function openLightbox(element) {
        const title = element.dataset.title;
        const description = element.dataset.description;
        const image = element.dataset.image;
        
        document.getElementById('lightbox-image').src = image;
        document.getElementById('lightbox-title').textContent = title;
        document.getElementById('lightbox-description').textContent = description || '';
        
        const lightbox = document.getElementById('lightbox');
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // Add fade in animation
        setTimeout(() => {
            lightbox.style.opacity = '1';
        }, 10);
    }
    
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.style.opacity = '0';
        
        setTimeout(() => {
            lightbox.style.display = 'none';
            document.body.style.overflow = 'auto';
        }, 300);
    }
    
    // Close lightbox with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLightbox();
        }
    });
    
    // Lazy loading for better performance
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('img[loading="lazy"]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            images.forEach(img => imageObserver.observe(img));
        }
    });
</script>
@endpush 