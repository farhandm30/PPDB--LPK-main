<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1cm;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.2;
            color: #000;
            margin: 0;
            padding: 0;
            font-size: 9pt;
        }
        .container {
            width: 100%;
            max-width: 21cm;
            margin: 0 auto;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 3px;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
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
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .header-text p {
            margin: 0;
            padding: 0;
            font-size: 7pt;
            text-align: center;
        }
        .document-title {
            text-align: center;
            margin: 8px 0 3px;
        }
        .document-title h2 {
            font-size: 11pt;
            font-weight: bold;
            margin: 0;
            padding: 0;
            text-decoration: underline;
        }
        .document-number {
            text-align: center;
            margin: 2px 0 5px;
            font-size: 9pt;
        }
        .content {
            margin-bottom: 5px;
            text-align: justify;
        }
        table.info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
        }
        table.info-table td {
            padding: 1px 5px;
            vertical-align: top;
        }
        .footer {
            margin-top: 10px;
        }
        .statement {
            margin: 5px 0;
        }
        .statement ol {
            margin-left: 15px;
            padding-left: 0;
            margin-bottom: 0;
            margin-top: 3px;
        }
        .statement li {
            margin-bottom: 2px;
            text-align: justify;
        }
        .statement ol ol {
            list-style-type: lower-alpha;
            margin-top: 2px;
        }
        .indent {
            margin-left: 12px;
            font-size: 8pt;
            line-height: 1.1;
        }
        .divider {
            border-bottom: 1px solid #000;
            margin: 0 0 3px 0;
        }
        p {
            margin: 3px 0;
        }
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .signature-table td {
            vertical-align: top;
            padding: 0;
        }
        .signature-line {
            display: inline-block;
            width: 80%;
            border-bottom: 1px solid #000;
            margin: 0 auto;
        }
        .signature-name {
            margin-top: 0;
            margin-bottom: 0;
        }
        .signature-title {
            margin-top: 0;
        }
        .date-row {
            text-align: right;
            padding-right: 10%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            @if($pengaturan && $pengaturan->logo_persegi)
                <img class="logo" src="{{ public_path('storage/' . $pengaturan->logo_persegi) }}" alt="Logo">
            @elseif($pengaturan && $pengaturan->logo)
                <img class="logo" src="{{ public_path('storage/' . $pengaturan->logo) }}" alt="Logo">
            @else
                <div class="logo" style="text-align: center; line-height: 60px; border: 1px solid #ccc;">Logo</div>
            @endif
            <div class="header-text">
                <h1>{{ $pengaturan->nama_instansi ?? 'ORIEDA SATU INDONESIA' }}</h1>
                <p>{{ $pengaturan->alamat_instansi ?? 'Jalan Sutawijaya No. 08, RT 10/RW 02, Kelurahan Kincang Wetan, Kecamatan Jiwan, Kabupaten Madiun, Jawa Timur, kode pos : 63161' }} Website : {{ $pengaturan->website ?? 'www.orieda.id' }}, email : {{ $pengaturan->email_instansi ?? 'info@orieda.id' }}, Telepon :{{ $pengaturan->notlp_instansi ?? '081231876600' }} Nomor izin: 1226000232937</p>
            </div>
        </div>
        
        <div class="divider"></div>
        
        <div class="document-title">
            <h2>SURAT PERNYATAAN</h2>
        </div>
        
        <div class="document-number">
            Nomor : 010/SP/LPK-ORIEDA/III/{{ $pendaftaran->tahunAjaran->nama_tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1) }}
        </div>
        
        <div class="content">
            <p>Yang bertanda tangan dibawah ini :</p>
            
            <table class="info-table">
                <tr>
                    <td width="25%">Nama Lengkap</td>
                    <td width="5%">:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $pendaftaran->tempat_lahir_siswa ?? '' }}, {{ $pendaftaran->tgl_lahir_siswa ? date('d-m-Y', strtotime($pendaftaran->tgl_lahir_siswa)) : '' }}</td>
                </tr>
                <tr>
                    <td>Asal Sekolah</td>
                    <td>:</td>
                    <td>{{ $pendaftaran->asal_sekolah ?? '' }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $pendaftaran->alamat_siswa ?? '' }}</td>
                </tr>
                <tr>
                    <td>Nomor NIK</td>
                    <td>:</td>
                    <td>{{ $pendaftaran->nik_siswa ?? '' }}</td>
                </tr>
            </table>
            
            <p style="margin-bottom: 2px;">Sebagai siswa pelatihan Bahasa Jepang LPK ORIEDA SATU INDONESIA menyatakan dengan sebenar benarnya bahwa saya akan menyetujui tata tertib dan kesepakatan Bersama antara saya dan LPK ORIEDA SATU INDONESIA seperti yang tercantum di bawah ini :</p>
            
            <div class="statement">
                <ol>
                    <li>Berkomitmen mengikuti pelatihan Bahasa Jepang yang dilaksanakan di LPK ORIEDA SATU INDONESIA sampai maksimal 6 Bulan.</li>
                    <li>Bersedia membayar paket pembiayaan pelatihan sampai dengan keberangkatan ke Jepang dengan biaya maksimal antara Rp. 30.000.000 s/d Rp. 45.000.000 untuk Biaya Pelatihan dan Pemberangkatan ke Jepang dengan rincian :
                        <ol type="a">
                            <li>Pembayaran Pelatihan Bahasa Jepang selama maksimal 6 bulan Rp. 5.500.000 dengan tahapan pembayaran sebagai berikut.
                                <div class="indent">
                                    -Tahapan pertama uang muka sebesar Rp. 500.000<br>
                                    -Tahapan bulan kedua Rp. 1.500.000<br>
                                    -Tahapan bulan ketiga Rp. 1.500.000<br>
                                    -Tahapan bulan keempat Rp. 1.000.000<br>
                                    -Tahapan bulan kelima Rp. 1.000.000
                                </div>
                            </li>
                            <li>Saya bersedia membayar seluruh biaya pelatihan dengan mencicil selama pendidikan Bahasa Jepang sampai dengan kelulusan maksimal 6 bulan, apabila selama saya mengikuti pendidikan sebelum mencapai 6 bulan mengundurkan diri di tahapan tertentu, atau saya melakukan kesalahan fatal yang tidak bisa di tolerir diluar aturan yang berlaku di LPK ORIEDA SATU INDONESIA masa berjalan pendidikan di bulan tertentu selama tahapan 6 bulan, saya siap melunasi selisih biaya yang di bayarkan kepada kami.</li>
                            <li>Saya bersedia mengikuti pendidikan Bahasa Jepang di LPK ORIEDA SATU INDONESIA, seluruh biaya yang saya sudah bayarkan ke LPK ORIEDA SATU INDONESIA sudah menjadi milik hak penuh LPK ORIEDA SATU INDONESIA dan tidak ada tuntutan biaya pengembalian.</li>
                            <li>Saya siap membayar seluruh biaya paket Pelatihan dan Pemberangkatan ke Jepang, melalui DANA TALANG dari Lembaga keuangan yang sudah bekerjasama dengan LPK ORIEDA SATU INDONESIA.</li>
                            <li>Saya bersedia penuh mencicil dana talang sesuai kontrak dari lembaga keuangan setiap bulan setelah saya bekerja di Jepang.</li>
                            <li>Semua uang yang sudah masuk tidak dapat dikembalikan dengan alasan apapun apabila siswa mengundurkan diri</li>
                            <li>Apabila LPK tidak menyelenggarakan Pendidikan maka uang yang sudah masuk dari siswa akan di kembalikan sesuai dengan SOP pengembalian</li>
                        </ol>
                    </li>
                </ol>
            </div>
            
            <p>Demikian surat pernyataan yang saya buat dengan sesungguhnya dan tidak ada paksaan dari siapapun.</p>
        </div>
        
        <div class="footer">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="45%" align="center">
                        Menyetujui
                    </td>
                    <td width="10%"></td>
                    <td width="45%" align="center">
                        {{ $pengaturan->kota ?? 'Madiun' }}, ____________ {{ substr($pendaftaran->tahunAjaran->nama_tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1), 0, 4) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="50">&nbsp;</td>
                </tr>
                <tr>
                    <td width="45%" align="center">
                        <div style="font-weight: bold; margin-bottom: 5px;">Materai10.000</div>
                    </td>
                    <td width="10%"></td>
                    <td width="45%" align="center">&nbsp;</td>
                </tr>
                {{-- <tr>
                    <td width="45%" align="center">
                        <div style="border-bottom: 1px solid #000; width: 80%; margin: 0 auto;"></div>
                    </td>
                    <td width="10%"></td>
                    <td width="45%" align="center">
                        <div style="border-bottom: 1px solid #000; width: 80%; margin: 0 auto;"></div>
                    </td>
                </tr> --}}
                <tr>
                    <td width="45%" align="center">
                        <p style="margin: 0;">(................................................)</p>
                    </td>
                    <td width="10%"></td>
                    <td width="45%" align="center">
                        <p style="margin: 0;">(............................................)</p>
                    </td>
                </tr>
                <tr>
                    <td width="45%" align="center">
                        <p style="margin: 0;">OrangTua/ Wali</p>
                    </td>
                    <td width="10%"></td>
                    <td width="45%" align="center">
                        <p style="margin: 0;">Siswa/Siswi</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html> 