<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Domisili</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
         .garis { border-bottom: 3px solid black; margin-top: 5px; margin-bottom: 20px; } */
        table { width: 100%; }
        .kop-surat {
            text-align: center;
            position: relative;
            margin-bottom: 10px; /* Mengurangi jarak di bawah kop surat */
        }

        .kop-surat img {
            width: 80px; /* Ukuran logo */
            position: absolute;
            top: 0;
            left: 0;
        }

        /* Mengatur agar margin dan padding kop surat lebih rapat */
        .kop-surat h1,h2,h3, .kop-surat p {
            margin: 7px; /* Hilangkan margin pada heading dan paragraph */
            padding: 0;
            line-height: 1.2;
             /* Jarak antar baris yang lebih kecil */
        }

    </style>
</head>
<body>

    {{-- ==== KOP SURAT ==== --}}
    <!-- <table style="width: 100%;">
        <tr>
            <td style="width: 15%; vertical-align: top; padding-top: 5px;">
                <img src="{{ public_path('storage/kop/logo.png') }}" width="80">
            </td>
            <td class="text-center" style="width: 80%;">
                <strong>PEMERINTAH KABUPATEN BATANGHARI</strong><br>
                <strong>KECAMATAN PEMAYUNG</strong><br>
                <strong>Kelurahan Jembatan Mas</strong><br>
                <span>Alamat: Jl. Contoh Raya No. 123, KABUPATEN BATANGHARI, 12345</span>
            </td>
        </tr>
    </table> -->
<div class="kop-surat">
        <img src="{{ public_path('storage/kop/logo.png') }}" alt="Logo">
        <h2>PEMERINTAH KABUPATEN BATANGHARI</h2>
        <h3>KECAMATAN PEMAYUNG</h3>
        <h3>Kelurahan Jembatan Mas</h3>
        <p>Alamat : Jl. Kapten A. Zaidi Saleh - Paal Lima
        Kota Baru, Jambi.</p>


    </div>

    <div class="garis"></div>

    {{-- ==== JUDUL SURAT ==== --}}
    <h3 class="text-center">SURAT KETERANGAN DOMISILI</h3>
    <p class="text-center">Nomor: {{ $data->nomor_surat }}</p>

    {{-- ==== ISI SURAT ==== --}}
    <p>Yang bertanda tangan di bawah ini:</p>
    <p>Nama: Lurah Kelurahan Jembatan Mas</p>
    <p>Jabatan: Lurah</p>

    <p>Dengan ini menerangkan bahwa:</p>
    <table>
        <tr><td width="30%">Nama</td><td>: {{ $data->penduduk->nama }}</td></tr>
        <tr><td>NIK</td><td>: {{ $data->penduduk->nik }}</td></tr>
        <tr><td>Tempat/Tgl Lahir</td><td>: {{ $data->penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->penduduk->tanggal_lahir)->format('d-m-Y') }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->penduduk->alamat }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->penduduk->pekerjaan }}</td></tr>
    </table>

    <p>
        Adalah benar yang bersangkutan berdomisili di wilayah Kelurahan Jembatan Mas,
        dan surat ini dibuat untuk keperluan <strong>{{ $data->keperluan }}</strong>.
    </p>

    <p>Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

    <br><br>
    <p class="text-right">Kelurahan Jembatan Mas, {{ \Carbon\Carbon::parse($data->tanggal_surat)->translatedFormat('d F Y') }}</p>
    <p class="text-right">Lurah</p>

    <br><br><br>
    <p class="text-right">(_____________________)</p>
</body>
</html>
