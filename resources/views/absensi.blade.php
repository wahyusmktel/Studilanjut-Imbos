@extends('layouts.app')

@section('title', 'Absensi Guru - Studi Lanjut IMBOS Pringsewu')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        @include('includes.menu_mobile_app')

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-2 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Assalamualaikum, Wr, Wb</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Hallo Star Teacher!!!
                        <br>Saatnya mengisi daftar Kehadiran di setiap Pertemuan Bimbel Studi Lanjut IMBOS.
                    </p>
                    <div class="d-flex flex-column" data-aos="fade-up" data-aos-delay="200">
                        <div class="row">
                            <div class="col-md-12">

                                <form role="form" class="get-a-quote" id="contact-form" method="POST"
                                    action="{{ route('guru.login.submit') }}">
                                    @csrf
                                    <div class="group-img">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.364 11.636C14.3837 10.6558 13.217 9.93013 11.9439 9.49085C13.3074 8.55179 14.2031 6.9802 14.2031 5.20312C14.2031 2.33413 11.869 0 9 0C6.131 0 3.79688 2.33413 3.79688 5.20312C3.79688 6.9802 4.69262 8.55179 6.05609 9.49085C4.78308 9.93013 3.61631 10.6558 2.63605 11.636C0.936176 13.3359 0 15.596 0 18H1.40625C1.40625 13.8128 4.81279 10.4062 9 10.4062C13.1872 10.4062 16.5938 13.8128 16.5938 18H18C18 15.596 17.0638 13.3359 15.364 11.636ZM9 9C6.90641 9 5.20312 7.29675 5.20312 5.20312C5.20312 3.1095 6.90641 1.40625 9 1.40625C11.0936 1.40625 12.7969 3.1095 12.7969 5.20312C12.7969 7.29675 11.0936 9 9 9Z"
                                                fill="#555555"></path>
                                        </svg>
                                        <input type="text" class="form-controls" name="nip"
                                            placeholder="Masukan NIY GURU" required>
                                    </div>
                                    <div class="group-img">
                                        <svg width="22" height="18" viewBox="0 0 22 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.8649 18H6.13513C2.58377 18 0.540527 15.9568 0.540527 12.4054V5.5946C0.540527 2.04324 2.58377 0 6.13513 0H15.8649C19.4162 0 21.4595 2.04324 21.4595 5.5946V12.4054C21.4595 15.9568 19.4162 18 15.8649 18ZM6.13513 1.45946C3.35242 1.45946 1.99999 2.81189 1.99999 5.5946V12.4054C1.99999 15.1881 3.35242 16.5406 6.13513 16.5406H15.8649C18.6476 16.5406 20 15.1881 20 12.4054V5.5946C20 2.81189 18.6476 1.45946 15.8649 1.45946H6.13513Z"
                                                fill="#444444"></path>
                                            <path
                                                d="M10.9988 9.8465C10.1815 9.8465 9.35452 9.59352 8.72208 9.07785L5.67668 6.64539C5.36532 6.39241 5.30696 5.93511 5.55992 5.62376C5.8129 5.31241 6.2702 5.25403 6.58155 5.50701L9.62695 7.93947C10.3664 8.53298 11.6215 8.53298 12.361 7.93947L15.4064 5.50701C15.7178 5.25403 16.1848 5.30268 16.428 5.62376C16.681 5.93511 16.6324 6.40214 16.3113 6.64539L13.2659 9.07785C12.6432 9.59352 11.8161 9.8465 10.9988 9.8465Z"
                                                fill="#444444"></path>
                                        </svg>
                                        <input type="password" class="form-controls" name="password"
                                            placeholder="Masukan Password" required>
                                    </div>
                                    <button type="submit" class="btn batton"> MASUK </button>
                                </form>
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                @if (session('error'))
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: '{{ session('error') }}',
                                        });
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-1 hero-img" data-aos="zoom-out">
                    <img src="{{ asset('halaman_umum/assets/img/hero-img-putri.png') }}" class="img-fluid animated"
                        alt="">
                </div>
            </div>
        </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#f6c506">
            </g>
        </svg>

    </section><!-- /Hero Section -->

@endsection
