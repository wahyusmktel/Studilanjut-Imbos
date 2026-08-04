<!-- resources/views/includes/menu_mobile_app.blade.php -->

<style>
    .menu-mobile-app-container {
        padding-left: 16px;
        padding-right: 16px;
        margin-bottom: 28px;
    }

    .mobile-app-dashboard {
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(16px);
        border-radius: 24px;
        padding: 20px 18px;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .mobile-app-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    }

    .mobile-app-title {
        font-size: 0.95rem;
        font-weight: 800;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .mobile-app-title i {
        color: #25477d;
        font-size: 1.1rem;
    }

    .mobile-app-badge {
        font-size: 0.7rem;
        font-weight: 700;
        background: #e0f2fe;
        color: #0284c7;
        padding: 3px 10px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .mobile-app-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px 10px;
    }

    .mobile-app-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .mobile-app-item:active {
        transform: scale(0.92);
        opacity: 0.85;
    }

    .mobile-app-icon {
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #ffffff;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
        margin-bottom: 6px;
        position: relative;
        transition: all 0.25s ease;
    }

    .mobile-app-item:hover .mobile-app-icon {
        transform: translateY(-2px);
        box-shadow: 0 12px 22px rgba(0, 0, 0, 0.16);
    }

    .mobile-app-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: #334155;
        text-align: center;
        line-height: 1.25;
        max-width: 72px;
        word-break: break-word;
    }

    /* Icon Gradients */
    .icon-gradient-1 { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
    .icon-gradient-2 { background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%); }
    .icon-gradient-3 { background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); }
    .icon-gradient-4 { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
    .icon-gradient-5 { background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); }
    .icon-gradient-6 { background: linear-gradient(135deg, #10b981 0%, #047857 100%); }
    .icon-gradient-7 { background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%); }
    .icon-gradient-8 { background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); }
    .icon-gradient-logout { background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); }

    @media (min-width: 1201px) {
        .menu-mobile-app {
            display: none;
        }
    }
</style>

<div class="menu-mobile-app">
    <div class="container menu-mobile-app-container">
        <div class="mobile-app-dashboard" data-aos="fade-down">
            <div class="mobile-app-header">
                <h3 class="mobile-app-title">
                    <i class="bi bi-grid-fill"></i> Menu Aplikasi
                </h3>
                <span class="mobile-app-badge">Akses Cepat</span>
            </div>

            <div class="mobile-app-grid">
                <a href="/" class="mobile-app-item">
                    <div class="mobile-app-icon icon-gradient-1">
                        <i class="bi bi-house-door-fill"></i>
                    </div>
                    <span class="mobile-app-label">Home</span>
                </a>

                <a href="/tentang-kami" class="mobile-app-item">
                    <div class="mobile-app-icon icon-gradient-2">
                        <i class="bi bi-building-fill"></i>
                    </div>
                    <span class="mobile-app-label">Tentang Kami</span>
                </a>

                <a href="/tracking-alumni" class="mobile-app-item">
                    <div class="mobile-app-icon icon-gradient-3">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <span class="mobile-app-label">Track Alumni</span>
                </a>

                <a href="/program" class="mobile-app-item">
                    <div class="mobile-app-icon icon-gradient-4">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <span class="mobile-app-label">Program</span>
                </a>

                <a href="/orang-tua" class="mobile-app-item">
                    <div class="mobile-app-icon icon-gradient-5">
                        <i class="bi bi-person-heart"></i>
                    </div>
                    <span class="mobile-app-label">Pantau Ortu</span>
                </a>

                <a href="/tryout" class="mobile-app-item">
                    <div class="mobile-app-icon icon-gradient-6">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <span class="mobile-app-label">Try Out</span>
                </a>

                <a href="/berita" class="mobile-app-item">
                    <div class="mobile-app-icon icon-gradient-7">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <span class="mobile-app-label">Info</span>
                </a>

                <a href="/login-guru" class="mobile-app-item">
                    <div class="mobile-app-icon icon-gradient-8">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <span class="mobile-app-label">Hadir Guru</span>
                </a>

                @auth('guru')
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="mobile-app-item">
                    <form id="logout-form-mobile" action="{{ route('guru.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="mobile-app-icon icon-gradient-logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    <span class="mobile-app-label">Logout</span>
                </a>
                @endauth

                @auth('parent')
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="mobile-app-item">
                    <form id="logout-form-mobile" action="{{ route('parent.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="mobile-app-icon icon-gradient-logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    <span class="mobile-app-label">Logout</span>
                </a>
                @endauth
            </div>
        </div>
    </div>
</div>
