@extends('layouts.test')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-6">
                <h1 class="m-0 text-dark">Basic Data</h1>
            </div><!-- /.col -->
            <div class="col-6 text-right">
                @if ($test->designation == 'Direct Shear')
                <a href="/dashboard/direct-shear/records" class="btn btn-primary" style="color: white;">Create Test
                    Work</a>
                @elseif ($test->designation == 'UCS')
                <a href="/dashboard/ucs/records" class="btn btn-primary" style="color: white;">Create Test Work</a>
                @elseif ($test->designation == 'SPT')
                <a href="/dashboard/spt/records" class="btn btn-primary" style="color: white;">Create Test Work</a>
                @elseif ($test->designation == 'TRIAXIAL(UU)')
                <a href="/dashboard/uu-triaxial/create" class="btn btn-primary" style="color: white;">Create Test Work</a>
                @endif
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Test name</h5>

                        <p class="card-text">{!!$test->name!!}</p>
                    </div>
                </div><!-- /.card -->

                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Scope</h5>

                        <p class="card-text">{!!$test->scope!!}</p>
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Reference</h5>

                        <p class="card-text">{!!$test->reference!!}</p>
                    </div>
                </div><!-- /.card -->

                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Terminology</h5>

                        <p class="card-text">{!!$test->terminology!!}</p>
                    </div>
                </div><!-- /.card -->

                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Use</h5>

                        <p class="card-text">{!!$test->use!!}</p>
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
