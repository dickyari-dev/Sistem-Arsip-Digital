<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Clivax - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Codebucks" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">


    <!-- dark layout js -->
    <script src="{{ asset('assets/js/pages/layout.js') }}"></script>

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- simplebar css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <div id="layout-wrapper">


        <!-- Start topbar -->
        <header id="page-topbar">
            <div class="navbar-header">

                <!-- Logo -->

                <!-- Start Navbar-Brand -->
                <div class="navbar-logo-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="text-uppercase fs-17 fw-bold">
                            Arsip Digital
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="text-uppercase fs-17 fw-bold">
                            Arsip Digital
                        </span>
                    </a>

                    <button type="button" class="btn btn-sm top-icon sidebar-btn" id="sidebar-btn">
                        <i class="mdi mdi-menu-open align-middle fs-19"></i>
                    </button>
                </div>
                <!-- End navbar brand -->

                <!-- Start menu -->
                <div class="d-flex justify-content-between menu-sm px-3 ms-auto">
                    <div class="d-flex align-items-center gap-2">

                    </div>

                    <div class="d-flex align-items-center gap-2">

                        <!--End App Search-->
                        <!-- Start Profile -->
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-sm top-icon p-0" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded avatar-2xs p-0"
                                    src="{{ asset('assets/images/users/avatar-6.png') }}" alt="Header Avatar">
                            </button>
                            <div
                                class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0">
                                <div class="card border-0">
                                    <div class="card-header bg-primary rounded-0">
                                        <div class="rich-list-item w-100 p-0">
                                            <div class="rich-list-prepend">
                                                <div class="avatar avatar-label-light avatar-circle">
                                                    <div class="avatar-display"><i class="fa fa-user-alt"></i></div>
                                                </div>
                                            </div>
                                            <div class="rich-list-content">
                                                <h3 class="rich-list-title text-white">{{ Auth::user()->name }}</h3>
                                                <span class="rich-list-subtitle text-white">{{ Auth::user()->email
                                                    }}</span>
                                            </div>
                                            <div class="rich-list-append"><span class="badge badge-label-light fs-6">{{
                                                    Auth::user()->role }}</span></div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">

                                    </div>
                                    <div class="card-footer card-footer-bordered rounded-0"><a href="auth-login.html"
                                            class="btn btn-label-danger">Sign out</a></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Profile -->
                    </div>
                </div>
                <!-- End menu -->
            </div>
        </header>
        <!-- End topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="sidebar-left">

            <div data-simplebar class="h-100">

                <!--- Sidebar-menu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    @if (Auth::user()->role == 'admin')
                    <ul class="left-menu list-unstyled" id="side-menu">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="">
                                <i class="fas fa-desktop"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-title">Arsip</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="fa fa-database"></i>
                                <span>Database Surat</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ route('admin.surat') }}">
                                        <i class="mdi mdi-checkbox-blank-circle align-middle"></i> Semua Surat
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.surat.create') }}">
                                        <i class="mdi mdi-checkbox-blank-circle align-middle"></i> Tambah Surat Masuk
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.surat.disposisi') }}">
                                        <i class="mdi mdi-checkbox-blank-circle align-middle"></i> Surat Terdisposisi
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.surat.pending') }}">
                                        <i class="mdi mdi-checkbox-blank-circle align-middle"></i> Surat Menunggu
                                        Disposisi
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="fa fa-users"></i>
                                <span>Management User</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.surat') }}"><i
                                            class="mdi mdi-checkbox-blank-circle align-middle"></i>Add New User</a></li>
                                <li><a href="{{ route('admin.surat.create') }}"><i
                                            class="mdi mdi-checkbox-blank-circle align-middle"></i>User List</a></li>
                            </ul>
                        </li>
                    </ul>
                    @elseif(Auth::user->role == 'camat')
                    <ul class="left-menu list-unstyled" id="side-menu">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="">
                                <i class="fas fa-desktop"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-title">Arsip</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="fa fa-database"></i>
                                <span>Database Surat</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.surat') }}"><i
                                            class="mdi mdi-checkbox-blank-circle align-middle"></i>Data Surat</a></li>
                                <li><a href="{{ route('admin.surat.create') }}"><i
                                            class="mdi mdi-checkbox-blank-circle align-middle"></i>Input Surat</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="fa fa-users"></i>
                                <span>Management User</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.surat') }}"><i
                                            class="mdi mdi-checkbox-blank-circle align-middle"></i>Add New User</a></li>
                                <li><a href="{{ route('admin.surat.create') }}"><i
                                            class="mdi mdi-checkbox-blank-circle align-middle"></i>User List</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->


        <!-- Start right Content here -->

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <div>
                                    <h4 class="fs-16 fw-semibold mb-1 mb-md-2">Hallo, Welcome Back! <span
                                            class="text-primary">{{ Auth::user()->name }}!</span></h4>
                                    <p class="text-muted mb-0">You're Login as <span class="fw-semibold text-primary">{{
                                            Auth::user()->role }}</span></p>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Arsip Digital</a>
                                        </li>
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    end row -->

                    @yield('content')
                    <!-- end row -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row align-items-center">

                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->
    </div>
    <!-- end layout-wrapper -->


   
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>


    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>