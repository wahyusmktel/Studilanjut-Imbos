@extends('admin.layouts.app')

@section('title', 'Files')

@section('content')
    <style>
        .cloud-files { --cloud-blue: #2764e7; --cloud-ink: #172033; --cloud-muted: #718096; }
        .cloud-hero { padding: 28px; border-radius: 20px; color: #fff; background: linear-gradient(135deg, #183b9c 0%, #2764e7 54%, #5a8df5 100%); box-shadow: 0 14px 35px rgba(39, 100, 231, .22); position: relative; overflow: hidden; }
        .cloud-hero:after { content: ''; position: absolute; width: 260px; height: 260px; right: -75px; top: -135px; border-radius: 50%; background: rgba(255,255,255,.12); }
        .cloud-hero h2 { margin: 0 0 8px; color: #fff; font-size: 25px; font-weight: 700; }
        .cloud-hero p { margin: 0; color: rgba(255,255,255,.82); }
        .cloud-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 14px; flex-wrap: wrap; margin: 22px 0 14px; }
        .cloud-breadcrumb { display: flex; gap: 5px; align-items: center; flex-wrap: wrap; }
        .cloud-breadcrumb a { color: var(--cloud-muted); text-decoration: none; padding: 8px 10px; border-radius: 9px; }
        .cloud-breadcrumb a:hover, .cloud-breadcrumb a.current { background: #edf3ff; color: var(--cloud-blue); }
        .cloud-action { border: 0; border-radius: 10px; padding: 10px 14px; font-weight: 600; }
        .cloud-action-primary { background: var(--cloud-blue); color: #fff; box-shadow: 0 7px 15px rgba(39,100,231,.2); }
        .cloud-action-light { background: #eef3fb; color: var(--cloud-ink); }
        .cloud-table-card { border: 1px solid #e8edf5; border-radius: 16px; background: #fff; box-shadow: 0 8px 25px rgba(31, 45, 61, .05); overflow: hidden; }
        .cloud-table { margin: 0; }
        .cloud-table thead th { border: 0; background: #f8faff; color: #8b96a8; font-size: 11px; letter-spacing: .08em; text-transform: uppercase; padding: 15px 20px; }
        .cloud-table tbody td { padding: 14px 20px; vertical-align: middle; border-top: 1px solid #f0f3f8; color: #566274; }
        .cloud-file-name { color: #253044; font-weight: 600; text-decoration: none; }
        .cloud-file-name:hover { color: var(--cloud-blue); }
        .cloud-file-icon { display: inline-flex; width: 38px; height: 38px; align-items: center; justify-content: center; margin-right: 10px; border-radius: 10px; background: #eef3ff; color: var(--cloud-blue); vertical-align: middle; }
        .cloud-file-icon.folder { background: #fff5d9; color: #e8a400; }
        .cloud-file-icon.archive { background: #eee8ff; color: #7957d5; }
        .cloud-empty { padding: 60px 20px; text-align: center; color: var(--cloud-muted); }
        .cloud-empty i { display: block; margin-bottom: 14px; color: #b9c8e7; font-size: 48px; }
        .progress-cloud { height: 9px; margin: 13px 0 8px; overflow: hidden; border-radius: 20px; background: #e8eef9; }
        .progress-cloud .bar { height: 100%; width: 0; border-radius: inherit; background: linear-gradient(90deg, #2764e7, #65a1ff); transition: width .2s ease; }
        .cloud-progress-percent { color: var(--cloud-blue); font-size: 28px; font-weight: 700; }
        .cloud-progress-detail { color: var(--cloud-muted); font-size: 13px; }
        .cloud-modal-icon { display: inline-flex; width: 44px; height: 44px; align-items: center; justify-content: center; margin-bottom: 12px; border-radius: 13px; background: #edf3ff; color: var(--cloud-blue); font-size: 20px; }
        @media (max-width: 600px) { .cloud-hero { padding: 22px; } .cloud-table thead th:nth-child(2), .cloud-table tbody td:nth-child(2), .cloud-table thead th:nth-child(3), .cloud-table tbody td:nth-child(3) { display:none; } }
    </style>

    <div class="cloud-files">
        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
        @if ($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif

        <div class="cloud-hero">
            <h2><i class="fa-solid fa-cloud" style="margin-right:8px;"></i> Files</h2>
            <p>Kelola aset publik, upload file besar, dan ekstrak ZIP langsung dari dashboard.</p>
        </div>

        <div class="cloud-toolbar">
            <div class="cloud-breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (!$loop->first)<i class="fa-solid fa-chevron-right" style="font-size:10px;color:#aab4c4;"></i>@endif
                    <a class="{{ $loop->last ? 'current' : '' }}" href="{{ route('admin.files.index', ['path' => $breadcrumb['path']]) }}">
                        <i class="fa-solid {{ $loop->first ? 'fa-house' : 'fa-folder' }}"></i> {{ $breadcrumb['name'] }}
                    </a>
                @endforeach
            </div>
            <div style="display:flex;gap:8px;">
                <button class="cloud-action cloud-action-light" data-toggle="modal" data-target="#folderModal"><i class="fa-solid fa-folder-plus"></i> Folder Baru</button>
                <button class="cloud-action cloud-action-primary" data-toggle="modal" data-target="#uploadModal"><i class="fa-solid fa-arrow-up"></i> Upload</button>
            </div>
        </div>

        <div class="cloud-table-card">
            @if (count($directories) === 0 && count($files) === 0)
                <div class="cloud-empty"><i class="fa-regular fa-folder-open"></i><strong>Folder ini masih kosong</strong><p>Upload file atau buat folder baru untuk memulai.</p></div>
            @else
                <div class="table-responsive">
                    <table class="table cloud-table">
                        <thead><tr><th>Nama</th><th>Ukuran</th><th>Diubah</th><th style="width:145px;text-align:right;">Aksi</th></tr></thead>
                        <tbody>
                            @foreach ($directories as $directory)
                                <tr>
                                    <td><a class="cloud-file-name" href="{{ route('admin.files.index', ['path' => $directory]) }}"><span class="cloud-file-icon folder"><i class="fa-solid fa-folder"></i></span>{{ basename($directory) }}</a></td>
                                    <td>Folder</td><td>-</td>
                                    <td style="text-align:right;"><form method="POST" action="{{ route('admin.files.destroy') }}" onsubmit="return confirm('Hapus folder kosong ini?');">@csrf @method('DELETE')<input type="hidden" name="path" value="{{ $directory }}"><input type="hidden" name="type" value="folder"><button class="btn btn-default btn-xs" title="Hapus"><i class="fa-solid fa-trash"></i></button></form></td>
                                </tr>
                            @endforeach
                            @foreach ($files as $file)
                                <tr>
                                    <td>
                                        <span class="cloud-file-icon {{ $file['is_zip'] ? 'archive' : '' }}">
                                            @if ($file['is_image']) <img src="{{ $file['url'] }}" alt="" style="width:38px;height:38px;object-fit:cover;border-radius:10px;"> @else <i class="fa-solid {{ $file['is_zip'] ? 'fa-box-archive' : 'fa-file-lines' }}"></i> @endif
                                        </span>
                                        <a class="cloud-file-name" href="{{ $file['url'] }}" target="_blank" rel="noopener">{{ $file['name'] }}</a>
                                    </td>
                                    <td>{{ $file['size'] }}</td><td>{{ $file['modified'] }}</td>
                                    <td style="text-align:right;white-space:nowrap;">
                                        @if ($file['is_zip']) <button class="btn btn-primary btn-xs" title="Ekstrak ZIP" onclick="startExtraction(@js($file['path']))"><i class="fa-solid fa-box-open"></i></button> @endif
                                        <a href="{{ $file['url'] }}" target="_blank" rel="noopener" class="btn btn-default btn-xs" title="Buka"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                        <form method="POST" action="{{ route('admin.files.destroy') }}" style="display:inline;" onsubmit="return confirm('Hapus file ini?');">@csrf @method('DELETE')<input type="hidden" name="path" value="{{ $file['path'] }}"><input type="hidden" name="type" value="file"><button class="btn btn-default btn-xs" title="Hapus"><i class="fa-solid fa-trash"></i></button></form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content">
        <form id="uploadForm" method="POST" action="{{ route('admin.files.upload') }}" enctype="multipart/form-data">
            @csrf <input type="hidden" name="path" value="{{ $path }}">
            <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><i class="fa-solid fa-cloud-arrow-up" style="color:#2764e7;"></i> Upload ke Files</h4></div>
            <div class="modal-body"><label>Pilih file</label><input type="file" name="files[]" class="form-control" multiple required><small class="text-muted">Maksimal 50 MB per file. ZIP dapat diekstrak setelah upload.</small></div>
            <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Batal</button><button class="cloud-action cloud-action-primary" type="submit"><i class="fa-solid fa-upload"></i> Mulai Upload</button></div>
        </form>
    </div></div></div>

    <div class="modal fade" id="folderModal" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content">
        <form method="POST" action="{{ route('admin.files.folder') }}">@csrf <input type="hidden" name="path" value="{{ $path }}">
            <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Folder Baru</h4></div>
            <div class="modal-body"><label>Nama folder</label><input type="text" name="name" class="form-control" placeholder="contoh: banner_home" required maxlength="100"></div>
            <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Batal</button><button class="cloud-action cloud-action-primary" type="submit">Buat Folder</button></div>
        </form>
    </div></div></div>

    <div class="modal fade" id="progressModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"><div class="modal-dialog modal-sm" role="document"><div class="modal-content" style="border-radius:18px;">
        <div class="modal-body" style="padding:30px;text-align:center;"><div class="cloud-modal-icon"><i id="progressIcon" class="fa-solid fa-cloud-arrow-up"></i></div><h4 id="progressTitle" style="margin:0 0 6px;">Menyiapkan...</h4><p id="progressText" class="cloud-progress-detail" style="margin:0;">Mohon jangan menutup halaman.</p><div class="progress-cloud"><div id="progressBar" class="bar"></div></div><div id="progressPercent" class="cloud-progress-percent">0%</div><div id="progressDetail" class="cloud-progress-detail"></div></div>
    </div></div></div>

    <script>
        const filesCsrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const progressModal = $('#progressModal');
        const progressBar = document.getElementById('progressBar');
        const progressPercent = document.getElementById('progressPercent');
        const progressTitle = document.getElementById('progressTitle');
        const progressText = document.getElementById('progressText');
        const progressDetail = document.getElementById('progressDetail');
        const progressIcon = document.getElementById('progressIcon');

        function showProgress(title, text, icon) {
            progressTitle.textContent = title; progressText.textContent = text; progressIcon.className = 'fa-solid ' + icon;
            progressBar.style.width = '0%'; progressPercent.textContent = '0%'; progressDetail.textContent = '';
            progressModal.modal('show');
        }

        function updateProgress(percent, detail) {
            progressBar.style.width = percent + '%'; progressPercent.textContent = percent + '%'; progressDetail.textContent = detail || '';
        }

        document.getElementById('uploadForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const form = event.target, xhr = new XMLHttpRequest();
            const data = new FormData(form), files = form.querySelector('[name="files[]"]').files;
            if (!files.length) return;
            showProgress('Mengunggah file...', 'File sedang dikirim ke server.', 'fa-cloud-arrow-up');
            xhr.open('POST', form.action); xhr.setRequestHeader('Accept', 'application/json'); xhr.setRequestHeader('X-CSRF-TOKEN', filesCsrf);
            xhr.upload.addEventListener('progress', function (e) { if (e.lengthComputable) updateProgress(Math.round((e.loaded / e.total) * 100), files.length + ' file sedang diunggah'); });
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) { updateProgress(100, 'Upload selesai.'); progressTitle.textContent = 'Upload selesai'; progressText.textContent = 'Memuat ulang daftar files...'; setTimeout(() => window.location.reload(), 700); }
                else { progressTitle.textContent = 'Upload gagal'; progressText.textContent = 'Periksa ukuran dan format file.'; progressIcon.className = 'fa-solid fa-circle-exclamation'; }
            };
            xhr.onerror = function () { progressTitle.textContent = 'Koneksi gagal'; progressText.textContent = 'Silakan coba lagi.'; progressIcon.className = 'fa-solid fa-circle-exclamation'; };
            xhr.send(data);
        });

        function startExtraction(zipPath) {
            if (!confirm('Ekstrak ZIP ini ke folder baru?')) return;
            showProgress('Mengekstrak ZIP...', 'Server sedang menyiapkan file.', 'fa-box-open');
            extractBatch(zipPath, 0);
        }

        function extractBatch(zipPath, index) {
            fetch('{{ route('admin.files.extract') }}', { method: 'POST', headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': filesCsrf}, body: JSON.stringify({path: zipPath, index: index}) })
                .then(response => response.json().then(data => ({ok: response.ok, data: data})))
                .then(result => {
                    if (!result.ok) throw new Error(result.data.message || 'Ekstraksi gagal.');
                    const data = result.data; updateProgress(data.percent, data.index + ' dari ' + data.total + ' item diproses');
                    if (data.complete) { progressTitle.textContent = 'Ekstraksi selesai'; progressText.textContent = 'File sudah tersedia di folder ' + data.folder; setTimeout(() => window.location.reload(), 1200); }
                    else { setTimeout(() => extractBatch(zipPath, data.index), 80); }
                }).catch(error => { progressTitle.textContent = 'Ekstraksi gagal'; progressText.textContent = error.message; progressIcon.className = 'fa-solid fa-circle-exclamation'; });
        }
    </script>
@endsection
