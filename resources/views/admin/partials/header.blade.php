<header class="admin-header">
    <div class="header-left">
        <button class="header-toggle-btn" id="sidebarToggleBtn" title="Toggle Sidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
        <button class="mobile-toggle-btn" id="mobileToggleBtn" title="Toggle Menu">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h1 class="header-title">@yield('title', 'Dashboard')</h1>
    </div>
    <div class="header-right">
        <div class="header-profile">
            <button class="profile-trigger" id="profileTrigger">
                @if(Auth::guard('admin')->check())
                    <img src="{{ asset('storage/' . Auth::guard('admin')->user()->foto) }}" alt="Profile" class="profile-avatar">
                    <div class="profile-info">
                        <span class="profile-name">{{ Auth::guard('admin')->user()->name }}</span>
                        <span class="profile-role">Administrator</span>
                    </div>
                @else
                    <img src="{{ asset('img/user1.png') }}" alt="Profile" class="profile-avatar">
                    <div class="profile-info">
                        <span class="profile-name">Guest</span>
                        <span class="profile-role">-</span>
                    </div>
                @endif
                <i class="fa-solid fa-chevron-down profile-chevron"></i>
            </button>
            <div class="profile-dropdown" id="profileDropdown">
                <a href="{{ route('admin.profile.edit') }}" class="profile-dropdown-item">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
                <hr class="profile-dropdown-divider">
                <a href="{{ route('admin.logout') }}" class="profile-dropdown-item text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
