<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Engineering and Construction Ethiopia</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper" id="app">
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link to="/dashboard" class="brand-link">
                <img src="{{asset('assets/admin/default/admin.png')}}" alt="{{Auth::user()->name}}'s Photo"
                    class="brand-image img-circle" style="opacity: .8; max-height: 60px!important;">
                <br>
                <span class="brand-text font-weight-light">{{Auth::user()->name}}</span>
            </router-link>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <router-link to="/dashboard" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>Account Information</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/dashboard/blog/category-list" class="nav-link">
                                <i class="nav-icon fa fa-blog"></i>
                                <p>Blog Category</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/dashboard/blog/post-list" class="nav-link">
                                <i class="nav-icon fa fa-blog"></i>
                                <p>
                                    Blog Post
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/dashboard/vacancy/category-list" class="nav-link">
                                <i class="nav-icon fa fa-briefcase"></i>
                                <p>
                                    Vacancy Category
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/dashboard/vacancy/post-list" class="nav-link">
                                <i class="nav-icon fa fa-briefcase"></i>
                                <p>
                                    Vacancy Post
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/dashboard/professional/category-list" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Professional Category
                                </p>
                            </router-link>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->


            <admin-main></admin-main>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2019 Developed by <a href="https://zematechs.com" target="_blank">Zema
                    Technologies</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
