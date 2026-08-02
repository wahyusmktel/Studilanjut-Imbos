@extends('admin.layouts.app')

@section('title', 'Data Absensi Siswa')

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Data Absensi Siswa</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="#">Absensi</a></li>
            <li class="active"><span>Data Absensi Siswa</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Header Controls: Actions + Excel Export -->
    <div class="modern-table-header">
        <div class="modern-table-actions">
            <button id="downloadExcelButton" class="btn-modern btn-modern-success">
                <i class="fa-solid fa-file-excel"></i>
                <span>Download Excel</span>
            </button>
        </div>
    </div>

    <!-- Filter Bar Flex Row -->
    <div style="padding: 20px 24px; background: #f8fafc; border-bottom: 1px solid var(--border-color);">
        <form method="GET" action="{{ route('admin.absensi.index') }}">
            <div style="display: flex; align-items: flex-end; gap: 16px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 150px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Mulai Tanggal</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        value="{{ request('start_date') }}" required>
                </div>
                <div style="flex: 1; min-width: 150px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Sampai Tanggal</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{ request('end_date') }}" required>
                </div>
                <div style="flex: 1.2; min-width: 180px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" class="form-control">
                        <option value="">-- Semua Mata Pelajaran --</option>
                        @foreach ($mataPelajarans as $mp)
                            <option value="{{ $mp->id }}" {{ request('mata_pelajaran_id') == $mp->id ? 'selected' : '' }}>
                                {{ $mp->namaMataPelajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="flex: 1.2; min-width: 180px;">
                    <label class="font-weight-600 small text-muted mb-1" style="display: block;">Kelompok / Kelas</label>
                    <select name="kelas_id" class="form-control">
                        <option value="">-- Semua Kelompok --</option>
                        @foreach ($kelases as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="flex: 0 0 auto;">
                    <button type="submit" class="btn-modern btn-modern-primary" style="height: 42px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Cari</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Absensi Siswa -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50" class="text-center" style="white-space: nowrap;">No</th>
                        <th style="min-width: 170px; white-space: nowrap;">Nama Siswa</th>
                        <th style="min-width: 130px; white-space: nowrap;">Kelompok</th>
                        <th style="min-width: 160px; white-space: nowrap;">Mata Pelajaran</th>
                        <th style="min-width: 160px; white-space: nowrap;">Guru Pengajar</th>
                        <th class="text-center" style="min-width: 140px; white-space: nowrap;">Tanggal & Waktu</th>
                        <th class="text-center" style="min-width: 130px; white-space: nowrap;">Kehadiran</th>
                        <th width="100" class="text-center" style="white-space: nowrap;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absensiDetails as $index => $detail)
                        <tr>
                            <td class="text-center font-weight-600" style="white-space: nowrap; vertical-align: middle;">{{ $absensiDetails->firstItem() + $index }}</td>
                            <td style="white-space: nowrap; vertical-align: middle;">
                                <span class="font-weight-600 color-primary">{{ $detail->siswa->nama_siswa ?? '-' }}</span>
                                <div class="text-muted small">NIS: {{ $detail->siswa->nisn ?? '-' }}</div>
                            </td>
                            <td style="white-space: nowrap; vertical-align: middle;">
                                <span class="badge-modern primary">
                                    {{ $detail->absensi->kelas->nama_kelas ?? '-' }}
                                </span>
                            </td>
                            <td style="white-space: nowrap; vertical-align: middle;">{{ $detail->absensi->guru->mataPelajaran->namaMataPelajaran ?? '-' }}</td>
                            <td style="white-space: nowrap; vertical-align: middle;">{{ $detail->absensi->guru->nama ?? '-' }}</td>
                            <td class="text-center" style="white-space: nowrap; vertical-align: middle;">
                                <div class="font-weight-600">{{ \Carbon\Carbon::parse($detail->absensi->tanggal)->format('d-m-Y') }}</div>
                                <div class="text-muted small">{{ $detail->absensi->waktu }}</div>
                            </td>
                            <td class="text-center" style="white-space: nowrap; vertical-align: middle;">
                                @if ($detail->kehadiran == 1)
                                    <span class="badge-modern success"><i class="fa-solid fa-circle-check mr-1"></i> Hadir</span>
                                @elseif($detail->kehadiran == 0)
                                    <span class="badge-modern danger"><i class="fa-solid fa-circle-xmark mr-1"></i> Tidak Hadir</span>
                                @elseif($detail->kehadiran == 2)
                                    <span class="badge-modern warning"><i class="fa-solid fa-user-doctor mr-1"></i> Sakit</span>
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap; vertical-align: middle;">
                                <div class="action-btn-group justify-content-center">
                                    <button type="button" class="btn-action btn-action-edit edit-button"
                                        data-id="{{ $detail->id }}"
                                        data-kehadiran="{{ $detail->kehadiran }}"
                                        data-toggle="tooltip" title="Edit Status Kehadiran">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <a href="{{ route('admin.absensi.detail', $detail->siswa_id) }}"
                                        class="btn-action btn-action-edit"
                                        data-toggle="tooltip" title="Detail Absensi Siswa">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <div class="empty-state">
                                    <i class="fa-solid fa-calendar-xmark fa-2x mb-2"></i>
                                    <p>Belum ada data absensi siswa yang ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Table Footer / Pagination -->
    <div class="modern-table-header border-top" style="border-bottom: none; background: #fafafa;">
        <div class="text-muted small">
            @if(method_exists($absensiDetails, 'total'))
                Menampilkan {{ $absensiDetails->firstItem() ?? 0 }} - {{ $absensiDetails->lastItem() ?? 0 }} dari {{ $absensiDetails->total() }} data
            @endif
        </div>
        <div>
            {{ $absensiDetails->appends(['start_date' => request('start_date'), 'end_date' => request('end_date'), 'mata_pelajaran_id' => request('mata_pelajaran_id'), 'kelas_id' => request('kelas_id')])->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>

<!-- Modal Edit Absensi -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: var(--radius-md);">
            <div class="modal-header bg-primary text-white" style="border-top-left-radius: var(--radius-md); border-top-right-radius: var(--radius-md);">
                <h5 class="modal-title text-white font-weight-600" id="editModalLabel">
                    <i class="fa-solid fa-user-pen mr-2"></i>Edit Status Kehadiran
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST" action="{{ route('admin.absensi.update') }}">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group mb-0">
                        <label for="editKehadiran" class="font-weight-600">Status Kehadiran</label>
                        <select class="form-control" id="editKehadiran" name="kehadiran" required>
                            <option value="1">Hadir</option>
                            <option value="0">Tidak Hadir</option>
                            <option value="2">Sakit</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-bottom-left-radius: var(--radius-md); border-bottom-right-radius: var(--radius-md);">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Download Excel button validation
    const downloadBtn = document.getElementById('downloadExcelButton');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function(event) {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;

            if (!startDate || !endDate) {
                event.preventDefault();
                swal({
                    title: "Peringatan!",
                    text: "Harap memilih rentang tanggal awal dan akhir terlebih dahulu.",
                    type: "warning",
                    confirmButtonText: "OK"
                });
            } else {
                var mataPelajaranId = document.querySelector('select[name="mata_pelajaran_id"]').value;
                var kelasId = document.querySelector('select[name="kelas_id"]').value;

                var url = "{{ route('admin.absensi.export') }}" + "?start_date=" + startDate + "&end_date=" +
                    endDate + "&mata_pelajaran_id=" + mataPelajaranId + "&kelas_id=" + kelasId;
                window.location.href = url;
            }
        });
    }

    // Modal Edit Handler
    $('.edit-button').on('click', function() {
        var id = $(this).data('id');
        var kehadiran = $(this).data('kehadiran');
        $('#editId').val(id);
        $('#editKehadiran').val(kehadiran);
        $('#editModal').modal('show');
    });
});
</script>
@endsection
