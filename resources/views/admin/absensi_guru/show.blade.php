@extends('admin.layouts.app')

@section('title', 'Detail Absensi Guru - ' . $absensi->guru->nama)

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Detail Absensi Guru - {{ $absensi->guru->nama }}</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.absensi-guru.index') }}">Data Absensi Guru</a></li>
            <li class="active"><span>{{ $absensi->guru->nama }}</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Teacher Hero Header Card -->
<div class="student-hero-card mb-4">
    <div class="student-hero-profile">
        <div class="student-hero-avatar">
            {{ strtoupper(substr($absensi->guru->nama, 0, 1)) }}
        </div>
        <div class="student-hero-info">
            <h2 class="student-hero-name">{{ $absensi->guru->nama }}</h2>
            <div class="student-hero-meta">
                <span><i class="fa-solid fa-book-open mr-1"></i> {{ $absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}</span>
                <span class="badge-modern primary">
                    <i class="fa-solid fa-users mr-1"></i> {{ $absensi->kelas->nama_kelas ?? '-' }}
                </span>
            </div>
        </div>
    </div>
    <div class="student-hero-actions">
        <a href="{{ route('admin.absensi-guru.index') }}" class="btn-modern btn-modern-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>
</div>

<!-- Modern Detail Card -->
<div class="modern-card mb-4">
    <div class="modern-card-header">
        <h3 class="modern-card-title">
            <i class="fa-solid fa-circle-info color-primary mr-2"></i>Rincian Sesi Kehadiran Guru
        </h3>
    </div>
    <div class="modern-card-body p-0">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelompok / Kelas</th>
                            <th class="text-center">Tanggal Sesi</th>
                            <th class="text-center">Waktu Sesi</th>
                            <th>Catatan</th>
                            <th class="text-center">Foto Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="font-weight-600 color-primary">{{ $absensi->guru->nama }}</span>
                            </td>
                            <td>{{ $absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}</td>
                            <td>
                                <span class="badge-modern primary">
                                    {{ $absensi->kelas->nama_kelas ?? '-' }}
                                </span>
                            </td>
                            <td class="text-center font-weight-600">
                                {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}
                            </td>
                            <td class="text-center text-muted font-weight-600">{{ $absensi->waktu }}</td>
                            <td>{{ $absensi->catatan ?: '-' }}</td>
                            <td class="text-center">
                                @if($absensi->foto)
                                    <button type="button" class="btn-modern btn-modern-primary btn-sm view-photo" data-photo="{{ asset('storage/' . $absensi->foto) }}">
                                        <i class="fa-solid fa-image mr-1"></i> Lihat Foto
                                    </button>
                                @else
                                    <span class="text-muted small"><i class="fa-solid fa-image-slash mr-1"></i> Tidak Ada Foto</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Foto Absensi -->
<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: var(--radius-md);">
            <div class="modal-header bg-primary text-white" style="border-top-left-radius: var(--radius-md); border-top-right-radius: var(--radius-md);">
                <h5 class="modal-title text-white font-weight-600" id="photoModalLabel">
                    <i class="fa-solid fa-camera mr-2"></i>Foto Bukti Absensi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-4">
                <img id="photoModalImg" src="" class="img-fluid rounded shadow-sm" alt="Foto Absensi" style="max-height: 500px; object-fit: contain;">
            </div>
            <div class="modal-footer bg-light" style="border-bottom-left-radius: var(--radius-md); border-bottom-right-radius: var(--radius-md);">
                <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('.view-photo').on('click', function() {
        var photoUrl = $(this).data('photo');
        $('#photoModalImg').attr('src', photoUrl);
        $('#photoModal').modal('show');
    });
});
</script>
@endsection
