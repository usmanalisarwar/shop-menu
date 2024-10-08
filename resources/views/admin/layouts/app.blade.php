<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Menu</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/datetimepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css')}}">
      <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
       <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>                    
            </ul>
            <div class="navbar-nav pl-2">
                <!-- Additional content can be added here -->
            </div>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                        <img src="{{ asset('admin-assets/img/avatar5.png')}}" class='img-circle elevation-2' width="40" height="40" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                        <a href="{{ route('admin.logout') }}" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('admin.dashboard')}}" class="brand-link">
                <img src="{{asset('admin-assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SHOP Menu</span>
            </a>
            <!-- Sidebar -->
            @include('admin.layouts.sidebar')
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 Menus All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-assets/js/adminlte.min.js')}}"></script>
    <script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <script src="{{ asset('admin-assets/plugins/summernote/summernote.min.js')}}"></script>
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('admin-assets/js/datetimepicker.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin-assets/js/demo.js')}}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            $(".summernote").summernote({
                height: 250
            });
        });
    </script>
    <script>
    $(document).ready(function () {
        // Show preloader when an Ajax request starts
        $(document).ajaxStart(function () {
            $('#preloader').show();
        });

        // Hide preloader when an Ajax request is completed
        $(document).ajaxStop(function () {
            $('#preloader').hide();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('input,textarea,select').on('focus change', function () {
            // Find the adjacent error message and remove it
            $(this).next('.errors').html('');
        });
        $('#add-model').on('shown.bs.modal', function () {
            // Reset the form by using its ID
            $('#add-form')[0].reset();
        });
    });
</script>
    @yield('customJs')
</body>
</html>
