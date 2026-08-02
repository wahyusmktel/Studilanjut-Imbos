<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat Nilai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin: 0 auto;
            width: 80%;
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
    </style>
</head>

<body>
    <div class="header">
        <h1>Sertifikat Nilai</h1>
        <h3>{{ $siswa->nama_siswa }}</h3>
    </div>
    <div class="content">
        <p><strong>Nama:</strong> {{ $siswa->nama_siswa }}</p>
        <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
        <p><strong>Try Out:</strong> {{ $siswa->nilais->first()->tryout->nama_tryout ?? '' }}</p>
        <p><strong>Tahun Pelajaran:</strong>
            {{ $siswa->nilais->first()->tryout->tahunPelajaran->nama_tahun_pelajaran ?? '' }}</p>
        <p><strong>Semester:</strong> {{ $siswa->nilais->first()->tryout->tahunPelajaran->semester ?? '' }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa->nilais as $index => $nilai)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $nilai->mataPelajaran->namaMataPelajaran }}</td>
                        <td>{{ $nilai->nilai }}</td>
                    </tr>
                @endforeach
                @if ($siswa->nilais->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
