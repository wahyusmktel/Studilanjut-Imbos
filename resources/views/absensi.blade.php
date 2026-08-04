@extends('layouts.app')

@section('title', 'Login Portal Guru - Studi Lanjut IMBOS Pringsewu')

@section('content')

<style>
    /* Modern Teacher Portal Login Styling */
    .guru-hero-section {
        position: relative;
        padding: 120px 0 70px 0;
        background: linear-gradient(135deg, #0b192c 0%, #1e3a8a 50%, #0f2b5c 100%);
        overflow: hidden;
        color: #ffffff;
    }

    .guru-hero-section .hero-waves {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 60px;
        z-index: 5;
    }

    /* Modern Login Card */
    .guru-login-card {
        background: #ffffff;
        border-radius: 28px;
        padding: 40px 36px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #1e293b;
        position: relative;
        z-index: 10;
    }

    .guru-card-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(37, 99, 235, 0.1);
        color: #2563eb;
        font-weight: 700;
        font-size: 0.8rem;
        padding: 6px 16px;
        border-radius: 50px;
        margin-bottom: 16px;
    }

    .guru-card-title {
        font-size: 1.65rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .guru-card-subtitle {
        color: #64748b;
        font-size: 0.92rem;
        margin-bottom: 28px;
        line-height: 1.5;
    }

    /* Input Field Customization */
    .input-icon-group {
        position: relative;
        margin-bottom: 22px;
    }

    .input-icon-group .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 1.15rem;
        z-index: 5;
        transition: color 0.25s ease;
    }

    .input-icon-group .form-control-guru {
        width: 100%;
        padding: 14px 45px 14px 48px;
        border-radius: 14px;
        border: 1.5px solid #cbd5e1;
        font-size: 0.95rem;
        font-weight: 600;
        color: #1e293b;
        transition: all 0.25s ease;
        background-color: #f8fafc;
    }

    .input-icon-group .form-control-guru:focus {
        background-color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        outline: none;
    }

    .input-icon-group .form-control-guru:focus + .input-icon {
        color: #2563eb;
    }

    .password-toggle-btn {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94a3b8;
        font-size: 1.1rem;
        cursor: pointer;
        padding: 4px;
        z-index: 5;
        transition: color 0.2s ease;
    }

    .password-toggle-btn:hover {
        color: #2563eb;
    }

    /* Login Submit Button */
    .btn-guru-login {
        width: 100%;
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        color: #ffffff;
        font-size: 1rem;
        font-weight: 800;
        padding: 14px;
        border-radius: 50px;
        border: none;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.35);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
    }

    .btn-guru-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(37, 99, 235, 0.45);
        color: #ffffff;
    }

    /* Security Footer Badge */
    .security-notice {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 20px;
        font-size: 0.78rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Feature Highlight Badges */
    .feature-badge-item {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 12px 18px;
        border-radius: 16px;
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .feature-badge-item i {
        font-size: 1.2rem;
        color: #60a5fa;
    }

    @media (max-width: 991px) {
        .guru-hero-section {
            padding: 95px 0 50px 0;
        }
        .guru-login-card {
            padding: 30px 24px;
        }
    }
</style>

<!-- Hero & Login Section -->
<section id="hero" class="guru-hero-section">
    @include('includes.menu_mobile_app')

    <div class="container position-relative" style="z-index: 10;">
        <div class="row gy-4 align-items-center">
            
            <!-- Left Side: Login Form Card -->
            <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                <div class="guru-login-card">
                    <div class="guru-card-badge">
                        <i class="bi bi-shield-lock-fill"></i>
                        <span>SIM-GURU • PORTAL ABSENSI</span>
                    </div>

                    <h2 class="guru-card-title">Assalamualaikum, Star Teacher! 👋</h2>
                    <p class="guru-card-subtitle">
                        Saatnya mencatat kehadiran & progres bimbingan studi lanjut siswa SMAIT IMBOS Pringsewu.
                    </p>

                    <form role="form" id="contact-form" method="POST" action="{{ route('guru.login.submit') }}">
                        @csrf

                        <!-- Field NIY Guru -->
                        <div class="input-icon-group">
                            <i class="bi bi-person-vcard-fill input-icon"></i>
                            <input type="text" class="form-control-guru" name="nip" placeholder="Masukkan NIY GURU..." required autocomplete="username">
                        </div>

                        <!-- Field Password -->
                        <div class="input-icon-group">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" id="guruPasswordInput" class="form-control-guru" name="password" placeholder="Masukkan Password..." required autocomplete="current-password">
                            <button type="button" class="password-toggle-btn" onclick="toggleGuruPassword()" title="Tampilkan/Sembunyikan Password">
                                <i class="bi bi-eye-slash-fill" id="guruPasswordEyeIcon"></i>
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-guru-login">
                            <span>MASUK KE PORTAL GURU</span>
                            <i class="bi bi-arrow-right-circle-fill fs-5"></i>
                        </button>
                    </form>

                    <!-- Security Notice -->
                    <div class="security-notice">
                        <i class="bi bi-lock-fill text-success"></i>
                        <span>Sistem Otentikasi Terenkripsi & Dilindungi SSL</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Hero Illustration & Features -->
            <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="position-relative d-inline-block">
                    <img src="{{ asset('halaman_umum/assets/img/hero-img-putri.png') }}" class="img-fluid animated" alt="Studi Lanjut Teacher Illustration" style="max-height: 380px;">
                </div>

                <!-- Feature Highlights Bar -->
                <div class="row g-3 mt-3 justify-content-center">
                    <div class="col-sm-4">
                        <div class="feature-badge-item">
                            <i class="bi bi-journal-check"></i>
                            <span>Presensi Pertemuan</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="feature-badge-item">
                            <i class="bi bi-camera-fill"></i>
                            <span>Foto Dokumentasi</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="feature-badge-item">
                            <i class="bi bi-graph-up-arrow"></i>
                            <span>Progres Studi Lanjut</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Wave Divider -->
    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255, 255, 255, .1)"></use>
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255, 255, 255, .2)"></use>
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#f8fafc"></use>
        </g>
    </svg>
</section>

<!-- SweetAlert2 & Interactive Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleGuruPassword() {
        const passwordInput = document.getElementById('guruPasswordInput');
        const eyeIcon = document.getElementById('guruPasswordEyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('bi-eye-slash-fill');
            eyeIcon.classList.add('bi-eye-fill');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('bi-eye-fill');
            eyeIcon.classList.add('bi-eye-slash-fill');
        }
    }
</script>

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Masuk',
            text: '{{ session('error') }}',
            confirmButtonColor: '#2563eb'
        });
    </script>
@endif

@endsection
