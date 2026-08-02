@extends('layouts.app')

@section('title', 'Detail Alumni')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        @include('includes.menu_mobile_app')

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(246, 197, 6, 100)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(246, 197, 6, 0.2)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#ffffff">
            </g>
        </svg>

    </section><!-- /Hero Section -->
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>{{ $alumni->nama_alumni }}</h1>
                        <p class="mb-0">{{ $alumni->nama_universitas }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/tracking-alumni') }}">Tracking Alumni</a></li>
                    <li class="current">{{ $alumni->nama_alumni }}</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            }
                        }
                        </script>
                        <div class="swiper-wrapper align-items-center">
                            <div class="swiper-slide">
                                @if($alumni->foto)
                                    <img src="{{ asset('storage/' . $alumni->foto) }}" alt="">
                                @else
                                <img src="{{ asset('halaman_umum/assets/img/no-image-alumni.png') }}" alt="">
                                    
                                @endif
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                        <h3>Informasi Alumni</h3>
                        <ul>
                            <li><strong>Nama:</strong> {{ $alumni->nama_alumni }}</li>
                            <li><strong>Jenis Perguruan Tinggi:</strong> {{ $alumni->jenisPt->nama_jenis_pt }}</li>
                            <li><strong>Nama Universitas:</strong> {{ $alumni->nama_universitas }}</li>
                            <li><strong>Tahun Lulusan:</strong> {{ $alumni->tahun_lulusan }}</li>
                        </ul>
                    </div>
                    {{-- <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2>Deskripsi Alumni</h2>
                        <p>
                            Deskripsi lengkap dari alumni dapat ditambahkan di sini.
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </section><!-- /Portfolio Details Section -->
@endsection
