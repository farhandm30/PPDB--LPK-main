<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 5px;
        }

        .logo {
            width: 60px;
            height: auto;
            margin-right: 10px;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 12pt;
            font-weight: bold;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
        }

        .header-text p {
            margin: 1px 0;
            padding: 0;
            font-size: 9pt;
        }

        .title {
            text-align: center;
            margin: 8px 0;
        }

        .title h2 {
            font-size: 12pt;
            font-weight: bold;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .title p {
            margin: 3px 0;
            padding: 0;
            font-size: 10pt;
        }

        p {
            margin: 3px 0;
            padding: 0;
        }

        table.info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0;
        }

        table.info-table td {
            padding: 1px;
            vertical-align: top;
            font-size: 10pt;
        }

        table.steps-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
            margin: 3px 0;
        }

        table.steps-table th,
        table.steps-table td {
            border: 1px solid black;
            padding: 2px;
            font-size: 9pt;
            vertical-align: top;
        }

        table.steps-table th {
            font-weight: bold;
            text-align: center;
            background-color: #f0f0f0;
        }

        ol {
            margin: 3px 0 3px 20px;
            padding: 0;
        }

        ol li {
            margin: 0;
            padding: 0;
            font-size: 9pt;
        }

        .footer {
            margin-top: 5px;
            font-style: italic;
            font-size: 9pt;
            text-align: center;
        }

        a {
            color: blue;
            text-decoration: underline;
        }

        .section-header {
            font-weight: bold;
            margin-top: 5px;
            margin-bottom: 3px;
            font-size: 10pt;
        }

        .congrats {
            font-weight: bold;
            font-size: 10pt;
        }

        .compact-info {
            display: flex;
            justify-content: space-between;
        }

        .compact-info-column {
            width: 48%;
        }

        .documents-list {
            margin: 0;
            padding-left: 15px;
            font-size: 9pt;
        }

        .documents-list li {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        @if ($pengaturan && $pengaturan->logo_persegi)
            <img class="logo" src="{{ public_path('storage/' . $pengaturan->logo_persegi) }}" alt="Logo">
        @elseif($pengaturan && $pengaturan->logo)
            <img class="logo" src="{{ public_path('storage/' . $pengaturan->logo) }}" alt="Logo">
        @else
            <div class="logo" style="text-align: center; line-height: 60px; border: 1px solid #ccc;">Logo</div>
        @endif
        <div class="header-text">
            <h1>PANITIA PENERIMAAN PESERTA DIDIK BARU</h1>
            <h1>{{ $pengaturan->nama_instansi ?? 'ORIEDA SATU INDONESIA' }} TP.
                {{ $pendaftaran->tahunAjaran->nama_tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1) }}</h1>
            <p>{{ $pengaturan->alamat_instansi ?? 'Jalan Sutawijaya No. 08, RT 10/RW 02, Kelurahan Kincang Wetan, Kecamatan Jiwan, Kabupaten Madiun, Jawa Timur, kode pos : 63161' }}
            </p>
            <p>Email : <a
                    href="mailto:{{ $pengaturan->email_instansi ?? 'info@orieda.id' }}">{{ $pengaturan->email_instansi ?? 'info@orieda.id' }}</a>
                | Website : <a
                    href="https://{{ $pengaturan->website ?? 'www.orieda.id' }}">{{ $pengaturan->website ?? 'www.orieda.id' }}</a>
            </p>
        </div>
    </div>

    <div class="title">
        <h2>TANDA BUKTI PENDAFTARAN</h2>
        <p>{{ $pengaturan->nama_instansi ?? 'ORIEDA SATU INDONESIA' }} Tahun Pelajaran
            {{ $pendaftaran->tahunAjaran->nama_tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1) }}</p>
    </div>

    <p class="congrats">Selamat Anda sudah terdaftar menjadi calon peserta didik baru
        {{ $pengaturan->nama_instansi ?? 'ORIEDA SATU INDONESIA' }} Tahun Pelajaran
        {{ $pendaftaran->tahunAjaran->nama_tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1) }}.</p>

    <p class="section-header">I. Informasi Pendaftar</p>
    <div class="compact-info">
        <div class="compact-info-column">
            <table class="info-table">
                <tr>
                    <td width="110">Nama Lengkap</td>
                    <td width="10">:</td>
                    <td>{{ $user->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Nomor Pendaftaran</td>
                    <td>:</td>
                    <td>{{ $pendaftaran->no_daftar ?? 'PPDB-' . date('Y') . '0001' }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $pendaftaran->nik_siswa ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Asal Sekolah</td>
                    <td>:</td>
                    <td>{{ $pendaftaran->asal_sekolah ?? '-' }}</td>
                </tr>
            </table>
        </div>
        <div class="compact-info-column">
            <table class="info-table">
                <tr>
                    <td width="110">No. HP</td>
                    <td width="10">:</td>
                    <td>{{ $pendaftaran->nohp_siswa ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $pendaftaran->jk_siswa ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>
    <table class="info-table">
        <tr>
            <td width="110">Jurusan Pilihan</td>
            <td width="10">:</td>
            <td><strong>{{ $selectedJurusan->nama_jurusan ?? ($pendaftaran->jurusan->nama_jurusan ?? 'Keahlian') }}</strong>
            </td>
        </tr>
    </table>

    <p class="section-header">II. Informasi Tahapan yang Harus dilakukan:</p>
    <p>Tahapan Pengisian Data dilakukan secara online melalui <strong>SIM PPDB</strong> dengan cara akses :</p>
    <table class="info-table" style="margin-bottom: 0;">
        <tr>
            <td width="110">Link SIM PPDB</td>
            <td width="10">:</td>
            <td><a href="{{ url('/') }}">{{ url('/') }}</a></td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>{{ $user->email ?? '-' }}</td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td>{{ session('original_password') ?? 'admin123' }}</td>
        </tr>
    </table>
    <p style="font-size: 9pt;">Untuk membuka link sim PPDB disarankan menggunakan <strong>Google Chrome</strong>. Pilih
        titik 3 di pojok kanan atas lalu klik mode desktop untuk tampilan lebih mudah digunakan.</p>

    <table class="steps-table">
        <tr>
            <th width="5%">No.</th>
            <th width="22%">Tahap</th>
            <th width="38%">Kegiatan</th>
            <th width="35%">Keterangan</th>
        </tr>
        <tr>
            <td align="center">1.</td>
            <td>Mengisi Data Diri</td>
            <td>Mengisi data diri di SIM PPDB. Pilih menu Pengisian Data Diri lalu pilih <strong>Data Diri</strong>.
            </td>
            <td rowspan="3" style="font-size: 9pt;">
                Siapkan dokumen berikut:<br>
                1. Ijazah Terakhir<br>
                2. KTP/SIM/Paspor<br>

            </td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td>Mengisi Data Orangtua / Wali</td>
            <td>Mengisi data orangtua di SIM PPDB. Pilih menu Pengisian Data Diri lalu pilih <strong>Data Orang
                    Tua</strong>.</td>
        </tr>
        <tr>
            <td align="center">3.</td>
            <td>Upload Dokumen</td>
            <td>Pilih menu Pengisian Data Diri lalu pilih <strong>Dokumen</strong>.</td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td>Jadwal Wawancara</td>
            <td colspan="2">Untuk mengetahui Jadwal Wawancara. <strong>Calon peserta didik akan
                    diundang di grub Whatsapp untuk mengikuti wawancara.</strong></td>
        </tr>
    </table>

    <p class="section-header">Berkas Persyaratan yang wajib dibawa ketika Wawancara:</p>
    <div class="compact-info">
        <div class="compact-info-column">
            <ul class="documents-list">
                <li>Ijazah Terakhir</li>
                <li>KTP/SIM/Paspor</li>
            </ul>
        </div>
        <div class="compact-info-column">
            <ul class="documents-list">
                <li>Fotokopi KTP Ayah dan Ibu</li>
                {{-- <li>Fotokopi Akte Kelahiran</li> --}}
            </ul>
        </div>
    </div>

    <p class="section-header">Help Desk PPDB {{ $pengaturan->nama_instansi ?? 'ORIEDA SATU INDONESIA' }}:</p>
    <p style="font-size: 9pt;">Hotline PPDB : {{ $pengaturan->notlp_instansi ?? '081231876600' }}</p>

    <p class="footer">Terima kasih.</p>
</body>

</html>
