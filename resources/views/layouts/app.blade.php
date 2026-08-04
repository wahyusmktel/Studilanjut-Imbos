<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home - Studi Lanjut IMBOS Pringsewu')</title>
    <meta name="description" content="@yield('meta_description', 'Studi Lanjut SMAIT IMBOS Pringsewu - Layanan Bimbingan Belajar Intensif SNBP, UTBK-SNBT, Kedinasan (PTK), PTKIN, PTS Unggulan & Studi Internasional Turki & Timur Tengah.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Studi Lanjut IMBOS, SMAIT IMBOS Pringsewu, Bimbel SNBP, UTBK SNBT, Kedinasan PTK, PTKIN, PTS, Kuliah di Turki, Bimbingan Belajar Pringsewu')">
    <meta name="robots" content="index, follow">

    <!-- Canonical Link -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Studi Lanjut IMBOS Pringsewu">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="@yield('title', 'Studi Lanjut IMBOS Pringsewu')">
    <meta property="og:description" content="@yield('meta_description', 'Layanan Bimbingan Belajar Intensif SMAIT IMBOS Pringsewu untuk persiapan SNBP, SNBT/UTBK, Kedinasan, dan Studi Internasional.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('halaman_umum/assets/img/logo-imbos.png'))">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Studi Lanjut IMBOS Pringsewu')">
    <meta name="twitter:description" content="@yield('meta_description', 'Layanan Bimbingan Belajar Intensif SMAIT IMBOS Pringsewu untuk persiapan SNBP, SNBT/UTBK, Kedinasan, dan Studi Internasional.')">
    <meta name="twitter:image" content="@yield('og_image', asset('halaman_umum/assets/img/logo-imbos.png'))">

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

    <!-- Schema.org JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EducationalOrganization",
      "name": "Studi Lanjut SMAIT IMBOS Pringsewu",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('halaman_umum/assets/img/logo-imbos.png') }}",
      "description": "Fasilitas layanan Bimbingan Belajar Intensif SMAIT Insan Mulia Boarding School Pringsewu untuk persiapan SNBP, SNBT/UTBK, Kedinasan, dan Studi Internasional.",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Pringsewu",
        "addressRegion": "Lampung",
        "postalCode": "35376",
        "addressCountry": "ID"
      },
      "sameAs": [
        "https://www.instagram.com/studilanjutimbos/"
      ]
    }
    </script>

    <style>
        /* Custom Modern Contact Section Styling */
        .contact-modern-section {
            background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%);
            padding: 80px 0;
            position: relative;
        }

        .contact-badge-title {
            display: inline-block;
            padding: 6px 18px;
            background: #e0f2fe;
            color: #0284c7;
            font-weight: 700;
            font-size: 0.825rem;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .contact-list-card-wrapper {
            background: #ffffff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .contact-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 16px;
            margin-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .contact-card-header h5 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .contact-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            transition: all 0.25s ease;
        }

        .contact-item-row:hover {
            background: #ffffff;
            border-color: #cbd5e1;
            transform: translateX(4px);
            box-shadow: 0 8px 20px rgba(37, 71, 125, 0.06);
        }

        .contact-item-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .contact-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #ffffff;
            flex-shrink: 0;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .icon-ig { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }
        .icon-wa { background: linear-gradient(135deg, #25d366 0%, #128c7e 100%); }
        .icon-geo { background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); }
        .icon-web { background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); }

        .contact-info-content h6 {
            font-size: 0.98rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 2px 0;
        }

        .contact-info-content p {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0;
            line-height: 1.4;
        }

        .contact-action-btn {
            font-size: 0.825rem;
            font-weight: 700;
            color: #25477d;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 8px 16px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            transition: all 0.25s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        .contact-item-row:hover .contact-action-btn {
            background: #25477d;
            color: #ffffff;
            border-color: #25477d;
            gap: 8px;
        }

        .map-card-wrapper {
            background: #ffffff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .map-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 16px;
            margin-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .map-card-header h5 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .map-status-dot {
            width: 9px;
            height: 9px;
            background-color: #22c55e;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.6);
        }

        .map-iframe-container {
            border-radius: 18px;
            overflow: hidden;
            flex-grow: 1;
            min-height: 380px;
        }

        .map-iframe-container iframe {
            width: 100%;
            height: 100%;
            border: none;
            min-height: 380px;
        }

        .modern-footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 40px 0;
            border-top: 1px solid #1e293b;
        }

        .modern-footer a {
            color: #38bdf8;
            font-weight: 600;
        }

        @media (max-width: 767px) {
            .contact-item-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .contact-action-btn {
                align-self: flex-start;
            }
        }
    </style>
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto center-logo">
                <img src="{{ asset('halaman_umum/assets/img/logo-imbos.png') }}" alt="Logo IMBOS">
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
    <section id="contact" class="contact-modern-section">
        <div class="container">
            <div class="section-title-custom" data-aos="fade-up">
                <span class="contact-badge-title"><i class="bi bi-chat-dots-fill me-1"></i> Kontak Kami</span>
                <h2>Hubungi Tim Studi Lanjut IMBOS</h2>
                <p>Kami siap memberikan informasi dan konsultasi lengkap terkait program studi lanjut untuk putra/putri Anda.</p>
            </div>

            <div class="row gy-4 align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <!-- Vertical Social & Contact List Card -->
                <div class="col-lg-6">
                    <div class="contact-list-card-wrapper">
                        <div>
                            <div class="contact-card-header">
                                <h5>
                                    <i class="bi bi-person-lines-fill text-primary"></i>
                                    Informasi & Kontak Official
                                </h5>
                                <small class="text-muted"><i class="bi bi-clock-fill text-success me-1"></i>Respon Cepat</small>
                            </div>

                            <div class="d-flex flex-column gap-3">
                                <!-- Instagram -->
                                <div class="contact-item-row">
                                    <div class="contact-item-left">
                                        <div class="contact-icon-box icon-ig">
                                            <i class="bi bi-instagram"></i>
                                        </div>
                                        <div class="contact-info-content">
                                            <h6>Instagram Official</h6>
                                            <p>@studilanjutimbos</p>
                                        </div>
                                    </div>
                                    <a href="https://www.instagram.com/studilanjutimbos/" target="_blank" class="contact-action-btn">
                                        <span>Kunjungi IG</span>
                                        <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>

                                <!-- WhatsApp -->
                                <div class="contact-item-row">
                                    <div class="contact-item-left">
                                        <div class="contact-icon-box icon-wa">
                                            <i class="bi bi-whatsapp"></i>
                                        </div>
                                        <div class="contact-info-content">
                                            <h6>Layanan WhatsApp</h6>
                                            <p>0856-0927-6949</p>
                                        </div>
                                    </div>
                                    <a href="https://wa.me/6285609276949?text=Assalamualaikum.%20Saya%20ingin%20bertanya%20mengenai%20Studi%20Lanjut%20IMBOS" target="_blank" class="contact-action-btn">
                                        <span>Chat WA</span>
                                        <i class="bi bi-chat-text-fill"></i>
                                    </a>
                                </div>

                                <!-- Alamat -->
                                <div class="contact-item-row">
                                    <div class="contact-item-left">
                                        <div class="contact-icon-box icon-geo">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </div>
                                        <div class="contact-info-content">
                                            <h6>Alamat Kampus</h6>
                                            <p>Pringsewu Selatan, Kec. Pringsewu, Lampung 35376</p>
                                        </div>
                                    </div>
                                    <a href="https://maps.google.com/?q=Insan+Mulia+Boarding+School+Pringsewu" target="_blank" class="contact-action-btn">
                                        <span>Petunjuk Arah</span>
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                </div>

                                <!-- Website -->
                                <div class="contact-item-row">
                                    <div class="contact-item-left">
                                        <div class="contact-icon-box icon-web">
                                            <i class="bi bi-globe2"></i>
                                        </div>
                                        <div class="contact-info-content">
                                            <h6>Website Utama</h6>
                                            <p>studilanjut.imbospringsewu.com</p>
                                        </div>
                                    </div>
                                    <a href="https://studilanjut.imbospringsewu.com/" target="_blank" class="contact-action-btn">
                                        <span>Buka Web</span>
                                        <i class="bi bi-link-45deg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Card -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="map-card-wrapper">
                        <div class="map-card-header">
                            <h5>
                                <span class="map-status-dot"></span>
                                Lokasi SMAIT IMBOS Pringsewu
                            </h5>
                            <small class="text-muted"><i class="bi bi-pin-map-fill text-danger me-1"></i>Google Maps</small>
                        </div>
                        <div class="map-iframe-container">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.3084684536507!2d104.96929507498376!3d-5.369838994608995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4732773b51fbfd%3A0x7a90c7aa4e69d1d0!2sInsan%20Mulia%20Boarding%20School%20(IMBOS)%20Pringsewu!5e0!3m2!1sid!2sid!4v1718672039109!5m2!1sid!2sid"
                                allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer" class="modern-footer">
        <div class="container copyright text-center">
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
