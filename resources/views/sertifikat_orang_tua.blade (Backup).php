<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat Nilai</title>
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
        }

        .header .sub-header {
            text-align: left;
            margin-bottom: -20px;
        }

        .footer {
            margin-top: 100px;
            /* Mendorong footer ke bawah */
            padding: 10px 0;
            /* Tambahan padding jika diperlukan */
            text-align: center;
        }

        .content {
            margin: 0 auto;
            width: 100%;
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

        .content th {
            padding: 8px;
            text-align: center;
            background-color: #f2f2f2;
        }

        .content td {
            padding: 8px;
            text-align: center;
        }

        .image-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>

<body>
    <div class="top-right">
        <p><strong>No :</strong> {{ $sertifikatperkembangan->no_sertifikat }}</p>
    </div>
    <div class="image-container">
        <img width="350px" src="{{ url('storage/' . $settingSertifikat->logo_1) }}" alt="Logo 1" class="img-fluid">
    </div>
    <div class="header">
        <h1>RAPOR PERKEMBANGAN BIMBEL</h1>
        <div class="sub-header">
            <h3>NAMA : {{ strtoupper($siswa->nama_siswa) }}</h3>
            <p><strong>NIS : </strong> {{ strtoupper($siswa->nis) }}</p>
            <p><strong>KELAS : </strong> {{ strtoupper($siswa->kelas->nama_kelas) }}</p>
        </div>
    </div>
    <div class="content">
        <table class="table table-hover table-bordered mb-0">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">TRY OUT</th>
                    <th rowspan="2">TAHUN PELAJARAN</th>
                    <th rowspan="2">SEMESTER</th>
                    <!-- Tampilkan mata pelajaran yang tidak termasuk TPS dan tidak kedinasan -->
                    @foreach ($mataPelajarans->where('opsi_test_tps', false)->where('opsi_kedinasan', false) as $mataPelajaran)
                        <th rowspan="2">{{ strtoupper($mataPelajaran->namaMataPelajaran) }}</th>
                    @endforeach
                    <!-- Kondisi untuk menampilkan kolom "Tes Potensi Skolastik" -->
                    @if ($statusKedinasan === 0 || $statusKedinasan === 2)
                        <th colspan="{{ $mataPelajarans->where('opsi_test_tps', true)->count() }}">TES POTENSI SKOLASTIK
                        </th>
                    @endif

                    <!-- Kondisi untuk menampilkan kolom "Tes Kedinasan" -->
                    @if ($mataPelajarans->where('opsi_kedinasan', true)->where('opsi_test_tps', false)->count() > 0)
                        <th
                            colspan="{{ $mataPelajarans->where('opsi_kedinasan', true)->where('opsi_test_tps', false)->count() }}">
                            TES KEDINASAN</th>
                    @endif
                </tr>
                <tr>
                    <!-- Kolom untuk Tes Potensi Skolastik -->
                    @if ($statusKedinasan === 0 || $statusKedinasan === 2)
                        @foreach ($mataPelajarans->where('opsi_test_tps', true) as $mataPelajaran)
                            <th>{{ strtoupper($mataPelajaran->namaMataPelajaran) }}</th>
                        @endforeach
                    @endif

                    <!-- Kolom untuk Tes Kedinasan -->
                    @foreach ($mataPelajarans->where('opsi_kedinasan', true)->where('opsi_test_tps', false) as $mataPelajaran)
                        <th>{{ strtoupper($mataPelajaran->namaMataPelajaran) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 1;
                @endphp
                @foreach ($nilai as $tryoutId => $nilaiGroup)
                    <tr>
                        <td>{{ $index }}</td>
                        <td>{{ strtoupper($nilaiGroup->first()->tryout->nama_tryout) }}</td>
                        <td>{{ $nilaiGroup->first()->tryout->tahunPelajaran->nama_tahun_pelajaran }}</td>
                        <td>{{ $nilaiGroup->first()->tryout->tahunPelajaran->semester == 1 ? 'GANJIL' : 'GENAP' }}</td>
                        <!-- Nilai untuk mata pelajaran tanpa TPS dan tanpa kedinasan -->
                        @foreach ($mataPelajarans->where('opsi_test_tps', false)->where('opsi_kedinasan', false) as $mataPelajaran)
                            {{-- <td>{{ $nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai ?? '-' }}</td> --}}
                            <td>
                                {{ $nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first() ? number_format($nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai, 2) : '-' }}
                            </td>
                        @endforeach

                        <!-- Nilai untuk Tes Potensi Skolastik -->
                        @if ($statusKedinasan === 0 || $statusKedinasan === 2)
                            @foreach ($mataPelajarans->where('opsi_test_tps', true) as $mataPelajaran)
                                {{-- <td>{{ $nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai ?? '-' }}</td> --}}
                                <td>
                                    {{ $nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first() ? number_format($nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai, 2) : '-' }}
                                </td>
                            @endforeach
                        @endif

                        <!-- Nilai untuk Tes Kedinasan -->
                        @foreach ($mataPelajarans->where('opsi_kedinasan', true)->where('opsi_test_tps', false) as $mataPelajaran)
                            {{-- <td>{{ $nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai ?? '-' }}</td> --}}
                            <td>
                                {{ $nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first() ? number_format($nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai, 2) : '-' }}
                            </td>
                        @endforeach
                    </tr>
                    @php
                        $index++;
                    @endphp
                @endforeach
                @if ($nilai->isEmpty())
                    <tr>
                        <td colspan="{{ 4 + $mataPelajaransFalse->count() + $mataPelajaransTrue->count() }}"
                            class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="footer">
        <img src="{{ url('storage/' . $siswa->foto_siswa) }}" alt="Foto Siswa" style="width:100px; height: 120px">
    </div>
</body>

</html>
