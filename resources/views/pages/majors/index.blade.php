@extends('layouts.app')

@section('title', 'Jurusan')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-700 to-green-500 text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-center">Program Jurusan</h1>
            <p class="text-lg max-w-3xl mx-auto text-center">
                Kami menyediakan berbagai jurusan unggulan untuk mempersiapkan siswa menghadapi dunia kerja dan pendidikan tinggi.
            </p>
        </div>
    </section>

    <!-- Jurusan List Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($jurusans as $jurusan)
                    <div class="bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $jurusan->nama_jurusan }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($jurusan->deskripsi_jurusan, 150) }}</p>
                            <a href="{{ route('majors.show', $jurusan->kode_jurusan) }}" class="text-green-600 hover:text-green-700 font-medium">
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
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-green-700 to-green-500 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Tertarik Dengan Jurusan Kami?</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto">
                Daftarkan diri Anda sekarang dan pilih jurusan yang sesuai dengan minat dan bakat Anda.
            </p>
            <a href="{{ route('registration') }}" class="bg-white text-green-700 hover:bg-gray-100 px-6 py-3 rounded-md font-medium inline-block">
                Daftar Sekarang
            </a>
        </div>
    </section>
@endsection 