@extends('admin.layouts.app')

@section('title', 'Anggota Kelas')

@section('content')
    <style>
        .member-hero { padding:25px; border-radius:18px; color:#fff; background:linear-gradient(135deg,#173b98,#2d70e8); box-shadow:0 12px 28px rgba(39,100,231,.18); }
        .member-hero h3 { margin:0 0 7px; color:#fff; font-weight:700; }
        .member-hero p { margin:0; color:rgba(255,255,255,.8); }
        .member-card { margin-top:20px; border:1px solid #e5ebf4; border-radius:16px; background:#fff; box-shadow:0 8px 24px rgba(31,45,61,.05); overflow:hidden; }
        .member-card-header { display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap; padding:20px 24px; border-bottom:1px solid #edf1f7; }
        .member-card-header h4 { margin:0; color:#1e293b; font-weight:700; }
        .member-avatar { width:36px; height:36px; border-radius:50%; object-fit:cover; vertical-align:middle; margin-right:9px; }
        .member-avatar-placeholder { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; margin-right:9px; border-radius:50%; background:#eaf1ff; color:#2563eb; font-weight:700; vertical-align:middle; }
    </style>

    <div class="row heading-bg">
        <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
            <h5 class="txt-dark">Anggota Kelas</h5>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.kelas.index') }}">Kelas</a></li>
                <li class="active"><span>Anggota Kelas</span></li>
            </ol>
        </div>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="member-hero">
        <h3><i class="fa-solid fa-users-rectangle" style="margin-right:8px;"></i>{{ $kelas->nama_kelas }}</h3>
        <p>{{ $kelas->tingkat_kelas }} &middot; {{ $members->count() }} anggota terdaftar</p>
    </div>

    <div class="member-card">
        <div class="member-card-header">
            <div><h4>Tambah Anggota</h4><small class="text-muted">Program yang sama tidak dapat diikuti dua kali oleh siswa yang sama.</small></div>
        </div>
        <div style="padding:20px 24px;">
            <form method="POST" action="{{ route('admin.kelas.anggota.tambah', $kelas->id) }}" class="row">
                @csrf
                <div class="col-md-5"><label for="siswa_id">Siswa</label><select name="siswa_id" id="siswa_id" class="form-control" required><option value="">-- Pilih siswa --</option>@foreach($availableStudents as $student)<option value="{{ $student->id }}">{{ $student->nama_siswa }} — NIS {{ $student->nis }}</option>@endforeach</select></div>
                <div class="col-md-4"><label for="program_bimbel_id">Program Bimbel</label><select name="program_bimbel_id" id="program_bimbel_id" class="form-control" required><option value="">-- Pilih program --</option>@foreach($programBimbels as $program)<option value="{{ $program->id }}">{{ $program->nama_program }}</option>@endforeach</select></div>
                <div class="col-md-3" style="padding-top:25px;"><button class="btn-modern btn-modern-primary" type="submit"><i class="fa-solid fa-user-plus"></i> Tambahkan</button></div>
            </form>
            @if($availableStudents->isEmpty())<p class="text-muted" style="margin:15px 0 0;"><i class="fa-solid fa-circle-info"></i> Semua siswa sudah menjadi anggota kelas ini.</p>@endif
        </div>
    </div>

    <div class="member-card">
        <div class="member-card-header"><h4>Daftar Anggota <span class="badge-modern primary">{{ $members->count() }}</span></h4></div>
        <div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>No</th><th>Siswa</th><th>NIS</th><th>Program Bimbel</th><th class="text-center">Aksi</th></tr></thead><tbody>
            @forelse($members as $index => $member)
                @php($program = $programsById[$member->pivot->program_bimbel_id] ?? null)
                <tr><td>{{ $index + 1 }}</td><td>@if($member->foto_siswa)<img class="member-avatar" src="{{ asset('storage/'.$member->foto_siswa) }}" alt="">@else<span class="member-avatar-placeholder">{{ strtoupper(substr($member->nama_siswa, 0, 1)) }}</span>@endif<strong>{{ $member->nama_siswa }}</strong></td><td><code>{{ $member->nis }}</code></td><td><span class="badge-modern success">{{ $program->nama_program ?? 'Program tidak tersedia' }}</span></td><td class="text-center"><form method="POST" action="{{ route('admin.kelas.anggota.keluarkan', [$kelas->id, $member->id]) }}" onsubmit="return confirm('Keluarkan siswa ini dari kelas? Keanggotaan pada kelas/program lain tetap dipertahankan.');">@csrf @method('DELETE')<button class="btn-action btn-action-delete" type="submit" title="Keluarkan dari kelas"><i class="fa-solid fa-user-minus"></i></button></form></td></tr>
            @empty
                <tr><td colspan="5" class="text-center py-4 text-muted"><i class="fa-solid fa-users-slash fa-2x mb-2"></i><p>Belum ada anggota kelas.</p></td></tr>
            @endforelse
        </tbody></table></div>
    </div>

    <div style="margin-top:18px;"><a href="{{ route('admin.kelas.index') }}" class="btn-modern btn-modern-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali ke Data Kelas</a></div>
@endsection
