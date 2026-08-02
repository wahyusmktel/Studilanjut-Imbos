@extends('admin.layouts.app')

@section('title', 'Detail Nilai Siswa')

@section('content')
<!-- Title Breadcrumb -->
<div class="row heading-bg">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Detail Nilai Siswa</h5>
    </div>
    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.nilai-siswa.index') }}">Nilai Siswa</a></li>
            <li class="active"><span>Detail Nilai</span></li>
        </ol>
    </div>
</div>
<!-- /Title Breadcrumb -->

<!-- Student Info Card Header -->
<div class="student-hero-card">
    <div class="student-hero-profile">
        @if($siswa->foto)
            <div class="student-hero-avatar">
                <img src="{{ asset('storage/' . $siswa->foto) }}" alt="{{ $siswa->nama_siswa }}">
            </div>
        @else
            <div class="student-hero-avatar">
                {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
            </div>
        @endif
        <div class="student-hero-info">
            <h3 class="student-hero-name">{{ $siswa->nama_siswa }}</h3>
            <div class="student-hero-meta">
                @if($siswa->nis)
                    <span class="user-subtext"><i class="fa-solid fa-id-card"></i> NIS: <strong>{{ $siswa->nis }}</strong></span>
                @endif
                <span class="badge-modern primary"><i class="fa-solid fa-sitemap mr-5"></i>{{ $siswa->kelas ? $siswa->kelas->nama_kelas : '-' }}</span>
                @if($siswa->programBimbel)
                    <span class="badge-modern success"><i class="fa-solid fa-graduation-cap mr-5"></i>{{ $siswa->programBimbel->nama_program }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="student-hero-actions">
        <a href="#" id="downloadSertifikat" class="btn-modern btn-modern-primary">
            <i class="fa-solid fa-file-pdf"></i>
            <span>Download Sertifikat</span>
        </a>
        <a href="{{ route('admin.nilai-siswa.index') }}" class="btn-modern btn-modern-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>
</div>

<!-- Main Table Card -->
<div class="modern-table-card">
    <!-- Filter Bar Header -->
    <div class="modern-filter-bar">
        <form method="GET" action="{{ route('admin.nilai.detail', $siswa->id) }}">
            <div class="modern-filter-grid">
                <div class="form-group mb-0">
                    <label for="tahun_pelajaran_id" class="font-weight-600">Tahun Pelajaran (Aktif)</label>
                    <input type="text" class="form-control"
                        value="{{ $tahunPelajaranAktif ? $tahunPelajaranAktif->nama_tahun_pelajaran . ' - Semester ' . $tahunPelajaranAktif->semester : 'Tidak ada tahun aktif' }}"
                        readonly style="background: #ffffff; font-weight: 600; color: #475569;">
                    <input type="hidden" id="tahun_pelajaran_id" name="tahun_pelajaran_id" value="{{ $tahunPelajaranAktif ? $tahunPelajaranAktif->id : '' }}">
                </div>
                <div class="form-group mb-0">
                    <label for="tryout_id" class="font-weight-600">Filter Berdasarkan Try Out</label>
                    <select class="form-control" id="tryout_id" name="tryout_id">
                        <option value="">-- Semua Try Out --</option>
                        @foreach ($tryouts as $tryout)
                            <option value="{{ $tryout->id }}" {{ $tryout->id == $tryoutId ? 'selected' : '' }}>
                                {{ $tryout->nama_tryout }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn-modern btn-modern-primary" style="height: 42px; padding: 0 24px;">
                        <i class="fa-solid fa-filter"></i>
                        <span>Terapkan Filter</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Score Detail Table -->
    <div class="table-wrap">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th>Mata Pelajaran</th>
                        <th>Try Out</th>
                        <th>Tahun Pelajaran</th>
                        <th class="text-center">Semester</th>
                        <th class="text-center">Nilai</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa->nilais as $index => $nilai)
                    <tr>
                        <td class="text-center font-weight-600">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-10">
                                <span class="badge-modern primary"><i class="fa-solid fa-book-open"></i></span>
                                <span class="font-weight-600 color-primary">{{ $nilai->mataPelajaran?->namaMataPelajaran ?? 'Mapel Dihapus' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge-modern success">
                                <i class="fa-solid fa-flag-checkered mr-5"></i>{{ $nilai->tryout?->nama_tryout ?? 'Tryout Dihapus' }}
                            </span>
                        </td>
                        <td>
                            <span class="text-muted font-weight-600">{{ $nilai->tryout?->tahunPelajaran?->nama_tahun_pelajaran ?? '-' }}</span>
                        </td>
                        <td class="text-center">
                            <code style="background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 6px; font-weight: 700;">Semester {{ $nilai->tryout?->tahunPelajaran?->semester ?? '-' }}</code>
                        </td>
                        <td class="text-center">
                            <span class="badge-modern primary" style="font-size: 14px; font-weight: 700; padding: 6px 14px;">
                                {{ number_format($nilai->nilai, 2) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-btn-group justify-content-center">
                                <a href="#" class="btn-action btn-action-edit edit-button" 
                                   data-id="{{ $nilai->id }}" 
                                   data-nilai="{{ $nilai->nilai }}"
                                   data-toggle="tooltip" 
                                   title="Edit Nilai"> 
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> 
                                <a href="#" class="btn-action btn-action-delete delete-button" 
                                   data-id="{{ $nilai->id }}" 
                                   data-toggle="tooltip" 
                                   title="Hapus Nilai"> 
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <div class="empty-state">
                                <i class="fa-solid fa-chart-bar fa-2x mb-2"></i>
                                <p>Belum ada data nilai untuk siswa ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Data Nilai -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editForm" action="" method="POST">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="editModalLabel"><i class="fa-solid fa-pen-to-square mr-8 text-primary"></i> Edit Data Nilai</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0">
                        <label for="editNilai">Skor / Nilai Siswa</label>
                        <input type="number" step="0.01" min="0" max="1000" class="form-control" id="editNilai" name="nilai" placeholder="Masukkan Skor Nilai" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modern btn-modern-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session('success'))
<script>
    $(document).ready(function() {
        setTimeout(function() {
            swal({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                type: "success",
                confirmButtonText: "OK"
            });
        }, 500);
    });
</script>
@endif

<script>
    $(document).ready(function() {
        var filterApplied = new URLSearchParams(window.location.search).has('tahun_pelajaran_id') &&
            new URLSearchParams(window.location.search).has('tryout_id');

        $('#tahun_pelajaran_id').change(function() {
            var tahunPelajaranId = $(this).val();
            if (tahunPelajaranId) {
                $.ajax({
                    url: '/admin/nilai/getTryouts',
                    type: 'GET',
                    data: {
                        tahun_pelajaran_id: tahunPelajaranId
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#tryout_id').empty();
                        $('#tryout_id').append('<option value="">-- Pilih Try Out --</option>');
                        $.each(data, function(key, value) {
                            $('#tryout_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#tryout_id').empty().append('<option value="">-- Pilih Try Out --</option>');
            }
        });

        $('#downloadSertifikat').click(function(e) {
            var tahunPelajaranId = $('#tahun_pelajaran_id').val();
            var tryoutId = $('#tryout_id').val();
            if (!tahunPelajaranId || !tryoutId) {
                e.preventDefault();
                swal("Peringatan!", "Silakan pilih Try Out terlebih dahulu pada filter di atas.", "warning");
            } else if (!filterApplied) {
                e.preventDefault();
                swal("Peringatan!", "Silakan klik tombol Filter terlebih dahulu untuk memuat data sertifikat.", "warning");
            } else {
                var url = "{{ route('admin.nilai.downloadSertifikat', ['id' => $siswa->id, 'tahun_pelajaran_id' => '__tahun_pelajaran_id__', 'tryout_id' => '__tryout_id__']) }}";
                url = url.replace('__tahun_pelajaran_id__', tahunPelajaranId).replace('__tryout_id__', tryoutId);
                window.location.href = url;
            }
        });

        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Apakah Anda Yakin?",
                text: "Data nilai mata pelajaran ini akan dihapus dari record siswa!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/admin/nilai-detail/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(result) {
                            swal({
                                title: "Terhapus!",
                                text: result.success || "Nilai mata pelajaran berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan saat menghapus nilai.", "error");
                        }
                    });
                }
            });
        });

        $('.edit-button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var nilai = $(this).data('nilai');
            $('#editNilai').val(nilai);
            $('#editForm').attr('action', '/admin/nilai/' + id);
            $('#editModal').modal('show');
        });
    });
</script>
@endsection
