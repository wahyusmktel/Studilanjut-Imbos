@extends('admin.layouts.app')

@section('title', 'Data Berita')

@section('content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Berita</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="active"><span>Berita</span></li>
            </ol>
        </div>
    </div>
    <!-- /Title -->

    <div class="row">
        <div class="col-md-12">
            <div class="modern-card modern-table-card">
                <div class="modern-card-header" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 24px;">
                    <div>
                        <h3 class="modern-card-title" style="margin: 0; font-size: 18px; font-weight: 600; color: var(--text-primary);">Daftar Berita</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm" style="display: flex; align-items: center; gap: 8px;">
                            <i class="fa fa-plus"></i> Tambah Berita
                        </a>
                    </div>
                </div>
                <div class="modern-card-body" style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table modern-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Judul Berita</th>
                                    <th>Kategori</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th style="width: 150px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beritas as $index => $berita)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div style="font-weight: 500; color: var(--text-primary); margin-bottom: 4px;">{{ $berita->judul_berita }}</div>
                                            <div style="font-size: 12px; color: var(--text-muted);">{{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}</div>
                                        </td>
                                        <td><span class="badge-modern primary">{{ $berita->kategori->nama_kategori ?? 'Umum' }}</span></td>
                                        <td>{{ $berita->author->name }}</td>
                                        <td>
                                            @if($berita->status)
                                                <span class="badge-modern success">Aktif</span>
                                            @else
                                                <span class="badge-modern" style="background: #fee2e2; color: #ef4444;">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; justify-content: center; gap: 8px;">
                                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm" style="background: #f1f5f9; color: var(--primary); border: none; border-radius: 6px; padding: 6px 10px;" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="btn btn-sm delete-berita" style="background: #fee2e2; color: var(--danger); border: none; border-radius: 6px; padding: 6px 10px;" data-id="{{ $berita->id }}" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($beritas->isEmpty())
                                    <tr>
                                        <td colspan="6">
                                            <div class="empty-state" style="padding: 40px 20px; text-align: center;">
                                                <i class="fa fa-newspaper-o" style="font-size: 48px; color: var(--text-muted); margin-bottom: 16px;"></i>
                                                <p style="color: var(--text-secondary); margin: 0;">Data berita belum tersedia.</p>
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

    @if (session('success'))
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    swal({
                        title: "Success!",
                        text: "{{ session('success') }}",
                        type: "success",
                        confirmButtonText: "OK"
                    });
                }, 1000);
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.delete-berita').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Apakah Anda yakin?",
                    text: "Menghapus berita ini tidak bisa dibatalkan!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Tidak, batalkan",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '{{ url('admin/berita') }}/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(result) {
                                swal({
                                    title: "Dihapus!",
                                    text: "Berita berhasil dihapus.",
                                    type: "success",
                                    confirmButtonText: "OK"
                                }, function() {
                                    location.reload();
                                });
                            },
                            error: function() {
                                swal("Error!",
                                    "Terjadi kesalahan saat menghapus berita.",
                                    "error");
                            }
                        });
                    } else {
                        swal("Dibatalkan", "Berita tetap aman :)", "error");
                    }
                });
            });
        });
    </script>
@endsection
