@php
    $pengaturan = \App\Models\Pengaturan::first();
@endphp

<footer class="bg-white border-t border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo dan Deskripsi -->
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center mb-4">
                    @if($pengaturan && $pengaturan->logo_persegi)
                        <img src="{{ asset('storage/' . $pengaturan->logo_persegi) }}" alt="{{ $pengaturan->nama_instansi ?? 'Logo' }}" class="h-24 w-auto">
                    @else
                        <img src="{{ asset('images/logo-default.png') }}" alt="Logo" class="h-24 w-auto">
                    @endif
                    {{-- <span class="ml-3 text-lg font-bold text-gray-800">{{ $pengaturan->nama_aplikasi ?? 'PPDB Online' }}</span> --}}
                </div>
                <p class="text-gray-600 text-sm mb-4">
                    {{ $pengaturan->nama_instansi ?? 'Sekolah' }}
                </p>
                <p class="text-gray-600 text-sm">
                    {{ Str::limit($pengaturan->tentang_kami ?? 'Sistem Penerimaan Peserta Didik Baru Online', 150) }}
                </p>
            </div>

            <!-- Link Cepat -->
            <div class="col-span-1">
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">
                    Link Cepat
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600 text-sm">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile') }}" class="text-gray-600 hover:text-green-600 text-sm">
                            Profil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('majors') }}" class="text-gray-600 hover:text-green-600 text-sm">
                            Jurusan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery') }}" class="text-gray-600 hover:text-green-600 text-sm">
                            Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-600 hover:text-green-600 text-sm">
                            Kontak
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('registration') }}" class="text-gray-600 hover:text-green-600 text-sm">
                            Pendaftaran
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-span-1">
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">
                    Kontak Kami
                </h3>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-green-600 mt-1 mr-2"></i>
                        <span class="text-gray-600 text-sm">{{ $pengaturan->alamat_instansi ?? 'Alamat belum diatur' }}</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone text-green-600 mr-2"></i>
                        <span class="text-gray-600 text-sm">{{ $pengaturan->notlp_instansi ?? 'Telepon belum diatur' }}</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-green-600 mr-2"></i>
                        <span class="text-gray-600 text-sm">{{ $pengaturan->email_instansi ?? 'Email belum diatur' }}</span>
                    </li>
                </ul>
            </div>

            <!-- Media Sosial -->
            <div class="col-span-1">
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">
                    Media Sosial
                </h3>
                <div class="flex space-x-4">
                    @if($pengaturan && $pengaturan->fb_instansi)
                        <a href="{{ $pengaturan->fb_instansi }}" target="_blank" class="text-gray-600 hover:text-green-600">
                            <i class="fab fa-facebook fa-lg"></i>
                        </a>
                    @endif
                    @if($pengaturan && $pengaturan->instagram_instansi)
                        <a href="{{ $pengaturan->instagram_instansi }}" target="_blank" class="text-gray-600 hover:text-green-600">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                    @endif
                    @if($pengaturan && $pengaturan->youtube_instansi)
                    <a href="{{ $pengaturan->youtube_instansi }}" target="_blank" class="text-gray-600 hover:text-green-600">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                    @endif
                    @if($pengaturan && $pengaturan->tiktok_instansi)
                    <a href="{{ $pengaturan->tiktok_instansi }}" target="_blank" class="text-gray-600 hover:text-green-600">
                        <i class="fab fa-tiktok fa-lg"></i>
                    </a>
                    @endif
                    @if($pengaturan && $pengaturan->x_instansi)
                        <a href="{{ $pengaturan->x_instansi }}" target="_blank" class="text-gray-600 hover:text-green-600">
                            <i class="fab fa-x-twitter fa-lg"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="bg-green-700 py-4">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-center items-center">
                <p class="text-white text-sm">
                    &copy; {{ date('Y') }} {{ $pengaturan->nama_instansi ?? 'PPDB Online' }}. Hak Cipta Dilindungi.
                </p>
                {{-- <p class="text-white text-sm mt-2 md:mt-0">
                    Dikembangkan oleh <a href="https://boasfardev.com/" class="text-white hover:underline">Boasfardev</a>
                </p> --}}
            </div>
        </div>
    </div>
</footer> 