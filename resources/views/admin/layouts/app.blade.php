<!-- resources/views/admin/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title') - Admin Dashboard</title>
    <meta name="description" content="Splasher is a Dashboard & Admin Site Responsive Template by hencework." />
    <meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Splasher Admin, Splasheradmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="hencework"/>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Data table CSS -->
    <link href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- SweetAlert CSS -->
    <link href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- jQuery -->
    <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- SweetAlert JavaScript -->
    <script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- Summernote css -->
	<link rel="stylesheet" href="{{ asset('vendors/bower_components/summernote/dist/summernote.css') }}" />

</head>

<body>
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->
    <div class="wrapper theme-2-active navbar-top-light horizontal-nav">
        @include('admin.partials.header')
        @include('admin.partials.sidebar')
        
        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container pt-30">
                @yield('content')
            </div>
        </div>
        <!-- /Main Content -->

        @include('admin.partials.footer')
    </div>
    <!-- /#wrapper -->
    
    <!-- JavaScript -->
    
    

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    
    <!-- Data table JavaScript -->
    <script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/dataTables-data.js') }}"></script>

    
    
    <!-- Slimscroll JavaScript -->
    <script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
    
    <!-- Owl JavaScript -->
    <script src="{{ asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    
    <!-- Switchery JavaScript -->
    <script src="{{ asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
    
    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>

    <!-- Summernote Plugin JavaScript -->
	<script src="{{ asset('vendors/bower_components/summernote/dist/summernote.min.js') }}"></script>
    
    <!-- Init JavaScript -->
    <script src="{{ asset('dist/js/init.js') }}"></script>

    <script src="{{ asset('vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
        });
    </script>

</body>
</html>
