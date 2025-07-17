@extends('layouts.siswa')

@section('title', 'Data Orangtua/Wali')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold">Data Orangtua/Wali</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Orangtua/Wali</li>
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
                                class="badge {{ $pendaftaran->status_data_orangtua == 'Lengkap' ? 'bg-success' : 'bg-warning' }}">
                                {{ $pendaftaran->status_data_orangtua }}
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
                                                    <span class="fw-medium">{{ $user->name }}</span>
                                                </li>
                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                    <span class="text-muted">Status</span>
                                                    <span>
                                                        @if ($pendaftaran->status_data_orangtua == 'Lengkap')
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
                                            <div
                                                class="alert {{ $pendaftaran->status_data_orangtua == 'Lengkap' ? 'alert-success' : 'alert-info' }} mb-0">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <i
                                                            class="fas {{ $pendaftaran->status_data_orangtua == 'Lengkap' ? 'fa-check-circle' : 'fa-info-circle' }} fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="alert-heading">
                                                            {{ $pendaftaran->status_data_orangtua == 'Lengkap' ? 'Data Orangtua Sudah Lengkap' : 'Lengkapi Data Orangtua/Wali' }}
                                                        </h5>
                                                        <p class="mb-0">
                                                            {{ $pendaftaran->status_data_orangtua == 'Lengkap'
                                                                ? 'Anda dapat melanjutkan ke tahap berikutnya untuk upload berkas persyaratan.'
                                                                : 'Silahkan lengkapi data orangtua/wali Anda untuk melanjutkan proses pendaftaran.' }}
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
                                    <h5 class="card-title mb-0">Form Data Orangtua/Wali</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('siswa.update-data-orangtua') }}" method="POST">
                                        @csrf
                                        <div class="card mb-4 border-0 bg-light">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="card-title mb-0"><i class="fas fa-male me-2"></i> Data Ayah</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nama_ayah" class="form-label">Nama Ayah <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-user"></i></span>
                                                                <input type="text"
                                                                    class="form-control @error('nama_ayah') is-invalid @enderror"
                                                                    id="nama_ayah" name="nama_ayah"
                                                                    value="{{ old('nama_ayah', $pendaftaran->nama_ayah ?? '') }}"
                                                                    placeholder="Masukkan nama ayah">
                                                            </div>
                                                            @error('nama_ayah')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('nama_ayah') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nik_ayah" class="form-label">NIK Ayah <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-id-card"></i></span>
                                                                <input type="text"
                                                                    class="form-control @error('nik_ayah') is-invalid @enderror"
                                                                    id="nik_ayah" name="nik_ayah"
                                                                    value="{{ old('nik_ayah', $pendaftaran->nik_ayah ?? '') }}"
                                                                    placeholder="Masukkan NIK ayah">
                                                            </div>
                                                            @error('nik_ayah')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('nik_ayah') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="tgl_lahir_ayah" class="form-label">Tanggal Lahir
                                                                Ayah <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                                <input type="date"
                                                                    class="form-control @error('tgl_lahir_ayah') is-invalid @enderror"
                                                                    id="tgl_lahir_ayah" name="tgl_lahir_ayah"
                                                                    value="{{ old('tgl_lahir_ayah', $pendaftaran->tgl_lahir_ayah ? $pendaftaran->tgl_lahir_ayah->format('Y-m-d') : '') }}">
                                                            </div>
                                                            @error('tgl_lahir_ayah')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('tgl_lahir_ayah') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="pendidikan_terakhir_ayah"
                                                                class="form-label">Pendidikan Terakhir Ayah <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-graduation-cap"></i></span>
                                                                <select
                                                                    class="form-select @error('pendidikan_terakhir_ayah') is-invalid @enderror"
                                                                    id="pendidikan_terakhir_ayah"
                                                                    name="pendidikan_terakhir_ayah">
                                                                    <option value="">Pilih Pendidikan</option>
                                                                    <option value="SD/Sederajat"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'SD/Sederajat' ? 'selected' : '' }}>
                                                                        SD/Sederajat</option>
                                                                    <option value="SMP/Sederajat"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'SMP/Sederajat' ? 'selected' : '' }}>
                                                                        SMP/Sederajat</option>
                                                                    <option value="SMA/Sederajat"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'SMA/Sederajat' ? 'selected' : '' }}>
                                                                        SMA/Sederajat</option>
                                                                    <option value="D1"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'D1' ? 'selected' : '' }}>
                                                                        D1</option>
                                                                    <option value="D2"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'D2' ? 'selected' : '' }}>
                                                                        D2</option>
                                                                    <option value="D3"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'D3' ? 'selected' : '' }}>
                                                                        D3</option>
                                                                    <option value="D4/S1"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'D4/S1' ? 'selected' : '' }}>
                                                                        D4/S1</option>
                                                                    <option value="S2"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'S2' ? 'selected' : '' }}>
                                                                        S2</option>
                                                                    <option value="S3"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'S3' ? 'selected' : '' }}>
                                                                        S3</option>
                                                                    <option value="Tidak Sekolah"
                                                                        {{ old('pendidikan_terakhir_ayah', $pendaftaran->pendidikan_terakhir_ayah ?? '') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                                                        Tidak Sekolah</option>
                                                                </select>
                                                            </div>
                                                            @error('pendidikan_terakhir_ayah')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('pendidikan_terakhir_ayah') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah
                                                                <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-briefcase"></i></span>
                                                                <input type="text"
                                                                    class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                                                    id="pekerjaan_ayah" name="pekerjaan_ayah"
                                                                    value="{{ old('pekerjaan_ayah', $pendaftaran->pekerjaan_ayah ?? '') }}"
                                                                    placeholder="Masukkan pekerjaan ayah">
                                                            </div>
                                                            @error('pekerjaan_ayah')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('pekerjaan_ayah') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="penghasilan_ayah" class="form-label">Penghasilan
                                                                Ayah <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-money-bill-wave"></i></span>
                                                                <select
                                                                    class="form-select @error('penghasilan_ayah') is-invalid @enderror"
                                                                    id="penghasilan_ayah" name="penghasilan_ayah">
                                                                    <option value="">Pilih Penghasilan</option>
                                                                    <option value="< Rp 1.000.000"
                                                                        {{ old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == '< Rp 1.000.000' ? 'selected' : '' }}>
                                                                        < Rp 1.000.000</option>
                                                                    <option value="Rp 1.000.000 - Rp 3.000.000"
                                                                        {{ old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 1.000.000 - Rp 3.000.000' ? 'selected' : '' }}>
                                                                        Rp 1.000.000 - Rp 3.000.000</option>
                                                                    <option value="Rp 3.000.000 - Rp 5.000.000"
                                                                        {{ old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 3.000.000 - Rp 5.000.000' ? 'selected' : '' }}>
                                                                        Rp 3.000.000 - Rp 5.000.000</option>
                                                                    <option value="Rp 5.000.000 - Rp 10.000.000"
                                                                        {{ old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == 'Rp 5.000.000 - Rp 10.000.000' ? 'selected' : '' }}>
                                                                        Rp 5.000.000 - Rp 10.000.000</option>
                                                                    <option value="> Rp 10.000.000"
                                                                        {{ old('penghasilan_ayah', $pendaftaran->penghasilan_ayah ?? '') == '> Rp 10.000.000' ? 'selected' : '' }}>
                                                                        > Rp 10.000.000</option>
                                                                </select>
                                                            </div>
                                                            @error('penghasilan_ayah')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('penghasilan_ayah') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-4 border-0 bg-light">
                                            <div class="card-header bg-info text-white">
                                                <h5 class="card-title mb-0"><i class="fas fa-female me-2"></i> Data Ibu
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nama_ibu" class="form-label">Nama Ibu <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-user"></i></span>
                                                                <input type="text"
                                                                    class="form-control @error('nama_ibu') is-invalid @enderror"
                                                                    id="nama_ibu" name="nama_ibu"
                                                                    value="{{ old('nama_ibu', $pendaftaran->nama_ibu ?? '') }}"
                                                                    placeholder="Masukkan nama ibu">
                                                            </div>
                                                            @error('nama_ibu')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('nama_ibu') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nik_ibu" class="form-label">NIK Ibu <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-id-card"></i></span>
                                                                <input type="text"
                                                                    class="form-control @error('nik_ibu') is-invalid @enderror"
                                                                    id="nik_ibu" name="nik_ibu"
                                                                    value="{{ old('nik_ibu', $pendaftaran->nik_ibu ?? '') }}"
                                                                    placeholder="Masukkan NIK ibu">
                                                            </div>
                                                            @error('nik_ibu')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('nik_ibu') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="tgl_lahir_ibu" class="form-label">Tanggal Lahir
                                                                Ibu <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                                <input type="date"
                                                                    class="form-control @error('tgl_lahir_ibu') is-invalid @enderror"
                                                                    id="tgl_lahir_ibu" name="tgl_lahir_ibu"
                                                                    value="{{ old('tgl_lahir_ibu', $pendaftaran->tgl_lahir_ibu ? $pendaftaran->tgl_lahir_ibu->format('Y-m-d') : '') }}">
                                                            </div>
                                                            @error('tgl_lahir_ibu')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('tgl_lahir_ibu') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="pendidikan_terakhir_ibu"
                                                                class="form-label">Pendidikan Terakhir Ibu <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-graduation-cap"></i></span>
                                                                <select
                                                                    class="form-select @error('pendidikan_terakhir_ibu') is-invalid @enderror"
                                                                    id="pendidikan_terakhir_ibu"
                                                                    name="pendidikan_terakhir_ibu">
                                                                    <option value="">Pilih Pendidikan</option>
                                                                    <option value="SD/Sederajat"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'SD/Sederajat' ? 'selected' : '' }}>
                                                                        SD/Sederajat</option>
                                                                    <option value="SMP/Sederajat"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'SMP/Sederajat' ? 'selected' : '' }}>
                                                                        SMP/Sederajat</option>
                                                                    <option value="SMA/Sederajat"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'SMA/Sederajat' ? 'selected' : '' }}>
                                                                        SMA/Sederajat</option>
                                                                    <option value="D1"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'D1' ? 'selected' : '' }}>
                                                                        D1</option>
                                                                    <option value="D2"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'D2' ? 'selected' : '' }}>
                                                                        D2</option>
                                                                    <option value="D3"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'D3' ? 'selected' : '' }}>
                                                                        D3</option>
                                                                    <option value="D4/S1"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'D4/S1' ? 'selected' : '' }}>
                                                                        D4/S1</option>
                                                                    <option value="S2"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'S2' ? 'selected' : '' }}>
                                                                        S2</option>
                                                                    <option value="S3"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'S3' ? 'selected' : '' }}>
                                                                        S3</option>
                                                                    <option value="Tidak Sekolah"
                                                                        {{ old('pendidikan_terakhir_ibu', $pendaftaran->pendidikan_terakhir_ibu ?? '') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                                                        Tidak Sekolah</option>
                                                                </select>
                                                            </div>
                                                            @error('pendidikan_terakhir_ibu')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('pendidikan_terakhir_ibu') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu
                                                                <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-briefcase"></i></span>
                                                                <input type="text"
                                                                    class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                                                    id="pekerjaan_ibu" name="pekerjaan_ibu"
                                                                    value="{{ old('pekerjaan_ibu', $pendaftaran->pekerjaan_ibu ?? '') }}"
                                                                    placeholder="Masukkan pekerjaan ibu">
                                                            </div>
                                                            @error('pekerjaan_ibu')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('pekerjaan_ibu') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="penghasilan_ibu" class="form-label">Penghasilan
                                                                Ibu <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-money-bill-wave"></i></span>
                                                                <select
                                                                    class="form-select @error('penghasilan_ibu') is-invalid @enderror"
                                                                    id="penghasilan_ibu" name="penghasilan_ibu">
                                                                    <option value="">Pilih Penghasilan</option>
                                                                    <option value="< Rp 1.000.000"
                                                                        {{ old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == '< Rp 1.000.000' ? 'selected' : '' }}>
                                                                        < Rp 1.000.000</option>
                                                                    <option value="Rp 1.000.000 - Rp 3.000.000"
                                                                        {{ old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 1.000.000 - Rp 3.000.000' ? 'selected' : '' }}>
                                                                        Rp 1.000.000 - Rp 3.000.000</option>
                                                                    <option value="Rp 3.000.000 - Rp 5.000.000"
                                                                        {{ old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 3.000.000 - Rp 5.000.000' ? 'selected' : '' }}>
                                                                        Rp 3.000.000 - Rp 5.000.000</option>
                                                                    <option value="Rp 5.000.000 - Rp 10.000.000"
                                                                        {{ old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == 'Rp 5.000.000 - Rp 10.000.000' ? 'selected' : '' }}>
                                                                        Rp 5.000.000 - Rp 10.000.000</option>
                                                                    <option value="> Rp 10.000.000"
                                                                        {{ old('penghasilan_ibu', $pendaftaran->penghasilan_ibu ?? '') == '> Rp 10.000.000' ? 'selected' : '' }}>
                                                                        > Rp 10.000.000</option>
                                                                </select>
                                                            </div>
                                                            @error('penghasilan_ibu')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('penghasilan_ibu') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-4 border-0 bg-light">
                                            <div class="card-header bg-secondary text-white">
                                                <h5 class="card-title mb-0"><i class="fas fa-user-friends me-2"></i> Data
                                                    Wali (Opsional)</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nama_wali" class="form-label">Nama Wali</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-user"></i></span>
                                                                <input type="text"
                                                                    class="form-control @error('nama_wali') is-invalid @enderror"
                                                                    id="nama_wali" name="nama_wali"
                                                                    value="{{ old('nama_wali', $pendaftaran->nama_wali ?? '') }}"
                                                                    placeholder="Masukkan nama wali (jika ada)">
                                                            </div>
                                                            @error('nama_wali')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('nama_wali') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nik_wali" class="form-label">NIK Wali</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-id-card"></i></span>
                                                                <input type="text"
                                                                    class="form-control @error('nik_wali') is-invalid @enderror"
                                                                    id="nik_wali" name="nik_wali"
                                                                    value="{{ old('nik_wali', $pendaftaran->nik_wali ?? '') }}"
                                                                    placeholder="Masukkan NIK wali (jika ada)">
                                                            </div>
                                                            @error('nik_wali')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('nik_wali') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="tgl_lahir_wali" class="form-label">Tanggal Lahir
                                                                Wali</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                                <input type="date"
                                                                    class="form-control @error('tgl_lahir_wali') is-invalid @enderror"
                                                                    id="tgl_lahir_wali" name="tgl_lahir_wali"
                                                                    value="{{ old('tgl_lahir_wali', $pendaftaran->tgl_lahir_wali ? $pendaftaran->tgl_lahir_wali->format('Y-m-d') : '') }}">
                                                            </div>
                                                            @error('tgl_lahir_wali')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('tgl_lahir_wali') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="pendidikan_terakhir_wali"
                                                                class="form-label">Pendidikan Terakhir Wali</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-graduation-cap"></i></span>
                                                                <select
                                                                    class="form-select @error('pendidikan_terakhir_wali') is-invalid @enderror"
                                                                    id="pendidikan_terakhir_wali"
                                                                    name="pendidikan_terakhir_wali">
                                                                    <option value="">Pilih Pendidikan</option>
                                                                    <option value="SD/Sederajat"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'SD/Sederajat' ? 'selected' : '' }}>
                                                                        SD/Sederajat</option>
                                                                    <option value="SMP/Sederajat"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'SMP/Sederajat' ? 'selected' : '' }}>
                                                                        SMP/Sederajat</option>
                                                                    <option value="SMA/Sederajat"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'SMA/Sederajat' ? 'selected' : '' }}>
                                                                        SMA/Sederajat</option>
                                                                    <option value="D1"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'D1' ? 'selected' : '' }}>
                                                                        D1</option>
                                                                    <option value="D2"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'D2' ? 'selected' : '' }}>
                                                                        D2</option>
                                                                    <option value="D3"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'D3' ? 'selected' : '' }}>
                                                                        D3</option>
                                                                    <option value="D4/S1"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'D4/S1' ? 'selected' : '' }}>
                                                                        D4/S1</option>
                                                                    <option value="S2"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'S2' ? 'selected' : '' }}>
                                                                        S2</option>
                                                                    <option value="S3"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'S3' ? 'selected' : '' }}>
                                                                        S3</option>
                                                                    <option value="Tidak Sekolah"
                                                                        {{ old('pendidikan_terakhir_wali', $pendaftaran->pendidikan_terakhir_wali ?? '') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                                                        Tidak Sekolah</option>
                                                                </select>
                                                            </div>
                                                            @error('pendidikan_terakhir_wali')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('pendidikan_terakhir_wali') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="pekerjaan_wali" class="form-label">Pekerjaan
                                                                Wali</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-briefcase"></i></span>
                                                                <input type="text"
                                                                    class="form-control @error('pekerjaan_wali') is-invalid @enderror"
                                                                    id="pekerjaan_wali" name="pekerjaan_wali"
                                                                    value="{{ old('pekerjaan_wali', $pendaftaran->pekerjaan_wali ?? '') }}"
                                                                    placeholder="Masukkan pekerjaan wali (jika ada)">
                                                            </div>
                                                            @error('pekerjaan_wali')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('pekerjaan_wali') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="penghasilan_wali" class="form-label">Penghasilan
                                                                Wali</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-money-bill-wave"></i></span>
                                                                <select
                                                                    class="form-select @error('penghasilan_wali') is-invalid @enderror"
                                                                    id="penghasilan_wali" name="penghasilan_wali">
                                                                    <option value="">Pilih Penghasilan</option>
                                                                    <option value="< Rp 1.000.000"
                                                                        {{ old('penghasilan_wali', $pendaftaran->penghasilan_wali ?? '') == '< Rp 1.000.000' ? 'selected' : '' }}>
                                                                        < Rp 1.000.000</option>
                                                                    <option value="Rp 1.000.000 - Rp 3.000.000"
                                                                        {{ old('penghasilan_wali', $pendaftaran->penghasilan_wali ?? '') == 'Rp 1.000.000 - Rp 3.000.000' ? 'selected' : '' }}>
                                                                        Rp 1.000.000 - Rp 3.000.000</option>
                                                                    <option value="Rp 3.000.000 - Rp 5.000.000"
                                                                        {{ old('penghasilan_wali', $pendaftaran->penghasilan_wali ?? '') == 'Rp 3.000.000 - Rp 5.000.000' ? 'selected' : '' }}>
                                                                        Rp 3.000.000 - Rp 5.000.000</option>
                                                                    <option value="Rp 5.000.000 - Rp 10.000.000"
                                                                        {{ old('penghasilan_wali', $pendaftaran->penghasilan_wali ?? '') == 'Rp 5.000.000 - Rp 10.000.000' ? 'selected' : '' }}>
                                                                        Rp 5.000.000 - Rp 10.000.000</option>
                                                                    <option value="> Rp 10.000.000"
                                                                        {{ old('penghasilan_wali', $pendaftaran->penghasilan_wali ?? '') == '> Rp 10.000.000' ? 'selected' : '' }}>
                                                                        > Rp 10.000.000</option>
                                                                </select>
                                                            </div>
                                                            @error('penghasilan_wali')
                                                                <div class="text-danger small mt-1">
                                                                    {{ $errors->first('penghasilan_wali') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-4 border-0 bg-light">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="card-title mb-0"><i class="fas fa-address-book me-2"></i>
                                                    Informasi Kontak</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="alamat_orangtua" class="form-label">Alamat Orangtua/Wali
                                                        <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                        <textarea class="form-control @error('alamat_orangtua') is-invalid @enderror" id="alamat_orangtua"
                                                            name="alamat_orangtua" rows="3" placeholder="Masukkan alamat lengkap orangtua/wali">{{ old('alamat_orangtua', $pendaftaran->alamat_orangtua ?? '') }}</textarea>
                                                    </div>
                                                    @error('alamat_orangtua')
                                                        <div class="text-danger small mt-1">
                                                            {{ $errors->first('alamat_orangtua') }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_hp_orangtua" class="form-label">Nomor HP Orangtua/Wali
                                                        <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                        <input type="text"
                                                            class="form-control @error('no_hp_orangtua') is-invalid @enderror"
                                                            id="no_hp_orangtua" name="no_hp_orangtua"
                                                            value="{{ old('no_hp_orangtua', $pendaftaran->no_hp_orangtua ?? '') }}"
                                                            placeholder="Contoh: 08123456789">
                                                    </div>
                                                    @error('no_hp_orangtua')
                                                        <div class="text-danger small mt-1">
                                                            {{ $errors->first('no_hp_orangtua') }}</div>
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
