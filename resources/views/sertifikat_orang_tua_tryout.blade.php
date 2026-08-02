<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat Hasil Tryout</title>
    <link href="{{ public_path('halaman_umum/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ url('storage/' . $settingSertifikat->watermark) }}') no-repeat center center;
            background-size: 350px 350px;
            background-blend-mode: multiply;
            opacity: 0.1;
            z-index: -1;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin: 0 auto;
            width: 100%;
            flex: 1;
            /* Membuat content mengambil ruang yang tersisa */
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .content table,
        .content th,
        .content td {
            border: 1px solid black;
        }

        .content th {
            padding: 5px;
            text-align: center;
            background-color: #f2f2f2;
        }

        .content td {
            padding: 5px;
            text-align: left;
        }

        .footer {
            margin-top: auto;
            /* Mendorong footer ke bawah */
            padding: 10px 0;
            /* Tambahan padding jika diperlukan */
            text-align: center;
        }

        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .center {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .table-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            /* Atur ke flex-start agar elemen berada di baris yang sama */
            margin-bottom: 10px;
        }

        .tablek {
            border: 1px dotted black;
            border-collapse: collapse;
            width: 100%;
        }

        .left-section {
            width: 65%;
            /* Pastikan total lebar dari left-section dan right-section tidak lebih dari 100% */
        }

        .right-section {
            width: 30%;
            text-align: center;
        }

        .right-section img {
            max-width: 100%;
            height: auto;
        }

        .barcode {
            width: 100%;
            height: 100px;
            background-color: #f2f2f2;
            text-align: center;
            vertical-align: middle;
            display: table-cell;
        }

        .image-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .info-table {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="top-right">
        <p><strong>No Sertifikat:</strong> {{ $sertifikat->no_sertifikat }}</p>
    </div>
    <div class="image-container">
        <img width="350px" src="{{ url('storage/' . $settingSertifikat->logo_1) }}" alt="Logo 1" class="img-fluid">
    </div>
    <div class="center">
        <br>
        <h1>SERTIFIKAT HASIL</h1>
        <!-- <p>{{ ucwords(strtolower($nilai->first()->first()->tryout->nama_tryout)) }} Tahun Pelajaran
            {{ $nilai->first()->first()->tryout->tahunPelajaran->nama_tahun_pelajaran }} Semester
            {{ $nilai->first()->first()->tryout->tahunPelajaran->semester == 1 ? 'Ganjil' : 'Genap' }}</p> -->
        <p>{{ ucwords(strtolower($nilai->first()->first()->tryout->nama_tryout)) }} Tahun Pelajaran
            {{ $nilai->first()->first()->tryout->tahunPelajaran->nama_tahun_pelajaran }}</p>
    </div>
    <div class="content">
        <div class="table-container">
            <div class="left-section" style="margin: 0 auto;">
                <table class="tablek">
                    <tr>
                        <td rowspan="3" style="width: 60px">
                            <img src="{{ $src }}" alt="Foto Siswa" style="width:70px; height: 90px">
                        </td>
                        <td width="30%" style="height:10px; align-items: center;"><strong>NAMA</strong></td>
                        <td>{{ strtoupper($siswa->nama_siswa) }}</td>
                    </tr>
                    <tr>
                        <td style="height:10px"><strong>KELAS</strong></td>
                        <td>{{ strtoupper($siswa->kelas->nama_kelas) }}</td>
                    </tr>
                    <tr>
                        <td style="height:10px"><strong>NIS</strong></td>
                        <td>{{ strtoupper($siswa->nis) }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="center">
            <p>Telah mengikuti {{ ucwords(strtolower($nilai->first()->first()->tryout->nama_tryout)) }} pada tanggal
                {{ \Carbon\Carbon::parse($nilai->first()->first()->tryout->tanggal)->translatedFormat('d F Y') }} dan
                berlaku sebagai
                bukti kemajuan hasil belajar bimbel studi lanjut SMAIT IMBOS Pringsewu, <br>dengan hasil sebagai berikut
                :</p>
        </div>
        <div class="table-container">
            <div class="left-section" style="margin: 0 auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>TES LITERASI</th>
                            <th>NILAI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mataPelajaransFalse as $mataPelajaran)
                            <tr>
                                <td>{{ strtoupper($mataPelajaran->namaMataPelajaran) }}</td>
                                <td align="center" style="text-align: center">
                                    {{ $nilai->first()->where('mata_pelajaran_id', $mataPelajaran->id)->first()? number_format($nilai->first()->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai,2): '-' }}
                                </td>
                                {{-- <td align="center" style="text-align: center">{{ $nilai->first()->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai ?? '-' }}</td> --}}
                            </tr>
                        @endforeach
                        @if ($mataPelajaransTrue->isNotEmpty())
                            <tr>
                                <th colspan="2">TES POTENSI SKOLASTIK</th>
                            </tr>
                            @foreach ($mataPelajaransTrue as $mataPelajaran)
                                <tr>
                                    <td>{{ strtoupper($mataPelajaran->namaMataPelajaran) }}</td>
                                    <td align="center" style="text-align: center">
                                        {{ $nilai->first()->where('mata_pelajaran_id', $mataPelajaran->id)->first()? number_format($nilai->first()->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai,2): '-' }}
                                    </td>
                                    {{-- <td align="center" style="text-align: center">{{ $nilai->first()->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai ?? '-' }}</td> --}}
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    {{-- <div class="footer">
        <p>&copy; 2024 SMAIT IMBOS Pringsewu</p>
    </div> --}}
</body>

</html>
