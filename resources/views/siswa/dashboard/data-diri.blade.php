@extends('layouts.siswa')

@section('title', 'Data Diri')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold">Data Diri</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Diri</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Informasi Pendaftaran</h5>
                        @if ($pendaftaran)
                            <span
                                class="badge {{ $pendaftaran->status_data_diri == 'Lengkap' ? 'bg-success' : 'bg-warning' }}">
                                {{ $pendaftaran->status_data_diri }}
                            </span>
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($pendaftaran)
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar-circle bg-primary text-white me-3">
                                                    <i class="fas fa-id-card"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $pendaftaran->no_daftar }}</h6>
                                                    <small class="text-muted">Nomor Pendaftaran</small>
                                                </div>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                    <span class="text-muted">Nama Lengkap</span>
                                                    <span class="fw-medium">{{ $pendaftaran->nama_siswa }}</span>
                                                </li>
                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                    <span class="text-muted">Email</span>
                                                    <span class="fw-medium">{{ $user->email }}</span>
                                                </li>
                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                    <span class="text-muted">NIK</span>
                                                    <span
                                                        class="fw-medium">{{ $pendaftaran->nik_siswa ?? 'Belum diisi' }}</span>
                                                </li>
                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                    <span class="text-muted">Tanggal Daftar</span>
                                                    <span
                                                        class="fw-medium">{{ $pendaftaran->created_at->format('d-m-Y') }}</span>
                                                </li>
                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                    <span class="text-muted">Jurusan Pilihan</span>
                                                    <span
                                                        class="fw-medium">{{ $pendaftaran->jurusan->nama_jurusan ?? 'Belum dipilih' }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div
                                                class="alert {{ $pendaftaran->status_data_diri == 'Lengkap' ? 'alert-success' : 'alert-info' }} mb-0">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <i
                                                            class="fas {{ $pendaftaran->status_data_diri == 'Lengkap' ? 'fa-check-circle' : 'fa-info-circle' }} fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="alert-heading">
                                                            {{ $pendaftaran->status_data_diri == 'Lengkap' ? 'Data Diri Sudah Lengkap' : 'Lengkapi Data Diri Anda' }}
                                                        </h5>
                                                        <p class="mb-0">
                                                            {{ $pendaftaran->status_data_diri == 'Lengkap'
                                                                ? 'Anda dapat melanjutkan ke tahap berikutnya untuk melengkapi data orangtua/wali.'
                                                                : 'Silahkan lengkapi data diri Anda dengan informasi yang valid untuk melanjutkan proses pendaftaran.' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white">
                                    <h5 class="card-title mb-0">Form Data Diri</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('siswa.update-data-diri') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nama_siswa" class="form-label">Nama Lengkap <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                        <input type="text"
                                                            class="form-control @error('nama_siswa') is-invalid @enderror"
                                                            id="nama_siswa" name="nama_siswa"
                                                            value="{{ old('nama_siswa', $pendaftaran->nama_siswa ?? '') }}"
                                                            placeholder="Masukkan Nama Lengkap">
                                                    </div>
                                                    @error('nama_siswa')
                                                        <div class="text-danger small mt-1">{{ $errors->first('nama_siswa') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nik_siswa" class="form-label">NIK <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                        <input type="text"
                                                            class="form-control @error('nik_siswa') is-invalid @enderror"
                                                            id="nik_siswa" name="nik_siswa"
                                                            value="{{ old('nik_siswa', $pendaftaran->nik_siswa ?? '') }}"
                                                            placeholder="Masukkan NIK">
                                                    </div>
                                                    @error('nik_siswa')
                                                        <div class="text-danger small mt-1">{{ $errors->first('nik_siswa') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="tempat_lahir_siswa" class="form-label">Tempat Lahir <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-map-marker-alt"></i></span>
                                                        <input type="text"
                                                            class="form-control @error('tempat_lahir_siswa') is-invalid @enderror"
                                                            id="tempat_lahir_siswa" name="tempat_lahir_siswa"
                                                            value="{{ old('tempat_lahir_siswa', $pendaftaran->tempat_lahir_siswa ?? '') }}"
                                                            placeholder="Masukkan tempat lahir">
                                                    </div>
                                                    @error('tempat_lahir_siswa')
                                                        <div class="text-danger small mt-1">
                                                            {{ $errors->first('tempat_lahir_siswa') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="tgl_lahir_siswa" class="form-label">Tanggal Lahir <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-calendar-alt"></i></span>
                                                        <input type="date"
                                                            class="form-control @error('tgl_lahir_siswa') is-invalid @enderror"
                                                            id="tgl_lahir_siswa" name="tgl_lahir_siswa"
                                                            value="{{ old('tgl_lahir_siswa', $pendaftaran->tgl_lahir_siswa ? $pendaftaran->tgl_lahir_siswa->format('Y-m-d') : '') }}">
                                                    </div>
                                                    @error('tgl_lahir_siswa')
                                                        <div class="text-danger small mt-1">
                                                            {{ $errors->first('tgl_lahir_siswa') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-venus-mars"></i></span>
                                                        <select
                                                            class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                            id="jenis_kelamin" name="jenis_kelamin">
                                                            <option value="">Pilih Jenis Kelamin</option>
                                                            <option value="Laki-laki"
                                                                {{ old('jenis_kelamin', $pendaftaran->jk_siswa ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                                                                Laki-laki</option>
                                                            <option value="Perempuan"
                                                                {{ old('jenis_kelamin', $pendaftaran->jk_siswa ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                                                Perempuan</option>
                                                        </select>
                                                    </div>
                                                    @error('jenis_kelamin')
                                                        <div class="text-danger small mt-1">
                                                            {{ $errors->first('jenis_kelamin') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="agama_siswa" class="form-label">Agama <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-pray"></i></span>
                                                        <select
                                                            class="form-select @error('agama_siswa') is-invalid @enderror"
                                                            id="agama_siswa" name="agama_siswa">
                                                            <option value="">Pilih Agama</option>
                                                            <option value="Islam"
                                                                {{ old('agama_siswa', $pendaftaran->agama_siswa ?? '') == 'Islam' ? 'selected' : '' }}>
                                                                Islam</option>
                                                            <option value="Kristen"
                                                                {{ old('agama_siswa', $pendaftaran->agama_siswa ?? '') == 'Kristen' ? 'selected' : '' }}>
                                                                Kristen</option>
                                                            <option value="Katolik"
                                                                {{ old('agama_siswa', $pendaftaran->agama_siswa ?? '') == 'Katolik' ? 'selected' : '' }}>
                                                                Katolik</option>
                                                            <option value="Hindu"
                                                                {{ old('agama_siswa', $pendaftaran->agama_siswa ?? '') == 'Hindu' ? 'selected' : '' }}>
                                                                Hindu</option>
                                                            <option value="Buddha"
                                                                {{ old('agama_siswa', $pendaftaran->agama_siswa ?? '') == 'Buddha' ? 'selected' : '' }}>
                                                                Buddha</option>
                                                            <option value="Konghucu"
                                                                {{ old('agama_siswa', $pendaftaran->agama_siswa ?? '') == 'Konghucu' ? 'selected' : '' }}>
                                                                Konghucu</option>
                                                        </select>
                                                    </div>
                                                    @error('agama_siswa')
                                                        <div class="text-danger small mt-1">
                                                            {{ $errors->first('agama_siswa') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="alamat_siswa" class="form-label">Alamat <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                <textarea class="form-control @error('alamat_siswa') is-invalid @enderror" id="alamat_siswa" name="alamat_siswa"
                                                    rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat_siswa', $pendaftaran->alamat_siswa ?? '') }}</textarea>
                                            </div>
                                            @error('alamat_siswa')
                                                <div class="text-danger small mt-1">{{ $errors->first('alamat_siswa') }}</div>
                                            @enderror
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nohp_siswa" class="form-label">Nomor HP <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                        <input type="text"
                                                            class="form-control @error('nohp_siswa') is-invalid @enderror"
                                                            id="nohp_siswa" name="nohp_siswa"
                                                            value="{{ old('nohp_siswa', $pendaftaran->nohp_siswa ?? '') }}"
                                                            placeholder="Contoh: 08123456789">
                                                    </div>
                                                    @error('nohp_siswa')
                                                        <div class="text-danger small mt-1">{{ $errors->first('nohp_siswa') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="asal_sekolah" class="form-label">Asal Sekolah <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-school"></i></span>
                                                        <input type="text"
                                                            class="form-control @error('asal_sekolah') is-invalid @enderror"
                                                            id="asal_sekolah" name="asal_sekolah"
                                                            value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah ?? '') }}"
                                                            placeholder="Masukkan asal sekolah">
                                                    </div>
                                                    @error('asal_sekolah')
                                                        <div class="text-danger small mt-1">
                                                            {{ $errors->first('asal_sekolah') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="foto_siswa" class="form-label">Foto (3x4) <span
                                                    class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    @if ($pendaftaran && $pendaftaran->foto_siswa && $pendaftaran->foto_siswa !== 'default.jpg')
                                                        <img src="{{ asset('storage/' . $pendaftaran->foto_siswa) }}"
                                                            class="img-thumbnail" alt="Foto Siswa">
                                                    @else
                                                        <div class="border rounded p-3 text-center bg-light">
                                                            <i class="fas fa-user fa-3x text-muted"></i>
                                                            <p class="mt-2 mb-0 small">Belum ada foto</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                        <input type="file"
                                                            class="form-control @error('foto_siswa') is-invalid @enderror"
                                                            id="foto_siswa" name="foto_siswa" accept=".jpg,.jpeg,.png">
                                                    </div>
                                                    <div class="form-text text-muted mt-2">
                                                        <i class="fas fa-info-circle me-1"></i> Format: JPG, PNG. Ukuran
                                                        maksimal: 2MB. Disarankan ukuran 3x4.
                                                    </div>
                                                    @error('foto_siswa')
                                                        <div class="text-danger small mt-1">{{ $errors->first('foto_siswa') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-4">
                                            <span class="text-muted small"><span class="text-danger">*</span> Wajib
                                                diisi</span>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i> Simpan Data
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="alert-heading">Data Tidak Ditemukan</h5>
                                        <p class="mb-0">Data pendaftaran tidak ditemukan. Silahkan hubungi admin untuk
                                            informasi lebih lanjut.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .avatar-circle {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
            }

            .form-control:focus,
            .form-select:focus {
                box-shadow: 0 0 0 0.25rem rgba(26, 188, 156, 0.25);
            }

            .input-group-text {
                background-color: #f8f9fa;
                border-right: 0;
            }

            .input-group .form-control {
                border-left: 0;
            }

            .input-group .form-control:focus {
                border-color: #ced4da;
                box-shadow: none;
            }
        </style>
    @endpush
@endsection
