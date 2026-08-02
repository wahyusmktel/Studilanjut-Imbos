<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Absensi Guru</title>
</head>
<body>
    <table>
        <tr>
            <td colspan="6" style="font-weight: bold;">Laporan Absensi Kehadiran Guru</td>
        </tr>
        <tr>
            <td colspan="6">Laporan data dari tanggal {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} sampai {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</td>
        </tr>
        @if($guru)
            <tr>
                <td colspan="6">Nama Guru: {{ $guru->nama }}</td>
            </tr>
            <tr>
                <td colspan="6">Mata Pelajaran: {{ $guru->mataPelajaran->namaMataPelajaran }}</td>
            </tr>
        @endif
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Guru</th>
            <th>Mata Pelajaran</th>
            <th>Kelompok</th>
            <th>Tanggal</th>
            {{-- <th>Waktu</th> --}}
            <th>Catatan</th>
        </tr>
        @foreach($absensiData as $index => $absensi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $absensi->guru->nama }}</td>
                <td>{{ $absensi->guru->mataPelajaran->namaMataPelajaran }}</td>
                <td>{{ $absensi->kelas->nama_kelas }}</td>
                <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                {{-- <td>{{ $absensi->waktu }}</td> --}}
                <td>{{ $absensi->catatan }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="font-weight: bold;">Jumlah Kehadiran: {{ $absensiData->count() }}</td>
        </tr>
    </table>
</body>
</html>
