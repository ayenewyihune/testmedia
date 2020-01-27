@extends('layouts.test')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-6">
                <h1 class="m-0 text-dark">Calculation</h1>
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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Calculation</h5>

                <p class="card-text">{!!$test->calculation!!}</p>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
