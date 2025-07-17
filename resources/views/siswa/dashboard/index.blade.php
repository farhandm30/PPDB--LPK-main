@extends('layouts.siswa')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold">Dashboard Siswa</h2>
            <div>
                <span
                    class="badge bg-primary">{{ $pendaftaran ? $pendaftaran->tahunAjaran->nama_tahun_ajaran ?? 'Tahun Ajaran' : 'Tahun Ajaran' }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Status Pendaftaran</h5>
                        <span
                            class="badge {{ $pendaftaran && $pendaftaran->status_pendaftaran == 'Diterima' ? 'bg-success' : ($pendaftaran && $pendaftaran->status_pendaftaran == 'Ditolak' ? 'bg-danger' : 'bg-warning') }}">
                            {{ $pendaftaran ? $pendaftaran->status_pendaftaran : 'Belum Terdaftar' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="progress-track">
                            <div class="row mb-4">
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="progress-icon {{ $pendaftaran ? 'bg-success' : 'bg-secondary' }} me-3">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Pendaftaran</h6>
                                            <small class="text-muted">{{ $pendaftaran ? 'Selesai' : 'Belum' }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="progress-icon {{ $pendaftaran && $pendaftaran->status_data_diri == 'Lengkap' ? 'bg-success' : 'bg-secondary' }} me-3">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Data Diri</h6>
                                            <small
                                                class="text-muted">{{ $pendaftaran ? $pendaftaran->status_data_diri : 'Belum' }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="progress-icon {{ $pendaftaran && $pendaftaran->status_data_orangtua == 'Lengkap' ? 'bg-success' : 'bg-secondary' }} me-3">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Data Orangtua</h6>
                                            <small
                                                class="text-muted">{{ $pendaftaran ? $pendaftaran->status_data_orangtua : 'Belum' }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="progress-icon {{ $pendaftaran && $pendaftaran->status_berkas == 'Lengkap' ? 'bg-success' : 'bg-secondary' }} me-3">
                                            <i class="fas fa-file-upload"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Berkas</h6>
                                            <small
                                                class="text-muted">{{ $pendaftaran ? $pendaftaran->status_berkas : 'Belum' }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="alert {{ $pendaftaran && $pendaftaran->status_pendaftaran == 'Diterima' ? 'alert-success' : ($pendaftaran && $pendaftaran->status_pendaftaran == 'Ditolak' ? 'alert-danger' : 'alert-info') }} mb-0">
                                <div class="d-flex">
                                    <div class="me-3">
                                        @if ($pendaftaran && $pendaftaran->status_pendaftaran == 'Diterima')
                                            <i class="fas fa-check-circle fa-2x"></i>
                                        @elseif($pendaftaran && $pendaftaran->status_pendaftaran == 'Ditolak')
                                            <i class="fas fa-times-circle fa-2x"></i>
                                        @else
                                            <i class="fas fa-info-circle fa-2x"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="alert-heading">
                                            @if ($pendaftaran && $pendaftaran->status_pendaftaran == 'Diterima')
                                                Selamat! Pendaftaran Anda telah diterima.
                                            @elseif($pendaftaran && $pendaftaran->status_pendaftaran == 'Ditolak')
                                                Mohon maaf, pendaftaran Anda tidak dapat diterima.
                                            @elseif($pendaftaran && $pendaftaran->status_data_diri != 'Lengkap')
                                                Pendaftaran telah berhasil. Silahkan lengkapi data diri Anda.
                                            @elseif($pendaftaran && $pendaftaran->status_data_orangtua != 'Lengkap')
                                                Data diri telah lengkap. Silahkan lengkapi data orangtua/wali.
                                            @elseif($pendaftaran && $pendaftaran->status_berkas != 'Lengkap')
                                                Data orangtua telah lengkap. Silahkan upload berkas persyaratan.
                                            @elseif($pendaftaran && $pendaftaran->status_pendaftaran == 'Menunggu Verifikasi')
                                                Terimakasih telah melengkapi semua data. Pendaftaran Anda sedang dalam
                                                proses verifikasi.
                                            @else
                                                Silahkan lengkapi semua tahapan pendaftaran.
                                            @endif
                                        </h5>
                                        <p class="mb-0">
                                            @if ($pendaftaran && $pendaftaran->status_pendaftaran == 'Diterima')
                                                Silahkan cetak bukti pendaftaran dan ikuti petunjuk selanjutnya.
                                            @elseif($pendaftaran && $pendaftaran->status_pendaftaran == 'Ditolak')
                                                Silahkan hubungi panitia untuk informasi lebih lanjut.
                                            @elseif($pendaftaran && $pendaftaran->status_data_diri != 'Lengkap')
                                                Klik tombol di bawah untuk melengkapi data diri Anda.
                                            @elseif($pendaftaran && $pendaftaran->status_data_orangtua != 'Lengkap')
                                                Klik tombol di bawah untuk melengkapi data orangtua/wali.
                                            @elseif($pendaftaran && $pendaftaran->status_berkas != 'Lengkap')
                                                Klik tombol di bawah untuk upload berkas persyaratan.
                                            @elseif($pendaftaran && $pendaftaran->status_pendaftaran == 'Menunggu Verifikasi')
                                                Silahkan periksa status pendaftaran Anda secara berkala.
                                            @else
                                                Ikuti langkah-langkah pendaftaran dengan teliti.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-end">
                            @if ($pendaftaran && $pendaftaran->status_data_diri != 'Lengkap')
                                <a href="{{ route('siswa.data-diri') }}" class="btn btn-primary">
                                    <i class="fas fa-user me-2"></i> Lengkapi Data Diri
                                </a>
                            @elseif($pendaftaran && $pendaftaran->status_data_orangtua != 'Lengkap')
                                <a href="{{ route('siswa.data-orangtua') }}" class="btn btn-primary">
                                    <i class="fas fa-users me-2"></i> Lengkapi Data Orangtua
                                </a>
                            @elseif($pendaftaran && $pendaftaran->status_berkas != 'Lengkap')
                                <a href="{{ route('siswa.berkas') }}" class="btn btn-primary">
                                    <i class="fas fa-file-upload me-2"></i> Upload Berkas
                                </a>
                            @elseif($pendaftaran && $pendaftaran->status_pendaftaran == 'Menunggu Verifikasi')
                                <a href="{{ route('siswa.hasil') }}" class="btn btn-info">
                                    <i class="fas fa-search me-2"></i> Lihat Status
                                </a>
                            @elseif($pendaftaran && $pendaftaran->status_pendaftaran == 'Diterima')
                                <a href="{{ route('siswa.hasil') }}" class="btn btn-success">
                                    <i class="fas fa-print me-2"></i> Lihat Hasil Pendaftaran
                                </a>
                            @elseif($pendaftaran && $pendaftaran->status_pendaftaran == 'Ditolak')
                                <a href="{{ route('siswa.hasil') }}" class="btn btn-danger">
                                    <i class="fas fa-info-circle me-2"></i> Lihat Detail
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Pendaftaran</h5>
                    </div>
                    <div class="card-body">
                        @if ($pendaftaran)
                            <div class="mb-3 text-center">
                                <div class="d-inline-block p-3 rounded-circle bg-light mb-3">
                                    <i class="fas fa-id-card fa-3x text-primary"></i>
                                </div>
                                <h5 class="fw-bold">{{ $pendaftaran->no_daftar }}</h5>
                                <p class="text-muted mb-0">Nomor Pendaftaran</p>
                            </div>
                            <hr>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                    <span class="text-muted">Nama Lengkap</span>
                                    <span class="fw-medium">{{ Auth::user()->name }}</span>
                                </li>
                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                    <span class="text-muted">Tanggal Daftar</span>
                                    <span class="fw-medium">{{ $pendaftaran->created_at->format('d-m-Y') }}</span>
                                </li>
                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                    <span class="text-muted">Jurusan</span>
                                    <span
                                        class="fw-medium">{{ $pendaftaran->jurusan->nama_jurusan ?? 'Belum dipilih' }}</span>
                                </li>
                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                    <span class="text-muted">Status</span>
                                    <span>
                                        @if ($pendaftaran->status_pendaftaran == 'Diterima')
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
                        @else
                            <div class="alert alert-warning mb-0">
                                <i class="fas fa-exclamation-triangle me-2"></i> Data pendaftaran tidak ditemukan.
                            </div>
                        @endif
                    </div>
                    @if ($pendaftaran)
                        <div class="card-footer bg-white">
                            <div class="d-grid">
                                <a href="{{ route('siswa.download-bukti-pendaftaran') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-download me-2"></i> Download Bukti Pendaftaran
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Bantuan</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="fas fa-question-circle fa-2x text-info"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Butuh bantuan?</h6>
                                <p class="mb-0 text-muted small">Hubungi kami jika ada pertanyaan</p>
                            </div>
                        </div>
                        <div class="list-group list-group-flush mb-0">
                            <a href="mailto:{{ $pengaturan->email_instansi ?? 'info@ppdb.com' }}"
                                class="list-group-item list-group-item-action px-0">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                {{ $pengaturan->email_instansi ?? 'info@ppdb.com' }}
                            </a>
                            <a href="tel:{{ $pengaturan->notlp_instansi ?? '0812345678' }}"
                                class="list-group-item list-group-item-action px-0">
                                <i class="fas fa-phone me-2 text-primary"></i>
                                {{ $pengaturan->notlp_instansi ?? '0812345678' }}
                            </a>
                            <a href="{{ $pengaturan->alamat_instansi ?? '#' }}"
                                class="list-group-item list-group-item-action px-0" target="_blank">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                {{ $pengaturan->alamat_instansi ?? 'Alamat' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .progress-track {
                position: relative;
            }

            .progress-icon {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
            }

            .progress-icon i {
                font-size: 1.2rem;
            }

            .bg-secondary {
                background-color: #95a5a6 !important;
            }
        </style>
    @endpush
@endsection
