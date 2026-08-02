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
            <div class="panel panel-default border-panel card-view">
                <div class="panel-heading">

                    <div class="row">
                        <div class="col-md-8 col-xs-6">
                            <h6 class="panel-title txt-dark">Data Komentar</h6>
                        </div>
                        {{-- <div class="col-md-4 col-xs-6 text-right">
                            <a href="{{ route('admin.nilai-siswa.index') }}" class="btn btn-default"><i
                                    class="fa fa-arrow-left"></i> Kembali</a>
                        </div> --}}
                    </div>

                </div>
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Berita</th>
                                        <th>Nama Komentator</th>
                                        {{-- <th>Isi Komentar</th> --}}
                                        <th>Status</th>
                                        <th>Tanggapan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($komentars as $index => $komentar)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $komentar->berita->judul_berita }}</td>
                                            <td>{{ $komentar->nama_komentator }}</td>
                                            {{-- <td>{{ $komentar->isi_komentar }}</td> --}}
                                            <td>{{ $komentar->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                            <td>
                                                @if ($komentar->tanggapan->isNotEmpty())
                                                    <a
                                                        href="{{ route('admin.tanggapan.index', ['komentar_id' => $komentar->id]) }}"><i class="fa fa-external-link"></i> Lihat
                                                        Tanggapan</a>
                                                @else
                                                    Belum ada tanggapan
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Tombol Tanggapan -->
                                                <button class="btn btn-primary btn-sm tanggapan-btn"
                                                    data-id="{{ $komentar->id }}" data-toggle="modal"
                                                    data-target="#tanggapanModal"><i class="fa fa-wechat"></i> Tanggapan</button>
                                                <button class="btn btn-info btn-sm detail-btn" data-id="{{ $komentar->id }}"
                                                    data-nama="{{ $komentar->nama_komentator }}"
                                                    data-isi="{{ $komentar->isi_komentar }}" data-toggle="modal"
                                                    data-target="#detailModal"><i class="fa fa-info-circle"></i> Detail</button>
                                                <button class="btn btn-danger btn-sm delete-komentar"
                                                    data-id="{{ $komentar->id }}"><i class="fa fa-trash"></i> Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
