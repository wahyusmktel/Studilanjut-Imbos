@extends('layouts.app')

@section('title', 'Portal Akademik Orang Tua - Studi Lanjut IMBOS')

@section('content')

<style>
    /* Professional University Academic Portal Design */
    .parent-portal-section {
        position: relative;
        padding: 110px 0 70px 0;
        background: linear-gradient(135deg, #0b192c 0%, #1e3a8a 50%, #0f2b5c 100%);
        overflow: hidden;
        color: #ffffff;
        min-height: 92vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Geometric Background Overlay */
    .parent-portal-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(212, 175, 55, 0.08) 0%, transparent 40%),
            radial-gradient(circle at 80% 70%, rgba(37, 99, 235, 0.15) 0%, transparent 50%);
        pointer-events: none;
    }

    .parent-portal-section .hero-waves {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 55px;
        z-index: 5;
    }

    .portal-academic-card {
        background: rgba(255, 255, 255, 0.97);
        border-radius: 24px;
        padding: 42px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.8);
        color: #1e293b;
        position: relative;
    }

    .portal-badge-academic {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: #e0f2fe;
        color: #0369a1;
        font-weight: 700;
        font-size: 0.825rem;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 20px;
        border: 1px solid #bae6fd;
    }

    .portal-title-academic {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0b192c;
        margin-bottom: 10px;
        line-height: 1.25;
        letter-spacing: -0.5px;
    }

    .portal-title-academic span {
        color: #1e3a8a;
    }

    .portal-subtitle-academic {
        font-size: 0.98rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .academic-form-label {
        font-size: 0.875rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        display: block;
    }

    .academic-input-wrapper {
        position: relative;
        margin-bottom: 22px;
    }

    .academic-input-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 1.2rem;
        z-index: 10;
        pointer-events: none;
    }

    .academic-input {
        width: 100%;
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        border-radius: 14px;
        padding: 14px 20px 14px 50px;
        color: #0f172a;
        font-size: 0.95rem;
        font-weight: 600;
        outline: none;
        transition: all 0.25s ease;
    }

    .academic-input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }

    .academic-input:focus {
        background: #ffffff;
        border-color: #1e3a8a;
        box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.12);
        color: #0f172a;
    }

    .btn-academic-submit {
        width: 100%;
        background: linear-gradient(135deg, #1e3a8a 0%, #0b192c 100%);
        color: #ffffff;
        font-weight: 800;
        font-size: 1rem;
        padding: 15px;
        border-radius: 14px;
        border: none;
        box-shadow: 0 10px 25px rgba(30, 58, 138, 0.35);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        letter-spacing: 0.5px;
    }

    .btn-academic-submit:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1e3a8a 100%);
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(30, 58, 138, 0.45);
        color: #ffffff;
    }

    .password-toggle-icon {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        cursor: pointer;
        z-index: 10;
        font-size: 1.1rem;
        transition: color 0.2s ease;
    }

    .password-toggle-icon:hover {
        color: #1e3a8a;
    }

    .security-notice {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.8rem;
        color: #64748b;
        margin-top: 22px;
        font-weight: 500;
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
    }

    /* Right Side: Academic Highlights & Student Image Frame */
    .academic-info-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 28px;
        padding: 32px;
        color: #ffffff;
    }

    .portal-hero-student-img {
        max-height: 240px;
        object-fit: contain;
        filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.3));
        transition: transform 0.4s ease;
    }

    .portal-hero-student-img:hover {
        transform: scale(1.04);
    }

    .academic-feature-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-top: 20px;
    }

    .academic-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 14px 16px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        transition: background 0.25s ease;
    }

    .academic-feature-item:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .af-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
        box-shadow: 0 6px 15px rgba(245, 158, 11, 0.3);
    }

    .af-text h5 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0 0 2px 0;
    }

    .af-text p {
        font-size: 0.825rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        line-height: 1.4;
    }

    @media (max-width: 991px) {
        .parent-portal-section {
            padding: 90px 0 50px 0;
            min-height: auto;
        }
        .portal-academic-card {
            padding: 28px 20px;
        }
        .portal-title-academic {
            font-size: 1.85rem;
        }
        .portal-hero-student-img {
            max-height: 200px;
        }
    }
</style>

<!-- Hero Section -->
<section id="hero" class="parent-portal-section">
    @include('includes.menu_mobile_app')

    <div class="container">
        <div class="row gy-4 align-items-center">
            
            <!-- Left Side: Professional Login Card -->
            <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                <div class="portal-academic-card">
                    <span class="portal-badge-academic">
                        <i class="bi bi-shield-check"></i> Sistem Informasi Orang Tua (SIM-ORTU)
                    </span>
                    
                    <h1 class="portal-title-academic">
                        Assalamualaikum, <span>Abi & Umi</span>
                    </h1>
                    <p class="portal-subtitle-academic">
                        Selamat datang di Portal Monitoring Akademik SMAIT IMBOS. Silakan login untuk memantau perkembangan belajar putra/putri Anda.
                    </p>

                    <form role="form" class="get-a-quote" id="contact-form" method="post" action="{{ route('parent.login.submit') }}">
                        @csrf
                        
                        <!-- NIS Input -->
                        <div class="mb-3">
                            <label class="academic-form-label">Nomor Induk Siswa (NIS)</label>
                            <div class="academic-input-wrapper">
                                <i class="bi bi-person-vcard-fill academic-input-icon"></i>
                                <input type="text" class="academic-input" name="nis" placeholder="Contoh: 202401001" required autocomplete="username">
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label class="academic-form-label">Kata Sandi (Password)</label>
                            <div class="academic-input-wrapper">
                                <i class="bi bi-lock-fill academic-input-icon"></i>
                                <input type="password" class="academic-input" id="parentPassword" name="password" placeholder="Masukkan password akun Anda" required autocomplete="current-password">
                                <i class="bi bi-eye-slash-fill password-toggle-icon" id="togglePasswordBtn"></i>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-academic-submit mt-2">
                            <span>MASUK PORTAL AKADEMIK</span>
                            <i class="bi bi-arrow-right-circle-fill fs-5"></i>
                        </button>
                    </form>

                    <!-- Security Notice -->
                    <div class="security-notice">
                        <i class="bi bi-lock-fill text-success"></i>
                        <span>Koneksi Portal Terenkripsi SSL Secured</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Academic Highlights Frame & Student Image -->
            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                <div class="academic-info-card">
                    <!-- Student Image Display -->
                    <div class="text-center mb-3">
                        <img src="{{ asset('halaman_umum/assets/img/hero-image-putra.png') }}" class="img-fluid animated portal-hero-student-img" alt="Siswa IMBOS">
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ asset('halaman_umum/assets/img/logo-imbos.png') }}" height="44" alt="Logo IMBOS">
                        <div>
                            <h5 class="fw-bold mb-0 text-white">SMAIT IMBOS PRINGSEWU</h5>
                            <small class="text-white-50">Program Layanan Studi Lanjut Terpadu</small>
                        </div>
                    </div>

                    <p class="text-white-50 leading-relaxed small mb-3">
                        Fasilitas portal resmi bagi orang tua/wali murid untuk mengakses perkembangan akademis, evaluasi hasil try out, serta hasil konsultasi bimbingan perguruan tinggi secara langsung.
                    </p>

                    <div class="academic-feature-list">
                        <div class="academic-feature-item">
                            <div class="af-icon">
                                <i class="bi bi-bar-chart-steps"></i>
                            </div>
                            <div class="af-text">
                                <h5>Evaluasi Skor Try Out Berkala</h5>
                                <p>Pantau perkembangan grafik nilai UTBK & SNBT siswa dari setiap pelaksanaan try out.</p>
                            </div>
                        </div>

                        <div class="academic-feature-item">
                            <div class="af-icon">
                                <i class="bi bi-compass-fill"></i>
                            </div>
                            <div class="af-text">
                                <h5>Pemetaan Target PTN & Kedinasan</h5>
                                <p>Akses rekomendasi jurusan dan universitas impian berdasarkan analisis keketatan.</p>
                            </div>
                        </div>

                        <div class="academic-feature-item">
                            <div class="af-icon">
                                <i class="bi bi-chat-quote-fill"></i>
                            </div>
                            <div class="af-text">
                                <h5>Catatan Bimbingan Konseling</h5>
                                <p>Lihat rekam bimbingan akademik dan saran pembimbing secara transparan.</p>
                            </div>
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
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)"></use>
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)"></use>
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#f8fafc"></use>
        </g>
    </svg>
</section>

<!-- SweetAlert2 Error Notification & Toggle Password Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePasswordBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('parentPassword');

        if (togglePasswordBtn && passwordInput) {
            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('bi-eye-fill');
                this.classList.toggle('bi-eye-slash-fill');
            });
        }
    });
</script>

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Masuk',
            text: '{{ session('error') }}',
            confirmButtonColor: '#1e3a8a'
        });
    </script>
@endif

@endsection
