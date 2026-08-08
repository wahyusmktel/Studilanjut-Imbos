<!-- resources/views/admin/partials/sidebar.blade.php -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <a href="{{ url('/admin/dashboard') }}" class="sidebar-brand">
            <div class="brand-icon-box">
                <img src="{{ asset('img/logo-imbos.png') }}" alt="IMBOS" class="sidebar-brand-icon">
            </div>
            <div class="sidebar-brand-text">
                <span class="brand-title">Studi Lanjut</span>
                <span class="brand-badge">IMBOS PRINGSEWU</span>
            </div>
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-label">Menu Utama</li>
            
            <!-- Dashboard (no submenu) -->
            <li class="sidebar-menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="/admin/dashboard" class="sidebar-menu-link" title="Dashboard">
                    <i class="fa-solid fa-gauge-high sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Dashboard</span>
                </a>
            </li>
            
            <!-- Data Guru (with submenu) -->
            <li class="sidebar-menu-item {{ Request::is('admin/guru*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="sidebar-menu-link" data-submenu="true" title="Data Guru">
                    <i class="fa-solid fa-chalkboard-user sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Data Guru</span>
                    <span class="sidebar-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <ul class="sidebar-submenu {{ Request::is('admin/guru*') ? 'open' : '' }}">
                    <li class="sidebar-submenu-header">Data Guru</li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/guru*') ? 'active' : '' }}">
                        <a href="/admin/guru" class="sidebar-submenu-link {{ Request::is('admin/guru*') ? 'active' : '' }}">Data Guru</a>
                    </li>
                </ul>
            </li>
            
            <!-- Master Data (with submenu) -->
            <li class="sidebar-menu-item {{ Request::is('admin/mata_pelajaran*', 'admin/kelas*', 'admin/program_bimbel*', 'admin/siswa*', 'admin/tahun_pelajaran*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="sidebar-menu-link" data-submenu="true" title="Master Data">
                    <i class="fa-solid fa-database sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Master Data</span>
                    <span class="sidebar-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <ul class="sidebar-submenu {{ Request::is('admin/mata_pelajaran*', 'admin/kelas*', 'admin/program_bimbel*', 'admin/siswa*', 'admin/tahun_pelajaran*') ? 'open' : '' }}">
                    <li class="sidebar-submenu-header">Master Data</li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/mata_pelajaran*') ? 'active' : '' }}">
                        <a href="/admin/mata_pelajaran/" class="sidebar-submenu-link {{ Request::is('admin/mata_pelajaran*') ? 'active' : '' }}">Mata Pelajaran</a>
                    </li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/kelas*') ? 'active' : '' }}">
                        <a href="/admin/kelas/" class="sidebar-submenu-link {{ Request::is('admin/kelas*') ? 'active' : '' }}">Kelompok</a>
                    </li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/program_bimbel*') ? 'active' : '' }}">
                        <a href="/admin/program_bimbel/" class="sidebar-submenu-link {{ Request::is('admin/program_bimbel*') ? 'active' : '' }}">Program Bimbel</a>
                    </li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/siswa*') ? 'active' : '' }}">
                        <a href="/admin/siswa/" class="sidebar-submenu-link {{ Request::is('admin/siswa*') ? 'active' : '' }}">Siswa</a>
                    </li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/tahun_pelajaran*') ? 'active' : '' }}">
                        <a href="/admin/tahun_pelajaran/" class="sidebar-submenu-link {{ Request::is('admin/tahun_pelajaran*') ? 'active' : '' }}">Tahun Pelajaran</a>
                    </li>
                </ul>
            </li>
            
            <!-- Try Out (with submenu) -->
            <li class="sidebar-menu-item {{ Request::is('admin/tryout*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="sidebar-menu-link" data-submenu="true" title="Try Out">
                    <i class="fa-solid fa-flag-checkered sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Try Out</span>
                    <span class="sidebar-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <ul class="sidebar-submenu {{ Request::is('admin/tryout*') ? 'open' : '' }}">
                    <li class="sidebar-submenu-header">Try Out</li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/tryout*') ? 'active' : '' }}">
                        <a href="/admin/tryout" class="sidebar-submenu-link {{ Request::is('admin/tryout*') ? 'active' : '' }}">Data Try Out</a>
                    </li>
                </ul>
            </li>
            
            <!-- Nilai (with submenu) -->
            <li class="sidebar-menu-item {{ Request::is('admin/nilai*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="sidebar-menu-link" data-submenu="true" title="Nilai">
                    <i class="fa-solid fa-chart-simple sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Nilai</span>
                    <span class="sidebar-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <ul class="sidebar-submenu {{ Request::is('admin/nilai*') ? 'open' : '' }}">
                    <li class="sidebar-submenu-header">Nilai</li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/nilai*') ? 'active' : '' }}">
                        <a href="/admin/nilai-siswa" class="sidebar-submenu-link {{ Request::is('admin/nilai*') ? 'active' : '' }}">Nilai Siswa</a>
                    </li>
                </ul>
            </li>
            
            <!-- Absensi (with submenu) -->
            <li class="sidebar-menu-item {{ Request::is('admin/absensi*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="sidebar-menu-link" data-submenu="true" title="Absensi">
                    <i class="fa-solid fa-calendar-check sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Absensi</span>
                    <span class="sidebar-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <ul class="sidebar-submenu {{ Request::is('admin/absensi*') ? 'open' : '' }}">
                    <li class="sidebar-submenu-header">Absensi</li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/absensi') || Request::is('admin/absensi/*') ? 'active' : '' }}">
                        <a href="/admin/absensi" class="sidebar-submenu-link {{ Request::is('admin/absensi') || Request::is('admin/absensi/*') ? 'active' : '' }}">Data Absensi Siswa</a>
                    </li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/absensi-guru*') ? 'active' : '' }}">
                        <a href="/admin/absensi-guru" class="sidebar-submenu-link {{ Request::is('admin/absensi-guru*') ? 'active' : '' }}">Data Absensi Guru</a>
                    </li>
                </ul>
            </li>
            
            <!-- Alumni (with submenu) -->
            <li class="sidebar-menu-item {{ Request::is('admin/alumni*', 'admin/testimonials*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="sidebar-menu-link" data-submenu="true" title="Alumni">
                    <i class="fa-solid fa-medal sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Alumni</span>
                    <span class="sidebar-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <ul class="sidebar-submenu {{ Request::is('admin/alumni*', 'admin/testimonials*') ? 'open' : '' }}">
                    <li class="sidebar-submenu-header">Alumni</li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/alumni*') ? 'active' : '' }}">
                        <a href="/admin/alumni" class="sidebar-submenu-link {{ Request::is('admin/alumni*') ? 'active' : '' }}">Data Alumni</a>
                    </li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                        <a href="/admin/testimonials" class="sidebar-submenu-link {{ Request::is('admin/testimonials*') ? 'active' : '' }}">Testimonial</a>
                    </li>
                </ul>
            </li>
            
            <!-- Berita (with submenu) -->
            <li class="sidebar-menu-item {{ Request::is('admin/berita*', 'admin/kategori-berita*', 'admin/komentar*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="sidebar-menu-link" data-submenu="true" title="Berita">
                    <i class="fa-solid fa-newspaper sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Berita</span>
                    <span class="sidebar-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <ul class="sidebar-submenu {{ Request::is('admin/berita*', 'admin/kategori-berita*', 'admin/komentar*') ? 'open' : '' }}">
                    <li class="sidebar-submenu-header">Berita</li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/kategori-berita*') ? 'active' : '' }}">
                        <a href="/admin/kategori-berita" class="sidebar-submenu-link {{ Request::is('admin/kategori-berita*') ? 'active' : '' }}">Kategori</a>
                    </li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/berita') || Request::is('admin/berita/*') ? 'active' : '' }}">
                        <a href="/admin/berita" class="sidebar-submenu-link {{ Request::is('admin/berita') || Request::is('admin/berita/*') ? 'active' : '' }}">Berita</a>
                    </li>
                    <li class="sidebar-submenu-item {{ Request::is('admin/komentar*') ? 'active' : '' }}">
                        <a href="/admin/komentar" class="sidebar-submenu-link {{ Request::is('admin/komentar*') ? 'active' : '' }}">Komentar</a>
                    </li>
                </ul>
            </li>
            
            <li class="sidebar-menu-label">System</li>

            <!-- Files -->
            <li class="sidebar-menu-item {{ Request::is('admin/files*') ? 'active' : '' }}">
                <a href="{{ route('admin.files.index') }}" class="sidebar-menu-link {{ Request::is('admin/files*') ? 'active' : '' }}" title="Files">
                    <i class="fa-solid fa-folder-open sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Files</span>
                </a>
            </li>
            
            <!-- Changelog -->
            <li class="sidebar-menu-item {{ Request::is('admin/changelog') ? 'active' : '' }}">
                <a href="/admin/changelog" class="sidebar-menu-link {{ Request::is('admin/changelog') ? 'active' : '' }}" title="Change Log">
                    <i class="fa-solid fa-history sidebar-menu-icon"></i>
                    <span class="sidebar-menu-text">Change Log</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
