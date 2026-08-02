<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - Admin Studi Lanjut IMBOS</title>
    <meta name="description" content="Admin Dashboard Studi Lanjut IMBOS Pringsewu" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <!-- Data table CSS -->
    <link href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- SweetAlert CSS -->
    <link href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Old Template CSS (kept for backward compat in content areas) -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Dropify -->
    <link href="{{ asset('vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Summernote -->
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/summernote/dist/summernote.css') }}" />
    
    <!-- NEW Modern Admin CSS (loaded LAST to override) -->
    <link href="{{ asset('dist/css/admin-modern.css') }}" rel="stylesheet" type="text/css">
    
    <!-- jQuery -->
    <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- SweetAlert JavaScript -->
    <script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
    <!-- Chart.js 4.4 UMD -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>

<body>
    <div class="admin-wrapper">
        @include('admin.partials.sidebar')
        
        <div class="admin-main">
            @include('admin.partials.header')
            
            <div class="admin-content">
                @yield('content')
            </div>
            
            @include('admin.partials.footer')
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/dataTables-data.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
    
    <script>
    (function() {
        // Dropify init
        $(document).ready(function() {
            $('.dropify').dropify();
        });
        
        // Sidebar Toggle
        const sidebar = document.getElementById('adminSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggleBtn');
        const mobileToggleBtn = document.getElementById('mobileToggleBtn');
        
        // Restore sidebar state from localStorage
        const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (sidebarCollapsed && window.innerWidth > 768) {
            sidebar.classList.add('collapsed');
        }
        
        // Desktop toggle
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.toggle('collapsed');
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                }
            });
        }
        
        // Mobile toggle
        if (mobileToggleBtn) {
            mobileToggleBtn.addEventListener('click', function() {
                document.body.classList.toggle('sidebar-mobile-open');
            });
        }
        
        // Overlay click closes mobile sidebar
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                document.body.classList.remove('sidebar-mobile-open');
            });
        }
        
        // Submenu toggles
        document.querySelectorAll('.sidebar-menu-link[data-submenu]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (sidebar.classList.contains('collapsed') && window.innerWidth > 768) {
                    return; // In collapsed mode, submenus display as flyouts on hover
                }
                const submenu = this.nextElementSibling;
                const parentItem = this.parentElement;
                
                // Close other open submenus
                document.querySelectorAll('.sidebar-submenu.open').forEach(function(openSub) {
                    if (openSub !== submenu) {
                        openSub.classList.remove('open');
                        openSub.parentElement.classList.remove('open');
                    }
                });
                
                if (submenu) {
                    submenu.classList.toggle('open');
                    parentItem.classList.toggle('open');
                }
            });
        });
        
        // Profile dropdown
        const profileTrigger = document.getElementById('profileTrigger');
        const profileDropdown = document.getElementById('profileDropdown');
        
        if (profileTrigger && profileDropdown) {
            profileTrigger.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            });
            
            document.addEventListener('click', function(e) {
                if (!profileTrigger.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.remove('show');
                }
            });
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.body.classList.remove('sidebar-mobile-open');
            }
        });
    })();
    </script>
</body>
</html>
