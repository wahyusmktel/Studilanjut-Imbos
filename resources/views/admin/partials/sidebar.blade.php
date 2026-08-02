<!-- resources/views/admin/partials/sidebar.blade.php -->
<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Main</span>
            <hr />
        </li>
        <li>
            <a href="/admin/dashboard" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <div class="pull-left"><i class="ti-dashboard mr-20"></i><span class="right-nav-text">Dashboard</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#data_guru"
                class="{{ Request::is('admin/guru*') ? 'active' : '' }}"
                aria-expanded="{{ Request::is('admin/guru*') ? 'true' : 'false' }}">
                <div class="pull-left"><i class="ti-user mr-20"></i><span class="right-nav-text">Data Guru</span>
                </div>
                <div class="pull-right"><i class="ti-angle-down"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="data_guru" class="collapse collapse-level-1 {{ Request::is('admin/guru*') ? 'in' : '' }}">
                <li>
                    <a href="/admin/guru">Data Guru</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#data_master"
                class="{{ Request::is('admin/mata_pelajaran*', 'admin/kelas*', 'admin/program_bimbel*', 'admin/siswa*', 'admin/tahun_pelajaran*') ? 'active' : '' }}"
                aria-expanded="{{ Request::is('admin/mata_pelajaran*', 'admin/kelas*', 'admin/program_bimbel*', 'admin/siswa*', 'admin/tahun_pelajaran*') ? 'true' : 'false' }}">
                <div class="pull-left"><i class="ti-folder mr-20"></i><span class="right-nav-text">Master Data</span>
                </div>
                <div class="pull-right"><i class="ti-angle-down"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="data_master"
                class="collapse collapse-level-1 {{ Request::is('admin/mata_pelajaran*', 'admin/kelas*', 'admin/program_bimbel*', 'admin/siswa*', 'admin/tahun_pelajaran*') ? 'in' : '' }}">
                <li>
                    <a href="/admin/mata_pelajaran/">Mata Pelajaran</a>
                </li>
                <li>
                    <a href="/admin/kelas/">Kelompok</a>
                </li>
                <li>
                    <a href="/admin/program_bimbel/">Program Bimbel</a>
                </li>
                <li>
                    <a href="/admin/siswa/">Siswa</a>
                </li>
                <li>
                    <a href="/admin/tahun_pelajaran/">Tahun Pelajaran</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#tryout"
                class="{{ Request::is('admin/tryout*') ? 'active' : '' }}"
                aria-expanded="{{ Request::is('admin/tryout*') ? 'true' : 'false' }}">
                <div class="pull-left"><i class="ti-flag mr-20"></i><span class="right-nav-text">Try Out</span>
                </div>
                <div class="pull-right"><i class="ti-angle-down"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="tryout" class="collapse collapse-level-1 {{ Request::is('admin/tryout*') ? 'in' : '' }}">
                <li>
                    <a href="/admin/tryout">Data Try Out</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#nilai"
                class="{{ Request::is('admin/nilai*') ? 'active' : '' }}"
                aria-expanded="{{ Request::is('admin/nilai*') ? 'true' : 'false' }}">
                <div class="pull-left"><i class="ti-bar-chart mr-20"></i><span class="right-nav-text">Nilai</span></div>
                <div class="pull-right"><i class="ti-angle-down"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="nilai" class="collapse collapse-level-1 {{ Request::is('admin/nilai*') ? 'in' : '' }}">
                <li>
                    <a href="/admin/nilai-siswa">Nilai Siswa</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#absensi"
                class="{{ Request::is('admin/absensi*') ? 'active' : '' }}"
                aria-expanded="{{ Request::is('admin/absensi*') ? 'true' : 'false' }}">
                <div class="pull-left"><i class="ti-calendar mr-20"></i><span class="right-nav-text">Absensi</span>
                </div>
                <div class="pull-right"><i class="ti-angle-down"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="absensi" class="collapse collapse-level-1 {{ Request::is('admin/absensi*') ? 'in' : '' }}">
                <li>
                    <a href="/admin/absensi">Data Absensi Siswa</a>
                </li>
                <li>
                    <a href="/admin/absensi-guru">Data Absensi Guru</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#alumni"
                class="{{ Request::is('admin/alumni*') ? 'active' : '' }}"
                aria-expanded="{{ Request::is('admin/alumni*') ? 'true' : 'false' }}">
                <div class="pull-left"><i class="ti-medall mr-20"></i><span class="right-nav-text">Alumni</span>
                </div>
                <div class="pull-right"><i class="ti-angle-down"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="alumni" class="collapse collapse-level-1 {{ Request::is('admin/alumni*') ? 'in' : '' }}">
                <li>
                    <a href="/admin/alumni">Data Alumni</a>
                </li>
                <li>
                    <a href="/admin/testimonials">Testimonial</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#berita"
                class="{{ Request::is('admin/berita*') ? 'active' : '' }}"
                aria-expanded="{{ Request::is('admin/berita*') ? 'true' : 'false' }}">
                <div class="pull-left"><i class="ti-announcement mr-20"></i><span class="right-nav-text">Berita</span>
                </div>
                <div class="pull-right"><i class="ti-angle-down"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="berita" class="collapse collapse-level-1 {{ Request::is('admin/berita*') ? 'in' : '' }}">
                <li>
                    <a href="/admin/kategori-berita">Kategori</a>
                </li>
                <li>
                    <a href="/admin/berita">Berita</a>
                </li>
                <li>
                    <a href="/admin/komentar">Komentar</a>
                </li>
            </ul>
        </li>
        <!-- Add other sidebar items here -->
    </ul>
</div>
