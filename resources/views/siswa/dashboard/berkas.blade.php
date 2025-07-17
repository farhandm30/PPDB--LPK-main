@extends('layouts.siswa')

@section('title', 'Upload Berkas')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold">Upload Berkas Persyaratan</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upload Berkas</li>
            </ol>
        </nav>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Informasi Pendaftaran</h5>
                    @if($pendaftaran)
                        <span class="badge {{ $pendaftaran->status_berkas == 'Lengkap' ? 'bg-success' : 'bg-warning' }}">
                            {{ $pendaftaran->status_berkas }}
                        </span>
                    @endif
                </div>
                <div class="card-body">
                    @if($pendaftaran)
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
                                                <span class="fw-medium">{{ $user->name }}</span>
                                            </li>
                                            <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                <span class="text-muted">Status</span>
                                                <span>
                                                    @if($pendaftaran->status_berkas == 'Lengkap')
                                                        <span class="badge bg-success">Lengkap</span>
                                                    @else
                                                        <span class="badge bg-warning">Belum Lengkap</span>
                                                    @endif
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="alert {{ $pendaftaran->status_berkas == 'Lengkap' ? 'alert-success' : 'alert-info' }} mb-0">
                                            <div class="d-flex">
                                                <div class="me-3">
                                                    <i class="fas {{ $pendaftaran->status_berkas == 'Lengkap' ? 'fa-check-circle' : 'fa-info-circle' }} fa-2x"></i>
                                                </div>
                                                <div>
                                                    <h5 class="alert-heading">
                                                        {{ $pendaftaran->status_berkas == 'Lengkap' ? 'Berkas Sudah Lengkap' : 'Lengkapi Berkas Persyaratan' }}
                                                    </h5>
                                                    <p class="mb-0">
                                                        {{ $pendaftaran->status_berkas == 'Lengkap' ? 
                                                            'Semua berkas persyaratan telah diupload. Silahkan tunggu verifikasi dari admin.' : 
                                                            'Silahkan upload semua berkas persyaratan yang dibutuhkan untuk melanjutkan proses pendaftaran.' 
                                                        }}
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
                                <h5 class="card-title mb-0">Form Upload Berkas</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-info-circle fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5 class="alert-heading">Informasi Upload</h5>
                                            <p class="mb-0">Silahkan upload berkas persyaratan dalam format PDF. Ukuran maksimal tiap berkas adalah 2MB.</p>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('siswa.upload-berkas') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="card mb-4 border-0 bg-light">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i> Dokumen Utama</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-12 col-lg-6">
                                                    <div class="card h-100 border-0 shadow-sm">
                                                        <div class="card-header bg-white">
                                                            <h6 class="card-title mb-0">Ijazah Terakhir</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($pendaftaran->ijazah_terakhir)
                                                                <div class="mb-3">
                                                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                                                        <i class="fas fa-check-circle text-success me-2 fa-2x"></i>
                                                                        <div>
                                                                            <p class="mb-0 fw-medium">Berkas sudah diupload</p>
                                                                            <a href="{{ route('siswa.view-berkas', 'ijazah_terakhir') }}" target="_blank" class="text-decoration-none">
                                                                                <i class="fas fa-external-link-alt me-1"></i> Lihat Berkas
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="mb-3">
                                                                <label for="ijazah_terakhir" class="form-label">Upload Ijazah Terakhir <span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                                                                    <input type="file" class="form-control @error('ijazah_terakhir') is-invalid @enderror" id="ijazah_terakhir" name="ijazah_terakhir" accept=".pdf">
                                                                </div>
                                                                <div class="form-text text-muted mt-1">
                                                                    <i class="fas fa-info-circle me-1"></i> Format: PDF saja. Ukuran maksimal: 2MB
                                                                </div>
                                                                @error('ijazah_terakhir')
                                                                    <div class="text-danger small mt-1">{{ $errors->first('ijazah_terakhir') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="card h-100 border-0 shadow-sm">
                                                        <div class="card-header bg-white">
                                                            <h6 class="card-title mb-0">KTP/SIM/Paspor</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($pendaftaran->ktp_sim_paspor)
                                                                <div class="mb-3">
                                                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                                                        <i class="fas fa-check-circle text-success me-2 fa-2x"></i>
                                                                        <div>
                                                                            <p class="mb-0 fw-medium">Berkas sudah diupload</p>
                                                                            <a href="{{ route('siswa.view-berkas', 'ktp_sim_paspor') }}" target="_blank" class="text-decoration-none">
                                                                                <i class="fas fa-external-link-alt me-1"></i> Lihat Berkas
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="mb-3">
                                                                <label for="ktp_sim_paspor" class="form-label">Upload KTP/SIM/Paspor <span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                                    <input type="file" class="form-control @error('ktp_sim_paspor') is-invalid @enderror" id="ktp_sim_paspor" name="ktp_sim_paspor" accept=".pdf">
                                                                </div>
                                                                <div class="form-text text-muted mt-1">
                                                                    <i class="fas fa-info-circle me-1"></i> Format: PDF saja. Ukuran maksimal: 2MB
                                                                </div>
                                                                @error('ktp_sim_paspor')
                                                                    <div class="text-danger small mt-1">{{ $errors->first('ktp_sim_paspor') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-4 border-0 bg-light">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="card-title mb-0"><i class="fas fa-file-signature me-2"></i> Dokumen Pendaftaran</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-12 col-lg-6">
                                                    <div class="card h-100 border-0 shadow-sm">
                                                        <div class="card-header bg-white">
                                                            <h6 class="card-title mb-0">Bukti Pendaftaran</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($pendaftaran->bukti_pendaftaran)
                                                                <div class="mb-3">
                                                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                                                        <i class="fas fa-check-circle text-success me-2 fa-2x"></i>
                                                                        <div>
                                                                            <p class="mb-0 fw-medium">Berkas sudah diupload</p>
                                                                            <a href="{{ route('siswa.view-berkas', 'bukti_pendaftaran') }}" target="_blank" class="text-decoration-none">
                                                                                <i class="fas fa-external-link-alt me-1"></i> Lihat Berkas
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="mb-3">
                                                                <a href="{{ route('siswa.download-bukti-pendaftaran') }}" class="btn btn-primary w-100">
                                                                    <i class="fas fa-download me-2"></i> Download Bukti Pendaftaran
                                                                </a>
                                                                <small class="d-block mt-2 text-muted">
                                                                    <i class="fas fa-info-circle me-1"></i> Bukti pendaftaran akan otomatis tersimpan di sistem
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="card h-100 border-0 shadow-sm">
                                                        <div class="card-header bg-white">
                                                            <h6 class="card-title mb-0">Surat Pernyataan</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($pendaftaran->surat_pernyataan)
                                                                <div class="mb-3">
                                                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                                                        <i class="fas fa-check-circle text-success me-2 fa-2x"></i>
                                                                        <div>
                                                                            <p class="mb-0 fw-medium">Berkas sudah diupload</p>
                                                                            <a href="{{ route('siswa.view-berkas', 'surat_pernyataan') }}" target="_blank" class="text-decoration-none">
                                                                                <i class="fas fa-external-link-alt me-1"></i> Lihat Berkas
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="mb-3">
                                                                @if($pendaftaran->status_pendaftaran == 'Diterima')
                                                                    <a href="{{ route('siswa.download-surat-pernyataan') }}" class="btn btn-primary w-100">
                                                                        <i class="fas fa-download me-2"></i> Download Surat Pernyataan
                                                                    </a>
                                                                    <small class="d-block mt-2 text-muted">
                                                                        <i class="fas fa-info-circle me-1"></i> Surat pernyataan akan otomatis tersimpan di sistem
                                                                    </small>
                                                                @else
                                                                    <div class="alert alert-warning mb-0">
                                                                        <i class="fas fa-exclamation-triangle me-2"></i> Surat pernyataan hanya tersedia untuk pendaftaran yang sudah diterima.
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-4 border-0 bg-light">
                                        <div class="card-header bg-secondary text-white">
                                            <h5 class="card-title mb-0"><i class="fas fa-file-medical me-2"></i> Dokumen Lainnya (Opsional)</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card mb-3 border-0 shadow-sm">
                                                        <div class="card-header bg-white">
                                                            <h6 class="card-title mb-0">Berkas Lainnya 1</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($pendaftaran->berkas_lain_1)
                                                                <div class="mb-3">
                                                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                                                        <i class="fas fa-check-circle text-success me-2 fa-2x"></i>
                                                                            <div>
                                                                                <p class="mb-0 fw-medium">Berkas sudah diupload</p>
                                                                                <a href="{{ route('siswa.view-berkas', 'berkas_lain_1') }}" target="_blank" class="text-decoration-none">
                                                                                    <i class="fas fa-external-link-alt me-1"></i> Lihat Berkas
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="mb-3">
                                                                <label for="berkas_lain_1" class="form-label">Upload Berkas Lainnya 1</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                                    <input type="file" class="form-control @error('berkas_lain_1') is-invalid @enderror" id="berkas_lain_1" name="berkas_lain_1" accept=".pdf">
                                                                </div>
                                                                <div class="form-text text-muted mt-1">
                                                                    <i class="fas fa-info-circle me-1"></i> Format: PDF saja. Ukuran maksimal: 2MB
                                                                </div>
                                                                @error('berkas_lain_1')
                                                                    <div class="text-danger small mt-1">{{ $errors->first('berkas_lain_1') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card mb-3 border-0 shadow-sm">
                                                        <div class="card-header bg-white">
                                                            <h6 class="card-title mb-0">Berkas Lainnya 2</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($pendaftaran->berkas_lain_2)
                                                                <div class="mb-3">
                                                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                                                        <i class="fas fa-check-circle text-success me-2 fa-2x"></i>
                                                                            <div>
                                                                                <p class="mb-0 fw-medium">Berkas sudah diupload</p>
                                                                                <a href="{{ route('siswa.view-berkas', 'berkas_lain_2') }}" target="_blank" class="text-decoration-none">
                                                                                    <i class="fas fa-external-link-alt me-1"></i> Lihat Berkas
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="mb-3">
                                                                <label for="berkas_lain_2" class="form-label">Upload Berkas Lainnya 2</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                                    <input type="file" class="form-control @error('berkas_lain_2') is-invalid @enderror" id="berkas_lain_2" name="berkas_lain_2" accept=".pdf">
                                                                </div>
                                                                <div class="form-text text-muted mt-1">
                                                                    <i class="fas fa-info-circle me-1"></i> Format: PDF saja. Ukuran maksimal: 2MB
                                                                </div>
                                                                @error('berkas_lain_2')
                                                                    <div class="text-danger small mt-1">{{ $errors->first('berkas_lain_2') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card mb-3 border-0 shadow-sm">
                                                        <div class="card-header bg-white">
                                                            <h6 class="card-title mb-0">Berkas Lainnya 3</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($pendaftaran->berkas_lain_3)
                                                                <div class="mb-3">
                                                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                                                        <i class="fas fa-check-circle text-success me-2 fa-2x"></i>
                                                                            <div>
                                                                                <p class="mb-0 fw-medium">Berkas sudah diupload</p>
                                                                                <a href="{{ route('siswa.view-berkas', 'berkas_lain_3') }}" target="_blank" class="text-decoration-none">
                                                                                    <i class="fas fa-external-link-alt me-1"></i> Lihat Berkas
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="mb-3">
                                                                <label for="berkas_lain_3" class="form-label">Upload Berkas Lainnya 3</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                                    <input type="file" class="form-control @error('berkas_lain_3') is-invalid @enderror" id="berkas_lain_3" name="berkas_lain_3" accept=".pdf">
                                                                </div>
                                                                <div class="form-text text-muted mt-1">
                                                                    <i class="fas fa-info-circle me-1"></i> Format: PDF saja. Ukuran maksimal: 2MB
                                                                </div>
                                                                @error('berkas_lain_3')
                                                                    <div class="text-danger small mt-1">{{ $errors->first('berkas_lain_3') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card mb-3 border-0 shadow-sm">
                                                        <div class="card-header bg-white">
                                                            <h6 class="card-title mb-0">Berkas Lainnya 4</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($pendaftaran->berkas_lain_4)
                                                                <div class="mb-3">
                                                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                                                        <i class="fas fa-check-circle text-success me-2 fa-2x"></i>
                                                                            <div>
                                                                                <p class="mb-0 fw-medium">Berkas sudah diupload</p>
                                                                                <a href="{{ route('siswa.view-berkas', 'berkas_lain_4') }}" target="_blank" class="text-decoration-none">
                                                                                    <i class="fas fa-external-link-alt me-1"></i> Lihat Berkas
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="mb-3">
                                                                <label for="berkas_lain_4" class="form-label">Upload Berkas Lainnya 4</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                                    <input type="file" class="form-control @error('berkas_lain_4') is-invalid @enderror" id="berkas_lain_4" name="berkas_lain_4" accept=".pdf">
                                                                </div>
                                                                <div class="form-text text-muted mt-1">
                                                                    <i class="fas fa-info-circle me-1"></i> Format: PDF saja. Ukuran maksimal: 2MB
                                                                </div>
                                                                @error('berkas_lain_4')
                                                                    <div class="text-danger small mt-1">{{ $errors->first('berkas_lain_4') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <span class="text-muted small"><span class="text-danger">*</span> Wajib diisi</span>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i> Simpan Berkas
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
                                    <p class="mb-0">Data pendaftaran tidak ditemukan. Silahkan hubungi admin untuk informasi lebih lanjut.</p>
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
    
    .form-control:focus, .form-select:focus {
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