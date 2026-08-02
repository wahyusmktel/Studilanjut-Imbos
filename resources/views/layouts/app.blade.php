<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Home - Studi Lanjut IMBOS Pringsewu')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('halaman_umum/assets/img/logo-imbos.png') }}" rel="icon">
    <link href="{{ asset('halaman_umum/assets/img/logo-imbos.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('halaman_umum/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('halaman_umum/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('halaman_umum/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('halaman_umum/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('halaman_umum/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('halaman_umum/assets/css/main.css') }}" rel="stylesheet">

    <!-- jQuery -->
    {{-- <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script> --}}
    <!-- SweetAlert JavaScript -->
    {{-- <script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script> --}}
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto center-logo">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('halaman_umum/assets/img/logo-imbos.png') }}" alt="">
                <h1 class="sitename">STUDI LANJUT <br>SMAIT IMBOS</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}" class="active">Home</a></li>
                    <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                    <li><a href="{{ url('/tracking-alumni') }}">Track Alumni</a></li>
                    <li><a href="{{ url('/program') }}">Program</a></li>
                    <li><a href="{{ url('/orang-tua') }}">Pantau Ortu</a></li>
                    <li><a href="{{ url('/tryout') }}">Try Out</a></li>
                    <li><a href="{{ url('/berita') }}">Info</a></li>
                    <li><a href="{{ url('/login-guru') }}">Daftar Hadir Guru</a></li>
                    @auth('guru')
                        <li>
                            <form id="logout-form" action="{{ route('guru.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    @endauth
                    @auth('parent')
                        <li>
                            <form id="logout-form" action="{{ route('parent.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    @endauth
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <p>Hubungi Kami</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="400">
                                <i class="bi bi-instagram"></i>
                                <h3>Instagram</h3>
                                <p><a href="https://www.instagram.com/studilanjutimbos/"
                                        target="_blank">@studilanjutimbos</a></p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="300">
                                <i class="bi bi-whatsapp"></i>
                                <h3>WhatsApp</h3>
                                <p><a href="https://wa.me/6285609276949?text=Assalamualaikum."
                                        target="_blank">0856-0927-6949</a></p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="200">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Alamat</h3>
                                <p>Pringsewu Selatan, Kec. Pringsewu</p>
                                <p>Kab. Pringsewu, Lampung 35376</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="300">
                                <i class="bi bi-link-45deg"></i>
                                <h3>Studi Lanjut IMBOS</h3>
                                <p><a href="https://studilanjut.imbospringsewu.com/"
                                        target="_blank">studilanjut.imbospringsewu.com</a></p>
                            </div>
                        </div><!-- End Info Item -->
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Maps -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.3084684536507!2d104.96929507498376!3d-5.369838994608995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4732773b51fbfd%3A0x7a90c7aa4e69d1d0!2sInsan%20Mulia%20Boarding%20School%20(IMBOS)%20Pringsewu!5e0!3m2!1sid!2sid!4v1718672039109!5m2!1sid!2sid"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div><!-- End Contact Form -->
            </div>
        </div>
    </section><!-- /Contact Section -->

    <footer id="footer" class="footer">
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename"><a href="https://imbos.sch.id"
                        target="_blank">IMBOS Pringsewu</a></strong> <span>All Rights Reserved</span></p>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('halaman_umum/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('halaman_umum/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('halaman_umum/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('halaman_umum/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('halaman_umum/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('halaman_umum/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('halaman_umum/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('halaman_umum/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('halaman_umum/assets/js/main.js') }}"></script>
</body>

</html>
