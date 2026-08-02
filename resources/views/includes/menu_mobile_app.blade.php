<!-- resources/views/includes/menu_mobile_app.blade.php -->

<div class="menu-mobile-app">
    <div class="menu-mobile-heading aos-init aos-animate" data-aos="fade-up">
        <h2>Main Menu</h2>
    </div>
    <div class="row gy-3">

        <div class="col-xl-3 d-flex">
            <div class="row align-self-center gy-3">

                <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box d-flex align-items-center">
                        <i class="bi bi-house-fill"></i>
                        <a href="/">Home</a>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box d-flex align-items-center">
                        <i class="bi bi-buildings"></i>
                        <a href="/tentang-kami">Tentang Kami</a>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box d-flex align-items-center">
                        <i class="bi bi-mortarboard-fill"></i>
                        <a href="/tracking-alumni">Track Alumni</a>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-box d-flex align-items-center">
                        <i class="bi bi-list-task"></i>
                        <a href="/program">Program</a>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-box d-flex align-items-center">
                        <i class="bi bi-person-hearts"></i>
                        <a href="/orang-tua">Pantau Ortu</a>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                    <div class="feature-box d-flex align-items-center">
                        <i class="bi bi-book-fill"></i>
                        <a href="/tryout">Try Out</a>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                    <div class="feature-box d-flex align-items-center">
                        <i class="bi bi-info-square-fill"></i>
                        <a href="/berita">Info</a>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                    <div class="feature-box d-flex align-items-center">
                        <i class="bi bi-calendar2-check"></i>
                        <a href="/login-guru">Daftar Hadir Guru</a>
                    </div>
                </div><!-- End Feature Item -->

                @auth('guru')
                <li>
                    <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                        <div class="feature-box d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i>
                            <form id="logout-form" action="{{ route('guru.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </div>
                    </div><!-- End Feature Item -->
                </li>
                @endauth
                @auth('parent')
                <li>
                    <div class="col-md-3 col-xs-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                        <div class="feature-box d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i>
                            <form id="logout-form" action="{{ route('parent.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </div>
                    </div>
                </li>
                @endauth

            </div>
        </div>

    </div>
</div>
