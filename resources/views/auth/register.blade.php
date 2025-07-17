@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
    @if (session('success'))
        <script>
            window.onload = function() {
                // Create a link to trigger download
                const downloadLink = document.createElement('a');
                downloadLink.href = "{{ route('download.bukti') }}";
                downloadLink.download = "{{ session('pdf_filename') ?? 'bukti_pendaftaran.pdf' }}";
                downloadLink.style.display = 'none';
                document.body.appendChild(downloadLink);
                
                // Trigger download
                downloadLink.click();
                
                // Clean up
                document.body.removeChild(downloadLink);

                // Show success message after a short delay
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pendaftaran Berhasil!',
                        html: 'Bukti pendaftaran telah berhasil diunduh. Silakan masuk menggunakan akun yang Anda daftarkan.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = "{{ route('auth.login') }}";
                    });
                }, 1000); // delay 1 detik
            };
        </script>
    @endif
    <div class="min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-6xl w-full space-y-6">
            <div class="text-center">
                @php
                    $pengaturan = \App\Models\Pengaturan::first();
                    $jurusans = \App\Models\Jurusan::all();
                @endphp

                @if ($pengaturan && $pengaturan->logo_persegi)
                    <img class="mx-auto h-20 w-auto" src="{{ asset('storage/' . $pengaturan->logo_persegi) }}"
                        alt="{{ $pengaturan->nama_instansi ?? 'Logo' }}">
                @else
                    <img class="mx-auto h-20 w-auto" src="{{ asset('images/logo-default.png') }}" alt="Logo">
                @endif
                <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
                    Pendaftaran Siswa Baru
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Silakan lengkapi formulir di bawah ini untuk melanjutkan pendaftaran
                </p>
            </div>

            <div class="bg-white py-6 px-4 shadow sm:rounded-lg sm:px-8">
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="space-y-5" action="{{ route('auth.register.post') }}" method="POST">
                    @csrf

                    <div class="bg-blue-50 p-4 rounded-md mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-blue-800">
                                    Informasi Penting
                                </p>
                                <p class="text-sm text-blue-700 mt-1">
                                    Setelah mendaftar, Anda akan mendapatkan bukti pendaftaran dalam bentuk PDF. Simpan
                                    bukti pendaftaran tersebut karena berisi informasi penting untuk login dan proses
                                    selanjutnya.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    value="{{ old('email') }}"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">
                                NIK <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input id="nik" name="nik" type="text" required value="{{ old('nik') }}"
                                    placeholder="Masukkan 16 digit NIK"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Masukkan 16 digit NIK sesuai KTP</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700">
                                Nomor HP <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input id="no_hp" name="no_hp" type="text" required value="{{ old('no_hp') }}"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="asal_sekolah" class="block text-sm font-medium text-gray-700">
                                Asal Sekolah <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input id="asal_sekolah" name="asal_sekolah" type="text" required
                                    value="{{ old('asal_sekolah') }}"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="jurusan" class="block text-sm font-medium text-gray-700">
                                Jurusan Yang Dipilih <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <select id="jurusan" name="jurusan" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($jurusans as $jurusan)
                                        <option value="{{ $jurusan->id }}"
                                            {{ old('jurusan') == $jurusan->id ? 'selected' : '' }}>
                                            {{ $jurusan->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Pilih jurusan yang sesuai dengan minat dan bakat Anda</p>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative">
                                <input id="password" name="password" type="password" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePassword"
                                        class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Konfirmasi Password <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative">
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="toggleConfirmPassword"
                                        class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Dokumen yang perlu disiapkan:</h3>
                            <ul class="list-disc pl-5 text-sm text-gray-600">
                                <li>Ijazah terakhir</li>
                                <li>KTP/SIM/Paspor</li>
                                <li>Bukti pendaftaran (akan diunduh otomatis setelah pendaftaran)</li>
                                <li>Dokumen tambahan (opsional)</li>
                            </ul>
                        </div>

                        <div class="flex items-center justify-center">
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Daftar Sekarang
                            </button>
                        </div>
                    </div>
                </form>

                <div class="mt-4 text-center text-sm">
                    <p>Sudah punya akun? <a href="{{ route('auth.login') }}"
                            class="font-medium text-green-600 hover:text-green-500">Masuk</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const nikInput = document.getElementById('nik');

            // Password visibility toggle
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Change icon based on password visibility
                if (type === 'text') {
                    this.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>';
                } else {
                    this.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>';
                }
            });

            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);

                // Change icon based on password visibility
                if (type === 'text') {
                    this.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>';
                } else {
                    this.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>';
                }
            });

            // NIK validation
            if (nikInput) {
                nikInput.addEventListener('input', function() {
                    // Remove non-numeric characters
                    this.value = this.value.replace(/\D/g, '');
                    
                    // Limit to 16 digits
                    if (this.value.length > 16) {
                        this.value = this.value.substring(0, 16);
                    }
                });

                nikInput.addEventListener('blur', function() {
                    const nikValue = this.value;
                    const errorMessage = this.parentNode.parentNode.querySelector('.nik-error');
                    
                    // Remove existing error message
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                    
                    if (nikValue.length > 0 && nikValue.length !== 16) {
                        // Add error message
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'text-red-500 text-xs mt-1 nik-error';
                        errorDiv.textContent = 'NIK harus terdiri dari 16 digit angka';
                        this.parentNode.parentNode.appendChild(errorDiv);
                        this.classList.add('border-red-500');
                    } else {
                        this.classList.remove('border-red-500');
                    }
                });
            }
        });
    </script>
@endsection
