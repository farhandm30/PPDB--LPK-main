@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    @php
        $pengaturan = \App\Models\Pengaturan::first();
    @endphp

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-700 to-green-500 text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-center">Profil {{ $pengaturan->nama_instansi ?? 'Sekolah' }}</h1>
            <p class="text-lg max-w-3xl mx-auto text-center">
                {{ $pengaturan->nama_instansi ?? 'Sekolah' }} berkomitmen untuk memberikan pendidikan berkualitas dan membentuk generasi penerus bangsa yang berprestasi.
            </p>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Tentang Kami</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($pengaturan->tentang_kami ?? 'Informasi tentang kami belum tersedia.')) !!}
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg p-6">
                    @if($pengaturan && $pengaturan->logo_persegi)
                        <img src="{{ asset('storage/' . $pengaturan->logo_persegi) }}" alt="{{ $pengaturan->nama_instansi ?? 'Logo' }}" class="mx-auto h-48 w-auto">
                    @else
                        <img src="{{ asset('images/logo-default.png') }}" alt="Logo" class="mx-auto h-48 w-auto">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sejarah</h2>
            <div class="prose max-w-3xl mx-auto">
                {!! nl2br(e($pengaturan->sejarah ?? 'Informasi sejarah belum tersedia.')) !!}
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-green-50 p-6 rounded-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Visi</h2>
                    <div class="prose">
                        {!! nl2br(e($pengaturan->visi ?? 'Informasi visi belum tersedia.')) !!}
                    </div>
                </div>
                <div class="bg-green-50 p-6 rounded-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Misi</h2>
                    <div class="prose">
                        {!! nl2br(e($pengaturan->misi ?? 'Informasi misi belum tersedia.')) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-green-700 to-green-500 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Bergabunglah Bersama Kami</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto">
                Jadilah bagian dari {{ $pengaturan->nama_instansi ?? 'kami' }} dan raih masa depan cerah bersama kami.
            </p>
            <a href="{{ route('registration') }}" class="bg-white text-green-700 hover:bg-gray-100 px-6 py-3 rounded-md font-medium inline-block">
                Daftar Sekarang
            </a>
        </div>
    </section>
@endsection 