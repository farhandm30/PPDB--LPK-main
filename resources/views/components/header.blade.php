@php
    $pengaturan = \App\Models\Pengaturan::first();
    $tahunAjaranAktif = \App\Models\TahunAjaran::where('status_tahun_ajaran', 'Aktif')->first();
@endphp

<header class="bg-white shadow-md">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    @if($pengaturan && $pengaturan->logo_persegi)
                        <img src="{{ asset('storage/' . $pengaturan->logo_persegi) }}" alt="{{ $pengaturan->nama_instansi ?? 'Logo' }}" class="h-24 w-auto">
                    @else
                        <img src="{{ asset('images/logo-default.png') }}" alt="Logo" class="h-24 w-auto">
                    @endif
                    {{-- <span class="ml-3 text-xl font-bold text-gray-800">{{ $pengaturan->nama_aplikasi ?? 'PPDB Online' }}</span> --}}
                </a>
            </div>

            <!-- Navigation - Desktop -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium {{ request()->routeIs('home') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                    Beranda
                </a>
                
                <a href="{{ route('profile') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium {{ request()->routeIs('profile') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                    Profil
                </a>
                
                <a href="{{ route('majors') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium {{ request()->routeIs('majors*') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                    Jurusan
                </a>
                
                <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium {{ request()->routeIs('gallery') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                    Galeri
                </a>
                
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium {{ request()->routeIs('contact') ? 'text-green-600 border-b-2 border-green-600' : '' }}">
                    Kontak
                </a>
                @if($tahunAjaranAktif)
                    <a href="{{ route('registration') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-medium">
                        Daftar Sekarang
                    </a>
                @endif
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('siswa.dashboard') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium">
                            Dashboard Siswa
                        </a>
                    @endif
                @else
                    <a href="{{ route('auth.login') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 font-medium">
                            Masuk
                    </a>
                @endauth
            </nav>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-green-600 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-green-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="hidden mobile-menu md:hidden border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('home') ? 'text-green-600 bg-gray-50' : '' }}">
                Beranda
            </a>
            
            <a href="{{ route('profile') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('profile') ? 'text-green-600 bg-gray-50' : '' }}">
                Profil
            </a>
            
            <a href="{{ route('majors') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('majors*') ? 'text-green-600 bg-gray-50' : '' }}">
                Jurusan
            </a>
            
            <a href="{{ route('gallery') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('gallery') ? 'text-green-600 bg-gray-50' : '' }}">
                Galeri
            </a>
            
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 {{ request()->routeIs('contact') ? 'text-green-600 bg-gray-50' : '' }}">
                Kontak
            </a>
            @if($tahunAjaranAktif)
                <a href="{{ route('registration') }}" class="block px-3 py-2 rounded-md text-base font-medium bg-green-600 text-white hover:bg-green-700">
                    Daftar Sekarang
                </a>
            @endif
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('siswa.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50">
                        Dashboard Siswa
                    </a>
                @endif
            @else
                <a href="{{ route('auth.login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50">
                    Masuk
                        </a>
            @endauth
        </div>
    </div>
</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>
@endpush 