@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    @php
        $pengaturan = \App\Models\Pengaturan::first();
    @endphp

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-700 to-green-500 text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-center">Hubungi Kami</h1>
            <p class="text-lg max-w-3xl mx-auto text-center">
                Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut, silakan hubungi kami melalui formulir di bawah ini.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('name') border-red-500 @enderror" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('email') border-red-500 @enderror" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subjek</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('subject') border-red-500 @enderror" required>
                            @error('subject')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Pesan</label>
                            <textarea name="message" id="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('message') border-red-500 @enderror" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-medium">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kontak</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                                <i class="fas fa-map-marker-alt text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-800">Alamat</h3>
                                <p class="text-gray-600 mt-1">{{ $pengaturan->alamat_instansi ?? 'Alamat belum diatur' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                                <i class="fas fa-phone text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-800">Telepon</h3>
                                <p class="text-gray-600 mt-1">{{ $pengaturan->notlp_instansi ?? 'Telepon belum diatur' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                                <i class="fas fa-envelope text-green-600"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-800">Email</h3>
                                <p class="text-gray-600 mt-1">{{ $pengaturan->email_instansi ?? 'Email belum diatur' }}</p>
                            </div>
                        </div>
                        
                        <!-- Social Media -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Media Sosial</h3>
                            <div class="flex space-x-4">
                                @if($pengaturan && $pengaturan->fb_instansi)
                                    <a href="{{ $pengaturan->fb_instansi }}" target="_blank" class="bg-green-100 p-3 rounded-full text-green-600 hover:bg-green-200">
                                        <i class="fab fa-facebook fa-lg"></i>
                                    </a>
                                @endif
                                @if($pengaturan && $pengaturan->instagram_instansi)
                                    <a href="{{ $pengaturan->instagram_instansi }}" target="_blank" class="bg-green-100 p-3 rounded-full text-green-600 hover:bg-green-200">
                                        <i class="fab fa-instagram fa-lg"></i>
                                    </a>
                                @endif
                                @if($pengaturan && $pengaturan->x_instansi)
                                    <a href="{{ $pengaturan->x_instansi }}" target="_blank" class="bg-green-100 p-3 rounded-full text-green-600 hover:bg-green-200">
                                        <i class="fab fa-x-twitter fa-lg"></i>
                                    </a>
                                @endif
                                @if($pengaturan && $pengaturan->youtube_instansi)
                                    <a href="{{ $pengaturan->youtube_instansi }}" target="_blank" class="bg-green-100 p-3 rounded-full text-green-600 hover:bg-green-200">
                                        <i class="fab fa-youtube fa-lg"></i>
                                    </a>
                                @endif
                                @if($pengaturan && $pengaturan->tiktok_instansi)
                                    <a href="{{ $pengaturan->tiktok_instansi }}" target="_blank" class="bg-green-100 p-3 rounded-full text-green-600 hover:bg-green-200">
                                        <i class="fab fa-tiktok fa-lg"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Lokasi Kami</h2>
            <div class="w-full h-96 rounded-lg overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0537222574256!2d106.8269113!3d-6.2575709!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3bcbe5a9abd%3A0x3c2a69d84a4a3ad2!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1652345678901!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection 