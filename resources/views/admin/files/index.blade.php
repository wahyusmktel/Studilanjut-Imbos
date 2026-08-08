@extends('admin.layouts.app')

@section('title', 'Files')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
            <h5 class="txt-dark">File Manager</h5>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active"><span>Files</span></li>
            </ol>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="modern-card">
                <div class="modern-card-header" style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
                    <div>
                        <h3 class="modern-card-title" style="margin:0;">Storage Public</h3>
                        <p style="margin:6px 0 0; color:var(--text-secondary);">File yang diupload dapat digunakan melalui URL <code>/storage/...</code>.</p>
                    </div>
                    <div style="display:flex; gap:8px; flex-wrap:wrap;">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                            <i class="fa-solid fa-upload"></i> Upload File
                        </button>
                        <button class="btn btn-default" data-toggle="modal" data-target="#folderModal">
                            <i class="fa-solid fa-folder-plus"></i> Folder Baru
                        </button>
                    </div>
                </div>

                <div class="modern-card-body" style="padding:20px;">
                    <div style="display:flex; gap:8px; flex-wrap:wrap; align-items:center; margin-bottom:20px;">
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if (!$loop->first)<span style="color:var(--text-secondary);">/</span>@endif
                            <a href="{{ route('admin.files.index', ['path' => $breadcrumb['path']]) }}" class="btn btn-xs {{ $loop->last ? 'btn-primary' : 'btn-default' }}">
                                <i class="fa-solid {{ $loop->first ? 'fa-house' : 'fa-folder' }}"></i> {{ $breadcrumb['name'] }}
                            </a>
                        @endforeach
                    </div>

                    @if (count($directories) === 0 && count($files) === 0)
                        <div style="padding:45px 20px; text-align:center; color:var(--text-secondary);">
                            <i class="fa-regular fa-folder-open" style="font-size:42px; margin-bottom:12px;"></i>
                            <p>Folder ini masih kosong.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table modern-table">
                                <thead>
                                    <tr><th>Nama</th><th>Ukuran</th><th>Diubah</th><th style="width:170px;">Aksi</th></tr>
                                </thead>
                                <tbody>
                                    @foreach ($directories as $directory)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.files.index', ['path' => $directory]) }}">
                                                    <i class="fa-solid fa-folder" style="color:#f59e0b; margin-right:8px;"></i>{{ basename($directory) }}
                                                </a>
                                            </td>
                                            <td>Folder</td><td>-</td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.files.destroy') }}" onsubmit="return confirm('Hapus folder kosong ini?');">
                                                    @csrf @method('DELETE')
                                                    <input type="hidden" name="path" value="{{ $directory }}"><input type="hidden" name="type" value="folder">
                                                    <button class="btn btn-danger btn-xs"><i class="fa-solid fa-trash"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach ($files as $file)
                                        <tr>
                                            <td>
                                                @if ($file['is_image'])
                                                    <img src="{{ $file['url'] }}" alt="" style="width:38px;height:38px;object-fit:cover;border-radius:6px;margin-right:8px;vertical-align:middle;">
                                                @else
                                                    <i class="fa-solid fa-file" style="color:#64748b; margin-right:8px;"></i>
                                                @endif
                                                <a href="{{ $file['url'] }}" target="_blank" rel="noopener">{{ $file['name'] }}</a>
                                            </td>
                                            <td>{{ $file['size'] }}</td><td>{{ $file['modified'] }}</td>
                                            <td style="white-space:nowrap;">
                                                <a href="{{ $file['url'] }}" target="_blank" rel="noopener" class="btn btn-default btn-xs"><i class="fa-solid fa-eye"></i></a>
                                                <form method="POST" action="{{ route('admin.files.destroy') }}" style="display:inline;" onsubmit="return confirm('Hapus file ini?');">
                                                    @csrf @method('DELETE')
                                                    <input type="hidden" name="path" value="{{ $file['path'] }}"><input type="hidden" name="type" value="file">
                                                    <button class="btn btn-danger btn-xs"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document"><div class="modal-content">
            <form method="POST" action="{{ route('admin.files.upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Upload File</h4></div>
                <div class="modal-body">
                    <input type="hidden" name="path" value="{{ $path }}">
                    <label>Pilih file (maks. 50 MB per file)</label>
                    <input type="file" name="files[]" class="form-control" multiple required>
                    <small class="text-muted">Format: gambar, PDF, Office, TXT, CSV, ZIP/RAR.</small>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Batal</button><button class="btn btn-primary">Upload</button></div>
            </form>
        </div></div>
    </div>

    <div class="modal fade" id="folderModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document"><div class="modal-content">
            <form method="POST" action="{{ route('admin.files.folder') }}">
                @csrf
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Buat Folder</h4></div>
                <div class="modal-body">
                    <input type="hidden" name="path" value="{{ $path }}">
                    <label>Nama folder</label><input type="text" name="name" class="form-control" placeholder="contoh: banner_home" required maxlength="100">
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Batal</button><button class="btn btn-primary">Buat Folder</button></div>
            </form>
        </div></div>
    </div>
@endsection
