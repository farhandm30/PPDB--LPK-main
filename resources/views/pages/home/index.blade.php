@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<style>
    .banner-slider {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 500px; /* Fixed height for consistent display */
        border-radius: 0; /* Remove border radius for full-width appearance */
    }
    
    .banner-slide {
        width: 100%;
        height: 100%;
        position: relative;
    }
    
    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.3) 100%);
        z-index: 1;
    }
    
    .banner-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        background-position: center;
        z-index: 0;
        transition: transform 8s ease; /* Slow zoom effect */
    }
    
    .banner-slide.active .banner-bg {
        transform: scale(1.1);
    }
    
    .banner-content-wrapper {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
    }
    
    .banner-content {
        position: relative;
        z-index: 10;
        max-width: 600px; /* Limit width for better readability */
    }
    
    .banner-navigation {
        position: absolute;
        bottom: 30px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        z-index: 20;
    }
    
    .banner-navigation button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 5px;
        border: 2px solid white;
        transition: all 0.3s ease;
        box-shadow: 0 0 5px rgba(0,0,0,0.3);
        cursor: pointer;
    }
    
    .banner-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 20;
        transition: all 0.3s ease;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    .banner-arrow:hover {
        background-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-50%) scale(1.1);
    }
    
    .banner-arrow.left {
        left: 20px;
    }
    
    .banner-arrow.right {
        right: 20px;
    }
    
    /* Animation for text */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .banner-title {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .banner-description {
        animation: fadeInUp 0.8s ease-out 0.2s forwards;
        opacity: 0;
    }
    
    .banner-button {
        animation: fadeInUp 0.8s ease-out 0.4s forwards;
        opacity: 0;
    }
    
    /* Testimonial Styles */
    .testimonial-slider {
        position: relative;
        overflow: hidden;
    }
    
    .testimonial-track {
        display: flex;
        transition: transform 0.5s ease-out;
    }
    
    .testimonial-card {
        position: relative;
        flex: 0 0 100%;
        padding: 2rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-radius: 0.5rem;
        background-color: white;
        margin: 0 1rem;
        min-width: 300px;
        max-width: 400px;
        transition: all 0.3s ease;
    }
    
    @media (min-width: 768px) {
        .testimonial-card {
            flex: 0 0 calc(50% - 2rem);
        }
    }
    
    @media (min-width: 1024px) {
        .testimonial-card {
            flex: 0 0 calc(33.33% - 2rem);
        }
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
    }
    
    .testimonial-avatar {
        height: 80px;
        width: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    
    .testimonial-rating {
        color: #F59E0B;
    }
    
    .testimonial-quote-icon {
        position: absolute;
        opacity: 0.1;
        font-size: 120px;
        top: -30px;
        right: -15px;
        color: #10B981;
        z-index: 0;
    }
    
    .testimonial-nav-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background-color: rgba(16, 185, 129, 0.8);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 20;
        transition: all 0.3s ease;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        border: none;
    }
    
    .testimonial-nav-button:hover {
        background-color: rgba(16, 185, 129, 1);
        transform: translateY(-50%) scale(1.1);
    }
    
    .testimonial-nav-button.prev {
        left: 0;
    }
    
    .testimonial-nav-button.next {
        right: 0;
    }
    
    .testimonial-dots {
        display: flex;
        justify-content: center;
        margin-top: 1.5rem;
    }
    
    .testimonial-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 0 5px;
        background-color: #E5E7EB;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .testimonial-dot.active {
        background-color: #10B981;
        transform: scale(1.2);
    }
</style>
@endpush

@section('content')
    @php
        $pengaturan = \App\Models\Pengaturan::first();
        $tahunAjaranAktif = \App\Models\TahunAjaran::where('status_tahun_ajaran', 'Aktif')->first();
        $jurusanList = \App\Models\Jurusan::take(3)->get();
        $pendaftarCount = \App\Models\Pendaftaran::count();
        $diterimaPendaftarCount = \App\Models\Pendaftaran::where('status_pendaftaran', 'Diterima')->count();
        $jurusanCount = \App\Models\Jurusan::count();
        $banners = \App\Models\Banner::where('is_active', true)->orderBy('order')->get();
        $articles = \App\Models\Article::where('is_published', true)->orderBy('published_at', 'desc')->take(3)->get();
        $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->take(5)->get();
        $testimonials = $testimonials ?? \App\Models\Testimonial::getActiveTestimonials()->take(6);
    @endphp

    <!-- Banner Slider Section -->
    <section class="relative">
        <div class="banner-slider" x-data="{ 
                activeSlide: 0, 
                slides: {{ $banners->count() }},
                autoplay: null,
                init() {
                    if (this.slides > 0) {
                        this.autoplay = setInterval(() => {
                            this.activeSlide = this.activeSlide === this.slides - 1 ? 0 : this.activeSlide + 1;
                        }, 6000);
                    }
                },
                stopAutoplay() {
                    clearInterval(this.autoplay);
                },
                startAutoplay() {
                    this.autoplay = setInterval(() => {
                        this.activeSlide = this.activeSlide === this.slides - 1 ? 0 : this.activeSlide + 1;
                    }, 6000);
                }
            }" 
            x-init="init()"
            @mouseenter="stopAutoplay()"
            @mouseleave="startAutoplay()">
            
            <!-- Slides -->
            @forelse($banners as $index => $banner)
                <div x-show="activeSlide === {{ $index }}" 
                    x-transition:enter="transition ease-out duration-800"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    :class="{'active': activeSlide === {{ $index }}}"
                    class="banner-slide">
                    
                    @if(file_exists(public_path('storage/' . $banner->image)))
                        <div class="banner-bg" style="background-image: url('{{ asset('storage/' . $banner->image) }}')"></div>
                    @else
                        <div class="banner-bg bg-gradient-to-r from-green-700 to-green-500"></div>
                    @endif
                    <div class="banner-overlay"></div>
                    
                    <div class="banner-content-wrapper">
                        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="banner-content text-white">
                                <h1 class="banner-title text-3xl md:text-5xl font-bold mb-4 leading-tight">
                                    {{ $banner->title }}
                                </h1>
                                <p class="banner-description text-lg md:text-xl mb-8 text-gray-100">
                                    {{ $banner->description }}
                                </p>
                                @if($banner->button_text)
                                    <a href="{{ $banner->button_link }}" class="banner-button bg-white text-green-700 hover:bg-gray-100 px-6 py-3 rounded-md font-medium inline-block shadow-md transition duration-300 ease-in-out hover:shadow-lg hover:scale-105">
                                        {{ $banner->button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Default Banner if no banners are available -->
                <div class="banner-slide active">
                    <div class="banner-bg bg-gradient-to-r from-green-700 to-green-500"></div>
                    <div class="banner-overlay"></div>
                    
                    <div class="banner-content-wrapper">
                        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="banner-content text-white">
                                <h1 class="banner-title text-3xl md:text-5xl font-bold mb-4 leading-tight">
                                    Penerimaan Peserta Didik Baru {{ $tahunAjaranAktif ? $tahunAjaranAktif->nama_tahun_ajaran : '' }}
                                </h1>
                                <p class="banner-description text-lg md:text-xl mb-8 text-gray-100">
                                    {{ $pengaturan->nama_instansi ?? 'Sekolah' }} membuka pendaftaran peserta didik baru. Segera daftarkan diri Anda untuk mendapatkan pendidikan berkualitas.
                                </p>
                                @if($tahunAjaranAktif)
                                    <a href="{{ route('registration') }}" class="banner-button bg-white text-green-700 hover:bg-gray-100 px-6 py-3 rounded-md font-medium inline-block shadow-md transition duration-300 ease-in-out hover:shadow-lg hover:scale-105">
                                        Daftar Sekarang
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse

            <!-- Navigation Buttons -->
            @if($banners->count() > 1)
                <div class="banner-navigation">
                    @foreach($banners as $index => $banner)
                        <button @click="activeSlide = {{ $index }}" 
                            :class="{ 'bg-white': activeSlide === {{ $index }}, 'bg-transparent': activeSlide !== {{ $index }} }"
                            class="focus:outline-none"></button>
                    @endforeach
                </div>
                
                <!-- Previous/Next Buttons -->
                <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1" 
                    class="banner-arrow left">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1" 
                    class="banner-arrow right">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @endif
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Harus Bergabung dengan LPK Kami?</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Wujudkan impian kariermu bersama kami. Dapatkan keterampilan yang dibutuhkan dunia kerja dan raih masa depan yang gemilang.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-xl shadow-sm text-center border border-blue-200">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pelatihan Berkualitas</h3>
                    <p class="text-gray-600">Instruktur berpengalaman dengan kurikulum yang sesuai kebutuhan industri modern</p>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-emerald-100 p-8 rounded-xl shadow-sm text-center border border-green-200">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-briefcase text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Siap Kerja</h3>
                    <p class="text-gray-600">Program pelatihan yang dirancang khusus untuk mempersiapkan lulusan siap bekerja</p>
                </div>
                
                <div class="bg-gradient-to-br from-purple-50 to-violet-100 p-8 rounded-xl shadow-sm text-center border border-purple-200">
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-certificate text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Sertifikat Resmi</h3>
                    <p class="text-gray-600">Dapatkan sertifikat yang diakui industri untuk meningkatkan kredibilitas profesionalmu</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Jurusan Unggulan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan berbagai jurusan unggulan untuk mempersiapkan siswa menghadapi dunia kerja dan pendidikan tinggi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($jurusanList as $jurusan)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $jurusan->nama_jurusan }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($jurusan->deskripsi_jurusan, 100) }}</p>
                            <a href="{{ route('majors.show', $jurusan->kode_jurusan) }}" class="text-green-600 hover:text-green-700 font-medium inline-flex items-center">
                                Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-600">Belum ada data jurusan.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('majors') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-medium transition duration-300 shadow-md hover:shadow-lg">
                    Lihat Semua Jurusan
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-green-700 to-green-500 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap Untuk Mendaftar?</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto">
                Jangan lewatkan kesempatan untuk bergabung dengan {{ $pengaturan->nama_instansi ?? 'kami' }}. Pendaftaran dibuka untuk tahun ajaran {{ $tahunAjaranAktif ? $tahunAjaranAktif->nama_tahun_ajaran : 'baru' }}.
            </p>
            @if($tahunAjaranAktif)
                <a href="{{ route('registration') }}" class="bg-white text-green-700 hover:bg-gray-100 px-6 py-3 rounded-md font-medium inline-block shadow-md transition duration-300 ease-in-out hover:shadow-lg hover:scale-105">
                    Daftar Sekarang
                </a>
            @endif
        </div>
    </section>

    <!-- Artikel Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Berita & Artikel Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Ikuti informasi dan berita terbaru seputar kegiatan dan program di {{ $pengaturan->nama_instansi ?? 'sekolah kami' }}.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
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
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $article->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $article->excerpt }}</p>
                            <a href="/article/{{ $article->slug }}" class="text-green-600 hover:text-green-700 font-medium inline-flex items-center">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-600">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-8">
                <a href="/articles" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-medium transition duration-300 shadow-md hover:shadow-lg">
                    Lihat Semua Artikel
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Testimoni Siswa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Pendapat dan pengalaman dari siswa-siswi kami yang telah merasakan kualitas pendidikan di {{ $pengaturan->nama_instansi ?? 'sekolah kami' }}.
                </p>
            </div>

            <div class="testimonial-slider relative px-8"
                x-data="{
                    activeSlide: 0,
                    totalSlides: {{ $testimonials->count() }},
                    autoplayInterval: null,
                    slidesPerView: window.innerWidth < 768 ? 1 : (window.innerWidth < 1024 ? 2 : 3),
                    
                    init() {
                        this.totalSlides = {{ $testimonials->count() }};
                        this.startAutoplay();
                        
                        window.addEventListener('resize', () => {
                            this.slidesPerView = window.innerWidth < 768 ? 1 : (window.innerWidth < 1024 ? 2 : 3);
                        });
                    },
                    
                    startAutoplay() {
                        this.autoplayInterval = setInterval(() => {
                            this.next();
                        }, 5000);
                    },
                    
                    stopAutoplay() {
                        clearInterval(this.autoplayInterval);
                    },
                    
                    next() {
                        this.activeSlide = (this.activeSlide + 1) % Math.ceil(this.totalSlides / this.slidesPerView);
                    },
                    
                    prev() {
                        this.activeSlide = (this.activeSlide - 1 + Math.ceil(this.totalSlides / this.slidesPerView)) % Math.ceil(this.totalSlides / this.slidesPerView);
                    },
                    
                    goToSlide(index) {
                        this.activeSlide = index;
                    }
                }"
                @mouseenter="stopAutoplay"
                @mouseleave="startAutoplay">
                
                <div class="testimonial-track flex" 
                    :style="`transform: translateX(-${activeSlide * 100}%); transition: transform 0.5s ease;`">
                    
                    @foreach($testimonials as $testimonial)
                        <div class="testimonial-card">
                            <div class="testimonial-quote-icon">
                                <i class="fas fa-quote-right"></i>
                            </div>
                            <div class="flex flex-col items-center text-center mb-4 relative z-10">
                                @if($testimonial->photo && file_exists(public_path('storage/' . $testimonial->photo)))
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="testimonial-avatar mb-3">
                                @else
                                    <div class="testimonial-avatar mb-3 bg-green-100 flex items-center justify-center text-green-700">
                                        <span class="text-2xl font-bold">{{ substr($testimonial->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <h4 class="text-lg font-bold text-gray-800">{{ $testimonial->name }}</h4>
                                @if($testimonial->role)
                                    <p class="text-sm text-gray-500">{{ $testimonial->role }}</p>
                                @endif
                                <div class="testimonial-rating mt-2">
                                    @for($i = 0; $i < $testimonial->rating; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for($i = $testimonial->rating; $i < 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-600 italic relative z-10">"{{ $testimonial->content }}"</p>
                        </div>
                    @endforeach
                </div>
                
                <!-- Navigation buttons -->
                <button @click="prev()" class="testimonial-nav-button prev">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="next()" class="testimonial-nav-button next">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                
                <!-- Dots navigation -->
                <div class="testimonial-dots">
                    <template x-for="(_, index) in Array.from({ length: Math.ceil(totalSlides / slidesPerView) })" :key="index">
                        <button @click="goToSlide(index)" 
                            :class="{'active': activeSlide === index}"
                            class="testimonial-dot">
                        </button>
                    </template>
                </div>
            </div>
            
            @if($testimonials->isEmpty())
                <div class="text-center py-8">
                    <p class="text-gray-600">Belum ada testimoni yang tersedia.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Pertanyaan Umum</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Berikut adalah jawaban untuk pertanyaan yang sering diajukan tentang proses pendaftaran dan program kami.
                </p>
            </div>

            <div class="max-w-3xl mx-auto">
                @forelse($faqs as $index => $faq)
                    <div class="mb-4" x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }">
                        <button 
                            @click="open = !open" 
                            class="flex justify-between items-center w-full bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition duration-200 focus:outline-none"
                        >
                            <span class="text-left font-medium text-gray-800">{{ $faq->question }}</span>
                            <svg 
                                :class="{'rotate-180': open}" 
                                class="w-5 h-5 text-green-600 transform transition-transform duration-200" 
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24" 
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div 
                            x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="bg-white p-4 rounded-b-lg shadow-sm border-t border-gray-100"
                        >
                            <p class="text-gray-700">{!! $faq->answer !!}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-gray-600">Belum ada FAQ yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-8">
                <a href="/faqs" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-medium transition duration-300 shadow-md hover:shadow-lg">
                    Lihat Semua FAQ
                </a>
            </div>
        </div>
    </section>
@endsection 