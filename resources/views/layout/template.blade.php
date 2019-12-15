<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('meta')

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="/sbAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="/sbAdmin/css/sb-admin.css" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="index.html">Bramantyas</a>
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown no-arrow">
                {{-- Jika Login --}}
                @if (Session::get('login_state') != null)
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Session::get('login_state')->nama_pendek}}
                    <i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#aboutModal">About</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
                @endif

                {{-- Jika Tidak Login --}}
                @if (Session::get('login_state') == null)
                <a class="btn btn-sm btn-primary" href="/login">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>
                @endif
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-chart-line"></i>
                    <span>Analisa</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/penilaianKriteria">Penilaian Kriteria</a>
                    <a class="dropdown-item" href="/hasilAnalisa">Hasil Analisa</a>
                </div>
            </li>

            {{-- Jika Login --}}
            @if (Session::get('login_state') != null)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-database"></i>
                    <span>Master</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/masterDeveloper">Master Developer</a>
                    <a class="dropdown-item" href="/masterPerumahan">Master Perumahan</a>
                    <a class="dropdown-item" href="/masterRumah">Master Rumah</a>
                </div>
            </li>
            @endif
        </ul>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Page Content -->
                <div class="row">
                    <div class="col">
                        <h3>@yield('icon-title-content') @yield('title-content')</h3>
                    </div>
                    <div class="col">
                        @yield('right-of-title-content')
                    </div>
                </div>
                <hr>
                @if ($msgType != '')
                    <div class="col-8 mx-auto mt-3">
                        <div class="alert alert-{{$msgType}} alert-dismissible fade show" role="alert">
                            <strong>{{ucwords($msgType)}}</strong> {{$msgStr}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                @yield('content')
            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Your Website 2019</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    @yield('modal')

    <!-- Bootstrap core JavaScript-->
    <script src="/sbAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="/sbAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/sbAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/sbAdmin/js/sb-admin.min.js"></script>
    @yield('js')

</body>

</html>
