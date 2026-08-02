@extends('layouts.app')

@section('title', 'Dashboard Pantau Orang Tua')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        @include('includes.menu_mobile_app')

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(246, 197, 6, 0.2)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(246, 197, 6, 100)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#0b7ac2">
            </g>
        </svg>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="features" class="features section">
        <!-- Section Title -->
        <div class="container section-title-white" data-aos="fade-up">
            <h2>Dashboard</h2>
            <p>Perkembangan Studi Lanjut Siswa IMBOS</p>

            @if ($tahunPelajaranAktif)
                <!-- <h2>Tahun Pelajaran Aktif: {{ $tahunPelajaranAktif->nama_tahun_pelajaran }} (Semester
                    {{ $tahunPelajaranAktif->semester == 1 ? 'Ganjil' : 'Genap' }})</h2> -->
                <h2>Tahun Pelajaran Aktif: {{ $tahunPelajaranAktif->nama_tahun_pelajaran }}</h2>
            @else
                <h2>Tahun Pelajaran Aktif: Tidak Ditemukan</h2>
            @endif

        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $siswa->nama_siswa }}</h3>
                    </div>
                    <div class="panel-content panel-about">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <div class="img-profile">
                                            @if ($siswa->foto_siswa)
                                                <img src="{{ asset('storage/' . $siswa->foto_siswa) }}" alt="Profile">
                                            @else
                                                <img src="https://placehold.co/400x600/png" alt="Profile">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8 mt-2">
                                        <table class="table table-profil">
                                            <tr>
                                                <th style="text-align: left;">Nama</th>
                                                <td>{{ $siswa->nama_siswa }}</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left;">Kelompok</th>
                                                {{-- PERBAIKAN: Gunakan nullsafe operator (?->) dan null coalescing (??) untuk mencegah error jika kelas tidak ada --}}
                                                <td>{{ $siswa->kelas?->nama_kelas ?? 'Kelas tidak ditemukan' }}</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left;">Program Bimbel</th>
                                                {{-- PERBAIKAN: Lakukan hal yang sama untuk program bimbel --}}
                                                <td>{{ $siswa->programBimbel?->nama_program ?? 'Program tidak ditemukan' }}
                                                </td>
                                            </tr>
                                        </table>
                                        <a href="/orang-tua/absensi/detail" class="btn btn-warning btn-sm"
                                            style="padding: 8px;">LIHAT ABSENSI PERKEMBANGAN SISWA</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- PERBAIKAN: Hanya tampilkan chart jika ada data nilai --}}
                                @if (!$nilai->isEmpty())
                                    <canvas id="nilaiChart"></canvas>
                                @else
                                    <div class="text-center" style="padding-top: 50px;">
                                        <p>Grafik akan muncul setelah nilai Try Out diinput.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="content-title-custom-1">
                            <p>Tabel Perkembangan Nilai TryOut Siswa</p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Try Out</th>
                                                <th rowspan="2">Tahun Pelajaran</th>
                                                {{-- <th rowspan="2">Semester</th> --}}

                                                <!-- Tampilkan mata pelajaran yang tidak termasuk TPS dan tidak kedinasan -->
                                                @foreach ($mataPelajarans->where('opsi_test_tps', false)->where('opsi_kedinasan', false) as $mataPelajaran)
                                                    <th rowspan="2">{{ $mataPelajaran->namaMataPelajaran }}</th>
                                                @endforeach

                                                <!-- Kondisi untuk menampilkan kolom "Tes Potensi Skolastik" -->
                                                @if ($statusKedinasan === 0 || $statusKedinasan === 2)
                                                    <th
                                                        colspan="{{ $mataPelajarans->where('opsi_test_tps', true)->count() }}">
                                                        Tes Potensi Skolastik</th>
                                                @endif

                                                <!-- Kondisi untuk menampilkan kolom "Tes Kedinasan" -->
                                                @if ($mataPelajarans->where('opsi_kedinasan', true)->where('opsi_test_tps', false)->count() > 0)
                                                    <th
                                                        colspan="{{ $mataPelajarans->where('opsi_kedinasan', true)->where('opsi_test_tps', false)->count() }}">
                                                        Tes Kedinasan</th>
                                                @endif

                                                <th rowspan="2">Aksi</th>
                                            </tr>
                                            <tr>
                                                <!-- Kolom untuk Tes Potensi Skolastik -->
                                                @if ($statusKedinasan === 0 || $statusKedinasan === 2)
                                                    @foreach ($mataPelajarans->where('opsi_test_tps', true) as $mataPelajaran)
                                                        <th>{{ $mataPelajaran->namaMataPelajaran }}</th>
                                                    @endforeach
                                                @endif

                                                <!-- Kolom untuk Tes Kedinasan -->
                                                @foreach ($mataPelajarans->where('opsi_kedinasan', true)->where('opsi_test_tps', false) as $mataPelajaran)
                                                    <th>{{ $mataPelajaran->namaMataPelajaran }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- PERBAIKAN: Gunakan @forelse untuk menangani kasus jika tidak ada nilai --}}
                                            @forelse ($nilai as $tryoutId => $nilaiGroup)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    {{-- PERBAIKAN: Tambahkan nullsafe operator untuk keamanan --}}
                                                    <td>{{ $nilaiGroup->first()->tryout?->nama_tryout }}</td>
                                                    <td>{{ $nilaiGroup->first()->tryout?->tahunPelajaran?->nama_tahun_pelajaran }}
                                                    </td>
                                                    {{-- <td>{{ $nilaiGroup->first()->tryout?->tahunPelajaran?->semester == 1 ? 'Ganjil' : 'Genap' }}
                                                    </td> --}}

                                                    <!-- Nilai untuk mata pelajaran tanpa TPS dan tanpa kedinasan -->
                                                    @foreach ($mataPelajarans->where('opsi_test_tps', false)->where('opsi_kedinasan', false) as $mataPelajaran)
                                                        <td>{{ $nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first() ? number_format($nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai, 2) : '-' }}
                                                        </td>
                                                    @endforeach

                                                    <!-- Nilai untuk Tes Potensi Skolastik -->
                                                    @if ($statusKedinasan === 0 || $statusKedinasan === 2)
                                                        @foreach ($mataPelajarans->where('opsi_test_tps', true) as $mataPelajaran)
                                                            <td>{{ $nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first() ? number_format($nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai, 2) : '-' }}
                                                            </td>
                                                        @endforeach
                                                    @endif

                                                    <!-- Nilai untuk Tes Kedinasan -->
                                                    @foreach ($mataPelajarans->where('opsi_kedinasan', true)->where('opsi_test_tps', false) as $mataPelajaran)
                                                        <td>{{ $nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first() ? number_format($nilaiGroup->where('mata_pelajaran_id', $mataPelajaran->id)->first()->nilai, 2) : '-' }}
                                                        </td>
                                                    @endforeach

                                                    <td>
                                                        <a href="{{ route('parent.downloadSertifikatTryout', ['id' => $siswa->id, 'tryout_id' => $tryoutId]) }}"
                                                            class="btn btn-primary">Download Sertifikat</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    {{-- PERBAIKAN: Hitung colspan secara dinamis dan aman --}}
                                                    <td colspan="{{ 5 + $mataPelajarans->count() }}" class="text-center">
                                                        Data nilai untuk tahun pelajaran aktif tidak ditemukan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if (!$nilai->isEmpty())
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <div class="text-center">
                                        <a href="{{ route('parent.downloadSertifikat', $siswa->id) }}"
                                            class="btn btn-warning">
                                            <span>Download Rapor Perkembangan Bimbel</span>
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About Section -->

    {{-- PERBAIKAN: Bungkus script Chart.js dalam @if untuk mencegah error jika $nilai kosong --}}
    @if (!$nilai->isEmpty())
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('nilaiChart').getContext('2d');
                const labels = {!! json_encode($nilai->map(fn($group) => $group->first()->tryout?->nama_tryout)->values()) !!};
                const datasets = {!! $mataPelajarans->map(function ($mp) use ($nilai) {
                        return [
                            'label' => $mp->namaMataPelajaran,
                            'data' => $nilai->map(fn($group) => $group->where('mata_pelajaran_id', $mp->id)->first()->nilai ?? 0)->values(),
                            'borderColor' => 'randomColor()',
                            'backgroundColor' => 'rgba(0, 0, 0, 0)',
                            'pointStyle' => 'circle',
                            'pointRadius' => 5,
                            'pointHoverRadius' => 7,
                        ];
                    })->values()->toJson() !!};

                datasets.forEach(dataset => {
                    dataset.borderColor = randomColor();
                });

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Nilai'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Try Out'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Grafik Perkembangan Nilai Siswa'
                            }
                        }
                    }
                });

                function randomColor() {
                    const letters = '0123456789ABCDEF';
                    let color = '#';
                    for (let i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
            });
        </script>
    @endif

@endsection
