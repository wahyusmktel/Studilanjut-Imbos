@extends('admin.layouts.app')

@section('title', 'Data Komentar')

@section('content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Komentar</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="active"><span>Komentar</span></li>
            </ol>
        </div>
    </div>
    <!-- /Title -->
    <div class="row">
        <div class="col-md-12">
            <div class="modern-card modern-table-card">
                <div class="modern-card-header" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 24px;">
                    <div>
                        <h3 class="modern-card-title" style="margin: 0; font-size: 18px; font-weight: 600; color: var(--text-primary);">Data Komentar</h3>
                    </div>
                </div>
                <div class="modern-card-body" style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table modern-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Judul Berita</th>
                                    <th>Nama Komentator</th>
                                    <th>Status</th>
                                    <th>Tanggapan</th>
                                    <th style="width: 250px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($komentars as $index => $komentar)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="font-weight: 500; color: var(--text-primary);">{{ $komentar->berita->judul_berita }}</td>
                                        <td>{{ $komentar->nama_komentator }}</td>
                                        <td>
                                            @if($komentar->status)
                                                <span class="badge-modern success">Aktif</span>
                                            @else
                                                <span class="badge-modern" style="background: #fee2e2; color: #ef4444;">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($komentar->tanggapan->isNotEmpty())
                                                <a href="{{ route('admin.tanggapan.index', ['komentar_id' => $komentar->id]) }}" style="color: var(--primary); font-weight: 500;">
                                                    <i class="fa fa-external-link"></i> Lihat Tanggapan
                                                </a>
                                            @else
                                                <span style="color: var(--text-muted); font-size: 13px;">Belum ada tanggapan</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; justify-content: center; gap: 8px;">
                                                <button class="btn btn-sm tanggapan-btn" style="background: #eef2ff; color: var(--primary); border: none; border-radius: 6px; padding: 6px 10px;"
                                                    data-id="{{ $komentar->id }}" data-toggle="modal"
                                                    data-target="#tanggapanModal" title="Tanggapan">
                                                    <i class="fa fa-reply"></i>
                                                </button>
                                                <button class="btn btn-sm detail-btn" style="background: #f1f5f9; color: var(--text-secondary); border: none; border-radius: 6px; padding: 6px 10px;"
                                                    data-id="{{ $komentar->id }}"
                                                    data-nama="{{ $komentar->nama_komentator }}"
                                                    data-isi="{{ $komentar->isi_komentar }}" data-toggle="modal"
                                                    data-target="#detailModal" title="Detail">
                                                    <i class="fa fa-info-circle"></i>
                                                </button>
                                                <button class="btn btn-sm delete-komentar" style="background: #fee2e2; color: var(--danger); border: none; border-radius: 6px; padding: 6px 10px;"
                                                    data-id="{{ $komentar->id }}" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($komentars->isEmpty())
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty-state" style="padding: 40px 20px; text-align: center;">
                                                <i class="fa fa-comments-o" style="font-size: 48px; color: var(--text-muted); margin-bottom: 16px;"></i>
                                                <p style="color: var(--text-secondary); margin: 0;">Data komentar belum tersedia.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tanggapan -->
    <div id="tanggapanModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="tanggapanForm" method="POST" action="{{ route('admin.tanggapan.store') }}">
                    @csrf
                    <input type="hidden" name="komentar_id" id="komentar_id">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Tanggapan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="isi_tanggapan">Isi Tanggapan</label>
                            <textarea class="form-control" id="isi_tanggapan" name="isi_tanggapan" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.tanggapan-btn').on('click', function() {
                var komentarId = $(this).data('id');
                $('#komentar_id').val(komentarId);
            });
        });
    </script>

    <!-- Detail Modal -->
    <div id="detailModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Komentar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="detail_nama">Nama Komentator</label>
                        <input type="text" class="form-control" id="detail_nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detail_isi">Isi Komentar</label>
                        <textarea class="form-control" id="detail_isi" rows="3" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.detail-btn').on('click', function() {
                var nama = $(this).data('nama');
                var isi = $(this).data('isi');
                $('#detail_nama').val(nama);
                $('#detail_isi').val(isi);
            });
        });
    </script>

    <script>
        $('.delete-komentar').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Apakah Anda yakin?",
                text: "Menghapus data komentar ini!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f83f37",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batalkan",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '{{ url('admin/komentar') }}/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(result) {
                            swal({
                                title: "Dihapus!",
                                text: "Data komentar berhasil dihapus.",
                                type: "success",
                                confirmButtonText: "OK"
                            }, function() {
                                location.reload();
                            });
                        },
                        error: function() {
                            swal("Error!", "Terjadi kesalahan saat menghapus data.", "error");
                        }
                    });
                } else {
                    swal("Dibatalkan", "Data komentar tetap aman :)", "error");
                }
            });
        });
    </script>
@endsection
