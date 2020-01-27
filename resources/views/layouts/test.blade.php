<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Title --}}
    <title>{{ config('app.name', 'Testmedia') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/tests" class="nav-link">Tests</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-2 mb-2 d-flex">
                    <div class="info">
                        <h4><a href="/tests/{{$test->id}}" class="d-block">{{$test->designation}}</a></h4>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/tests/{{$test->id}}" class="nav-link">
                                <i class="nav-icon fa fa-plus-square-o"></i>
                                <p>Basic Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tests/{{$test->id}}/apparatus" class="nav-link">
                                <i class="nav-icon fa fa-plus-square-o"></i>
                                <p>Apparatus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tests/{{$test->id}}/sample" class="nav-link">
                                <i class="nav-icon fa fa-plus-square-o"></i>
                                <p>Sample Preparation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tests/{{$test->id}}/procedure" class="nav-link">
                                <i class="nav-icon fa fa-plus-square-o"></i>
                                <p>Procedures</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tests/{{$test->id}}/calculation" class="nav-link">
                                <i class="nav-icon fa fa-plus-square-o"></i>
                                <p>Calculation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tests/{{$test->id}}/report" class="nav-link">
                                <i class="nav-icon fa fa-plus-square-o"></i>
                                <p>Report Format</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content');
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">

            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2019 <a href="https://lifelyn.com" target="_blank">Lifeline</a>.</strong> All
            rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ck_scope');
        CKEDITOR.replace('ck_terminology');
        CKEDITOR.replace('ck_use');
        CKEDITOR.replace('ck_preparation');
        CKEDITOR.replace('ck_procedure');
        CKEDITOR.replace('ck_calculation');
        CKEDITOR.replace('ck_report');

    </script>
</body>

</html>
