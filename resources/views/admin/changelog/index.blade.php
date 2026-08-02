@extends('admin.layouts.app')

@section('title', 'Change Log')

@section('content')
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Change Log</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="active"><span>Change Log</span></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="modern-card">
                <div class="modern-card-header" style="padding: 24px; border-bottom: 1px solid var(--border-color);">
                    <h3 class="modern-card-title" style="margin: 0; font-size: 20px; font-weight: 600; color: var(--text-primary);">Riwayat Pembaharuan Sistem</h3>
                    <p style="margin: 8px 0 0 0; color: var(--text-secondary); font-size: 14px;">Log aktivitas dan pembaruan pada sistem Studi Lanjut IMBOS.</p>
                </div>
                <div class="modern-card-body" style="padding: 30px 24px;">
                    
                    <div style="position: relative; padding-left: 30px;">
                        <!-- Timeline Line -->
                        <div style="position: absolute; top: 0; bottom: 0; left: 11px; width: 2px; background: #e2e8f0; z-index: 1;"></div>

                        <!-- Update Item 1 -->
                        <div style="position: relative; margin-bottom: 40px; z-index: 2;">
                            <div style="position: absolute; left: -26px; top: 4px; width: 16px; height: 16px; border-radius: 50%; background: var(--primary); border: 3px solid #fff; box-shadow: 0 0 0 2px var(--primary-light);"></div>
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                                <div>
                                    <h4 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--text-primary);">v2.0.0 - Admin Dashboard Modernization & CMS Overhaul</h4>
                                    <div style="margin-top: 6px; display: flex; gap: 8px; flex-wrap: wrap;">
                                        <span class="badge-modern primary">UI/UX</span>
                                        <span class="badge-modern success">Fitur Baru</span>
                                        <span class="badge-modern" style="background: #fef3c7; color: #d97706;">Perbaikan Bug</span>
                                    </div>
                                </div>
                                <div style="color: var(--text-secondary); font-size: 13px; font-weight: 500;">
                                    <i class="fa fa-calendar-alt"></i> {{ date('d F Y') }}
                                </div>
                            </div>
                            <div style="background: #f8fafc; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-color);">
                                <p style="margin-bottom: 15px; color: var(--text-primary); font-weight: 500;">Pembaruan besar untuk mengubah tampilan antarmuka (UI) dashboard admin menjadi lebih modern, responsif, dan elegan.</p>
                                <ul style="padding-left: 20px; margin-bottom: 0; color: var(--text-secondary); line-height: 1.6; list-style-type: disc;">
                                    <li style="margin-bottom: 8px;"><strong>Desain Sistem Baru:</strong> Implementasi <code style="background: #e2e8f0; padding: 2px 6px; border-radius: 4px; color: #334155;">admin-modern.css</code> dengan variabel CSS khusus, warna gradasi, dan elemen UI yang konsisten (modern-card, modern-table).</li>
                                    <li style="margin-bottom: 8px;"><strong>Sidebar & Navigasi:</strong> Desain sidebar baru yang dapat di-collapse, navigasi yang lebih intuitif, dan responsif untuk perangkat seluler.</li>
                                    <li style="margin-bottom: 8px;"><strong>Modul Absensi (Siswa & Guru):</strong> Redesign total halaman absensi, perbaikan bug logika grafik kehadiran pada <code style="background: #e2e8f0; padding: 2px 6px; border-radius: 4px; color: #334155;">AbsensiGurubaruController.php</code>, dan penanganan NullSafe (<code style="background: #e2e8f0; padding: 2px 6px; border-radius: 4px; color: #334155;">?-></code>) pada export Excel.</li>
                                    <li style="margin-bottom: 8px;"><strong>Migrasi Chart.js:</strong> Memperbarui library Chart.js dari versi 2.x ke versi 4.4 UMD untuk menghilangkan konflik rendering dan menambahkan visualisasi grafik yang lebih halus dengan efek gradasi.</li>
                                    <li style="margin-bottom: 8px;"><strong>Modul CMS:</strong> Modernisasi antarmuka untuk <em>Daftar Alumni</em>, <em>Testimonials</em>, <em>Kelola Kategori Berita</em>, <em>Data Berita</em>, dan <em>Data Komentar</em>.</li>
                                    <li style="margin-bottom: 8px;"><strong>Halaman Change Log:</strong> Menambahkan halaman Riwayat Pembaharuan Sistem (halaman ini) untuk memantau perubahan aplikasi.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Update Item 2 -->
                        <div style="position: relative; margin-bottom: 0; z-index: 2;">
                            <div style="position: absolute; left: -26px; top: 4px; width: 16px; height: 16px; border-radius: 50%; background: #94a3b8; border: 3px solid #fff;"></div>
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                                <div>
                                    <h4 style="margin: 0; font-size: 18px; font-weight: 600; color: var(--text-primary);">v1.0.0 - Rilis Awal Sistem</h4>
                                    <div style="margin-top: 6px; display: flex; gap: 8px; flex-wrap: wrap;">
                                        <span class="badge-modern primary">Rilis Perdana</span>
                                    </div>
                                </div>
                                <div style="color: var(--text-secondary); font-size: 13px; font-weight: 500;">
                                    <i class="fa fa-calendar-alt"></i> Versi Terdahulu
                                </div>
                            </div>
                            <div style="background: #f8fafc; border-radius: var(--radius-md); padding: 20px; border: 1px solid var(--border-color);">
                                <ul style="padding-left: 20px; margin-bottom: 0; color: var(--text-secondary); line-height: 1.6; list-style-type: disc;">
                                    <li style="margin-bottom: 8px;">Pengembangan fitur dasar menggunakan Laravel 11.</li>
                                    <li style="margin-bottom: 8px;">Sistem manajemen siswa, guru, mata pelajaran, dan jadwal bimbel.</li>
                                    <li style="margin-bottom: 8px;">Integrasi pendaftaran alumni dan manajemen berita.</li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
