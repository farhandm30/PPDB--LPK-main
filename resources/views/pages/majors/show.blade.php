@extends('layouts.app')

@section('title', $jurusan->nama_jurusan)

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-700 to-green-500 text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-center">{{ $jurusan->nama_jurusan }}</h1>
            {{-- <p class="text-lg max-w-3xl mx-auto text-center">
                Kode Jurusan: {{ $jurusan->kode_jurusan }}
            </p> --}}
        </div>
    </section>

    <!-- Detail Jurusan Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-50 rounded-lg shadow-sm p-6 md:p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Deskripsi Jurusan</h2>
                <div class="prose max-w-none">
                    {!! nl2br(e($jurusan->deskripsi_jurusan)) !!}
                </div>
            </div>
        </div>
    </section>

    {{-- <!-- Mata Pelajaran Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Mata Pelajaran Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-green-600 text-2xl mb-4">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Mata Pelajaran 1</h3>
                    <p class="text-gray-600">
                        Deskripsi singkat tentang mata pelajaran ini dan manfaatnya bagi siswa.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-green-600 text-2xl mb-4">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Mata Pelajaran 2</h3>
                    <p class="text-gray-600">
                        Deskripsi singkat tentang mata pelajaran ini dan manfaatnya bagi siswa.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-green-600 text-2xl mb-4">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Mata Pelajaran 3</h3>
                    <p class="text-gray-600">
                        Deskripsi singkat tentang mata pelajaran ini dan manfaatnya bagi siswa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Prospek Karir Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Prospek Karir</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Dunia Kerja</h3>
                    <ul class="list-disc pl-5 space-y-2 text-gray-600">
                        <li>Prospek karir 1</li>
                        <li>Prospek karir 2</li>
                        <li>Prospek karir 3</li>
                        <li>Prospek karir 4</li>
                        <li>Prospek karir 5</li>
                    </ul>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Pendidikan Lanjutan</h3>
                    <ul class="list-disc pl-5 space-y-2 text-gray-600">
                        <li>Program studi lanjutan 1</li>
                        <li>Program studi lanjutan 2</li>
                        <li>Program studi lanjutan 3</li>
                        <li>Program studi lanjutan 4</li>
                        <li>Program studi lanjutan 5</li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-green-700 to-green-500 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Tertarik Dengan Jurusan {{ $jurusan->nama_jurusan }}?</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto">
                Daftarkan diri Anda sekarang dan mulai perjalanan menuju masa depan yang cerah.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('registration') }}" class="bg-white text-green-700 hover:bg-gray-100 px-6 py-3 rounded-md font-medium inline-block">
                    Daftar Sekarang
                </a>
                <a href="{{ route('majors') }}" class="bg-transparent border border-white text-white hover:bg-white hover:bg-opacity-10 px-6 py-3 rounded-md font-medium inline-block">
                    Lihat Jurusan Lainnya
                </a>
            </div>
        </div>
    </section>
@endsection 