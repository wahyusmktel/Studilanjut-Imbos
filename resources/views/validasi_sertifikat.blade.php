<!DOCTYPE html>
<html>

<head>
    <title>Validasi Sertifikat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }

        .header,
        .content,
        .footer {
            margin-bottom: 20px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .content table,
        .content th,
        .content td {
            border: 1px solid black;
        }

        .content th,
        .content td {
            padding: 8px;
            text-align: left;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Validasi Sertifikat</h1>
    </div>

    <div class="content">
        @if (isset($message))
            <p>{{ $message }}</p>
        @else
            <p><strong>Nama Siswa:</strong> {{ $siswa->nama_siswa }}</p>
            <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
            <p><strong>Try Out:</strong> {{ $tryout->nama_tryout }}</p>
            <p><strong>Tahun Pelajaran:</strong> {{ $tryout->tahunPelajaran->nama_tahun_pelajaran }}</p>
            <p><strong>Semester:</strong> {{ $tryout->tahunPelajaran->semester == 1 ? 'Ganjil' : 'Genap' }}</p>
            <p><strong>Nomor Sertifikat:</strong> {{ $sertifikat->no_sertifikat }}</p>
            <div class="footer">
                <p>Sertifikat ini asli dikeluarkan oleh IMBOS Pringsewu.</p>
            </div>
        @endif
    </div>
</body>

</html>
