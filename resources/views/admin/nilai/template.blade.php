<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>TryOut</th>
            @foreach ($mataPelajarans as $mataPelajaran)
                <th>{{ $mataPelajaran->kode_mapel }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($siswas as $index => $siswa)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>{{ $tryout->nama_tryout }}</td>
                @foreach ($mataPelajarans as $mataPelajaran)
                    <td></td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
