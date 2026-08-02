<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi Detail</title>
</head>
<body>
    <h2>LAPORAN KEHADIRAN ABSENSI BIMBEL SISWA</h2>
    <p>Laporan data dari tanggal {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} sampai {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</p>
    <p>Nama Siswa: {{ $siswa->nama_siswa }}</p>
    <p>Kelompok: {{ $siswa->kelas->nama_kelas }}</p>
    <p>Program Bimbel: {{ $siswa->programBimbel->nama_program }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Tanggal</th>
                {{-- <th>Waktu</th> --}}
                <th>Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensiDetails as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->absensi->guru->mataPelajaran->namaMataPelajaran }}</td>
                <td>{{ $detail->absensi->guru->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($detail->absensi->tanggal)->format('d-m-Y') }}</td>
                {{-- <td>{{ $detail->absensi->waktu }}</td> --}}
                <td>
                    @if($detail->kehadiran == 1)
                        Hadir
                    @elseif($detail->kehadiran == 0)
                        Tidak Hadir
                    @elseif($detail->kehadiran == 2)
                        Sakit
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Jumlah Kehadiran: {{ $absensiDetails->where('kehadiran', 1)->count() }}</p>
    <p>Jumlah Ketidakhadiran: {{ $absensiDetails->where('kehadiran', 0)->count() }}</p>
    <p>Jumlah Sakit: {{ $absensiDetails->where('kehadiran', 2)->count() }}</p>
</body>
</html>
