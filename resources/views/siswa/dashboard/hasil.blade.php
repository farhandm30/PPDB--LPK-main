@extends('layouts.siswa')

@section('title', 'Hasil Pendaftaran')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold">Hasil Pendaftaran</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hasil Pendaftaran</li>
            </ol>
        </nav>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Status Pendaftaran</h5>
                    @if($pendaftaran)
                        <span class="badge 
                            {{ $pendaftaran->status_pendaftaran == 'Diterima' ? 'bg-success' : 
                              ($pendaftaran->status_pendaftaran == 'Ditolak' ? 'bg-danger' : 
                              ($pendaftaran->status_pendaftaran == 'Dicadangkan' ? 'bg-info' : 'bg-warning')) }}">
                            {{ $pendaftaran->status_pendaftaran }}
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
                                                <span class="text-muted">Tanggal Daftar</span>
                                                <span class="fw-medium">{{ $pendaftaran->created_at->format('d-m-Y') }}</span>
                                            </li>
                                            <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                <span class="text-muted">Status</span>
                                                <span>
                                                    @if($pendaftaran->status_pendaftaran == 'Diterima')
                                                        <span class="badge bg-success">Diterima</span>
                                                    @elseif($pendaftaran->status_pendaftaran == 'Dicadangkan')
                                                        <span class="badge bg-info">Dicadangkan</span>
                                                    @elseif($pendaftaran->status_pendaftaran == 'Ditolak')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
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
                                        @if($pendaftaran->status_pendaftaran == 'Diterima')
                                            <div class="alert alert-success mb-0">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <i class="fas fa-check-circle fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="alert-heading">Selamat! Pendaftaran Anda Diterima</h5>
                                                        <p class="mb-0">Silahkan cetak bukti pendaftaran dan surat pernyataan. Jangan lupa untuk mengupload surat pernyataan yang telah ditandatangani.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($pendaftaran->status_pendaftaran == 'Dicadangkan')
                                            <div class="alert alert-info mb-0">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <i class="fas fa-info-circle fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="alert-heading">Pendaftaran Dicadangkan</h5>
                                                        <p class="mb-0">Anda masuk dalam daftar cadangan. Silahkan tunggu informasi lebih lanjut dari panitia.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($pendaftaran->status_pendaftaran == 'Ditolak')
                                            <div class="alert alert-danger mb-0">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <i class="fas fa-times-circle fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="alert-heading">Mohon Maaf</h5>
                                                        <p class="mb-0">Pendaftaran Anda tidak dapat diterima. Silahkan hubungi panitia untuk informasi lebih lanjut.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning mb-0">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <i class="fas fa-clock fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="alert-heading">Menunggu Verifikasi</h5>
                                                        <p class="mb-0">Pendaftaran Anda sedang dalam proses verifikasi. Silahkan periksa status pendaftaran secara berkala.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">Detail Status Pendaftaran</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-circle {{ $pendaftaran->status_data_diri == 'Lengkap' ? 'bg-success' : 'bg-warning' }} text-white me-3">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <h6 class="card-title mb-0">Status Data Diri</h6>
                                                </div>
                                                @if($pendaftaran->status_data_diri == 'Lengkap')
                                                    <div class="alert alert-success mb-0">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-check-circle me-2"></i>
                                                            <span>Data diri telah lengkap</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="alert alert-warning mb-0">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-exclamation-circle me-2"></i>
                                                            <span>Data diri belum lengkap</span>
                                                        </div>
                                                        <a href="{{ route('siswa.data-diri') }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-pencil-alt me-1"></i> Lengkapi Data
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-circle {{ $pendaftaran->status_data_orangtua == 'Lengkap' ? 'bg-success' : 'bg-warning' }} text-white me-3">
                                                        <i class="fas fa-users"></i>
                                                    </div>
                                                    <h6 class="card-title mb-0">Status Data Orangtua</h6>
                                                </div>
                                                @if($pendaftaran->status_data_orangtua == 'Lengkap')
                                                    <div class="alert alert-success mb-0">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-check-circle me-2"></i>
                                                            <span>Data orangtua telah lengkap</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="alert alert-warning mb-0">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-exclamation-circle me-2"></i>
                                                            <span>Data orangtua belum lengkap</span>
                                                        </div>
                                                        <a href="{{ route('siswa.data-orangtua') }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-pencil-alt me-1"></i> Lengkapi Data
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-circle {{ $pendaftaran->status_berkas == 'Lengkap' ? 'bg-success' : 'bg-warning' }} text-white me-3">
                                                        <i class="fas fa-file-alt"></i>
                                                    </div>
                                                    <h6 class="card-title mb-0">Status Berkas</h6>
                                                </div>
                                                @if($pendaftaran->status_berkas == 'Lengkap')
                                                    <div class="alert alert-success mb-0">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-check-circle me-2"></i>
                                                            <span>Berkas telah lengkap</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="alert alert-warning mb-0">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-exclamation-circle me-2"></i>
                                                            <span>Berkas belum lengkap</span>
                                                        </div>
                                                        <a href="{{ route('siswa.berkas') }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-upload me-1"></i> Upload Berkas
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="icon-circle 
                                                        {{ $pendaftaran->status_pendaftaran == 'Diterima' ? 'bg-success' : 
                                                          ($pendaftaran->status_pendaftaran == 'Ditolak' ? 'bg-danger' : 
                                                          ($pendaftaran->status_pendaftaran == 'Dicadangkan' ? 'bg-info' : 'bg-warning')) }} text-white me-3">
                                                        <i class="fas fa-clipboard-check"></i>
                                                    </div>
                                                    <h6 class="card-title mb-0">Status Verifikasi</h6>
                                                </div>
                                                @if($pendaftaran->status_pendaftaran == 'Diterima')
                                                    <div class="alert alert-success mb-0">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-check-circle me-2"></i>
                                                            <span>Pendaftaran Anda telah diterima</span>
                                                        </div>
                                                        <a href="{{ route('siswa.download-surat-pernyataan') }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-print me-1"></i> Cetak Surat Pernyataan
                                                        </a>
                                                    </div>
                                                @elseif($pendaftaran->status_pendaftaran == 'Dicadangkan')
                                                    <div class="alert alert-info mb-0">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-info-circle me-2"></i>
                                                            <span>Pendaftaran Anda masuk daftar cadangan</span>
                                                        </div>
                                                    </div>
                                                @elseif($pendaftaran->status_pendaftaran == 'Ditolak')
                                                    <div class="alert alert-danger mb-0">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-times-circle me-2"></i>
                                                            <span>Maaf, pendaftaran Anda ditolak</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="alert alert-warning mb-0">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-clock me-2"></i>
                                                            <span>Pendaftaran Anda sedang dalam proses verifikasi</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($pendaftaran->status_pendaftaran == 'Diterima')
                                    <div class="card mt-4 border-0 shadow-sm">
                                        <div class="card-header bg-white">
                                            <h5 class="card-title mb-0"><i class="fas fa-file-signature me-2"></i> Surat Pernyataan</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-success">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <i class="fas fa-check-circle fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="alert-heading">Selamat!</h5>
                                                        <p>Pendaftaran Anda telah diterima. Silahkan cetak dan tandatangani surat pernyataan, kemudian upload kembali.</p>
                                                        <hr>   
                                                        <p class="mb-0">Informasi jadwal daftar ulang akan dikirimkan melalui WhatsApp. Pastikan nomor WhatsApp Anda aktif.</p>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card mt-3 border-0 bg-light">
                                                <div class="card-body">
                                                    <h6 class="mb-3"><i class="fas fa-upload me-2"></i> Upload Surat Pernyataan</h6>
                                                    
                                                    @if($pendaftaran->surat_pernyataan)
                                                        <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm mb-3">
                                                            <i class="fas fa-check-circle text-success me-3 fa-2x"></i>
                                                            <div>
                                                                <h6 class="mb-1">Surat pernyataan sudah diupload</h6>
                                                                <p class="mb-0 small">
                                                                    <a href="{{ route('siswa.view-berkas', 'surat_pernyataan') }}" target="_blank" class="text-decoration-none">
                                                                        <i class="fas fa-external-link-alt me-1"></i> Lihat Surat Pernyataan
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    <form action="{{ route('siswa.upload-surat-pernyataan') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="surat_pernyataan" class="form-label">Upload Surat Pernyataan yang Sudah Ditandatangani</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                                                <input type="file" class="form-control @error('surat_pernyataan') is-invalid @enderror" id="surat_pernyataan" name="surat_pernyataan" accept=".pdf" required>
                                                            </div>
                                                            <div class="form-text text-muted mt-2">
                                                                <i class="fas fa-info-circle me-1"></i> Format: PDF saja. Ukuran maksimal: 2MB. Berkas wajib diisi untuk menyelesaikan pendaftaran.
                                                            </div>
                                                            @error('surat_pernyataan')
                                                                <div class="text-danger small mt-1">{{ $errors->first('surat_pernyataan') }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-upload me-2"></i> Upload Surat Pernyataan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($pendaftaran->status_pendaftaran == 'Dicadangkan')
                                    <div class="alert alert-info mt-4">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <i class="fas fa-info-circle fa-2x"></i>
                                            </div>
                                            <div>
                                                <h5 class="alert-heading">Informasi</h5>
                                                <p class="mb-0">Pendaftaran Anda masuk ke dalam daftar cadangan. Silahkan tunggu informasi lebih lanjut dari panitia.</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($pendaftaran->status_pendaftaran == 'Ditolak')
                                    <div class="alert alert-danger mt-4">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <i class="fas fa-times-circle fa-2x"></i>
                                            </div>
                                            <div>
                                                <h5 class="alert-heading">Mohon Maaf</h5>
                                                <p class="mb-0">Pendaftaran Anda tidak dapat diterima. Silahkan hubungi panitia untuk informasi lebih lanjut.</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-info mt-4">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <i class="fas fa-info-circle fa-2x"></i>
                                            </div>
                                            <div>
                                                <h5 class="alert-heading">Informasi</h5>
                                                <p class="mb-0">Pastikan semua data dan berkas Anda sudah lengkap untuk mempercepat proses verifikasi.</p>
                                                <div class="progress mt-3" style="height: 10px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 
                                                        {{ (
                                                            ($pendaftaran->status_data_diri == 'Lengkap' ? 1 : 0) + 
                                                            ($pendaftaran->status_data_orangtua == 'Lengkap' ? 1 : 0) + 
                                                            ($pendaftaran->status_berkas == 'Lengkap' ? 1 : 0)
                                                        ) * 33.33 }}%;" 
                                                        aria-valuenow="{{ (
                                                            ($pendaftaran->status_data_diri == 'Lengkap' ? 1 : 0) + 
                                                            ($pendaftaran->status_data_orangtua == 'Lengkap' ? 1 : 0) + 
                                                            ($pendaftaran->status_berkas == 'Lengkap' ? 1 : 0)
                                                        ) * 33.33 }}" 
                                                        aria-valuemin="0" 
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between mt-1">
                                                    <small>0%</small>
                                                    <small>Kelengkapan Data</small>
                                                    <small>100%</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
    
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    .progress {
        border-radius: 20px;
        background-color: #f5f5f5;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    .progress-bar {
        border-radius: 20px;
        transition: width 1s ease;
    }
</style>
@endpush
@endsection 