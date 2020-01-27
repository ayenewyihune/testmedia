@extends('layouts.user')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Direct Shear Data</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/testworks">Test Works</a></li>
                    <li class="breadcrumb-item active">Direct Shear Data</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <form action="/dashboard/direct-shear/{{$directshear->id}}/update" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="card card-primary card-outline">
            <div class="card-title mt-2 mb-0 ml-2">General</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="container-fluild form-group">
                            <label for="institute">Institute (Company)</label>
                            <div>
                                <input id="institute" type="text" placeholder="Institute (Company)"
                                    class="form-control{{ $errors->has('institute') ? ' is-invalid' : '' }}"
                                    name="institute" value="{{ $directshear->institute }}" required>

                                @if ($errors->has('institute'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('institute') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="test_date">Date Tested</label>
                            <div>
                                <input id="test_date" type="text" placeholder="Date Tested"
                                    class="form-control{{ $errors->has('test_date') ? ' is-invalid' : '' }}"
                                    name="test_date" value="{{ $directshear->test_date }}" required>

                                @if ($errors->has('test_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('test_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="visual_classification">Visual Classification</label>
                            <div>
                                <input id="visual_classification" type="text" placeholder="Visual Classification"
                                    class="form-control{{ $errors->has('visual_classification') ? ' is-invalid' : '' }}"
                                    name="visual_classification" value="{{ $directshear->visual_classification }}">

                                @if ($errors->has('visual_classification'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('visual_classification') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="container-fluild form-group">
                            <label for="tested_by">Tested By</label>
                            <div>
                                <input id="tested_by" type="text" placeholder="Tested By"
                                    class="form-control{{ $errors->has('tested_by') ? ' is-invalid' : '' }}"
                                    name="tested_by" value="{{ $directshear->tested_by }}" required>

                                @if ($errors->has('tested_by'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tested_by') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="boring_number">Boring Number</label>
                            <div>
                                <input id="boring_number" type="text" placeholder="Boring Number"
                                    class="form-control{{ $errors->has('boring_number') ? ' is-invalid' : '' }}"
                                    name="boring_number" value="{{ $directshear->boring_number }}">

                                @if ($errors->has('boring_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('boring_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="sample_depth">Sample Depth (m)</label>
                            <div>
                                <input id="sample_depth" type="number" step="0.00001" placeholder="Sample Depth"
                                    class="form-control{{ $errors->has('sample_depth') ? ' is-invalid' : '' }}"
                                    name="sample_depth" value="{{ $directshear->sample_depth }}">

                                @if ($errors->has('sample_depth'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('sample_depth') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div><!-- /.card -->

        <div class="card card-primary card-outline">
            <div class="card-title mt-2 mb-0 ml-2">Sample Properties</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="container-fluild form-group">
                            <label for="diameter">Diameter (mm)</label>
                            <div>
                                <input id="diameter" type="text" placeholder="Diameter (mm)"
                                    class="form-control{{ $errors->has('diameter') ? ' is-invalid' : '' }}"
                                    name="diameter" value="{{ $directshear->diameter }}" required>

                                @if ($errors->has('diameter'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('diameter') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="height">Height (mm) [Optional]</label>
                            <div>
                                <input id="height" type="text" placeholder="Height (mm)"
                                    class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height"
                                    value="{{ $directshear->height }}">

                                @if ($errors->has('height'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="container-fluild form-group">
                            <label for="mass">Mass (gm) [Optional]</label>
                            <div>
                                <input id="mass" type="text" placeholder="Mass (gm)"
                                    class="form-control{{ $errors->has('mass') ? ' is-invalid' : '' }}" name="mass"
                                    value="{{ $directshear->mass }}">

                                @if ($errors->has('mass'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mass') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div><!-- /.card -->

        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-title mt-2 mb-0 ml-2">Test 1 Data</div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="container-fluild form-group">
                                    <label for="nstress1">Normal Stress (kPa)</label>
                                    <div>
                                        <input id="nstress1" type="text" placeholder="Normal Stress (kPa)"
                                            class="form-control{{ $errors->has('nstress1') ? ' is-invalid' : '' }}"
                                            name="nstress1" value="{{ $directshear->nstress1 }}" required>

                                        @if ($errors->has('nstress1'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nstress1') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="lemehope" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Horizontal Displacement (mm)</th>
                                        <th>Shear Force (N)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail1 as $i=>$detail) 
                                    <tr>
                                        <td class="p-0">
                                            <input id="displacement1" type="number" step="0.00001"
                                                class="m-0 form-control{{ $errors->has('displacement1') ? ' is-invalid' : '' }}"
                                                name="displacement1[{{$i+1}}]" value="{{ $detail->displacement }}"
                                                required>

                                            @if ($errors->has('displacement1'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('displacement1') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                        <td class="p-0">
                                            <input id="shear_force1" type="number" step="0.00001"
                                                class="m-0 form-control{{ $errors->has('shear_force1') ? ' is-invalid' : '' }}"
                                                name="shear_force1[{{$i+1}}]" value="{{ $detail->shear_force }}" required>

                                            @if ($errors->has('shear_force1'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('shear_force1') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div><!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-title mt-2 mb-0 ml-2">Test 2 Data</div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="container-fluild form-group">
                                    <label for="nstress2">Normal Stress (kPa)</label>
                                    <div>
                                        <input id="nstress2" type="text" placeholder="Normal Stress (kPa)"
                                            class="form-control{{ $errors->has('nstress2') ? ' is-invalid' : '' }}"
                                            name="nstress2" value="{{ $directshear->nstress2 }}" required>

                                        @if ($errors->has('nstress2'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nstress2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="lemehope" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Horizontal Displacement (mm)</th>
                                        <th>Shear Force (N)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail2 as $i=>$detail)
                                    <tr>
                                        <td class="p-0">
                                            <input id="displacement2" type="number" step="0.00001"
                                                class="m-0 form-control{{ $errors->has('displacement2') ? ' is-invalid' : '' }}"
                                                name="displacement2[{{$i+1}}]" value="{{ $detail->displacement }}"
                                                required>

                                            @if ($errors->has('displacement2'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('displacement2') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                        <td class="p-0">
                                            <input id="shear_force2" type="number" step="0.00001"
                                                class="m-0 form-control{{ $errors->has('shear_force2') ? ' is-invalid' : '' }}"
                                                name="shear_force2[{{$i+1}}]" value="{{ $detail->shear_force }}" required>

                                            @if ($errors->has('shear_force2'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('shear_force2') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div><!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-title mt-2 mb-0 ml-2">Test 3 Data</div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="container-fluild form-group">
                                    <label for="nstress3">Normal Stress (kPa)</label>
                                    <div>
                                        <input id="nstress3" type="text" placeholder="Normal Stress (kPa)"
                                            class="form-control{{ $errors->has('nstress3') ? ' is-invalid' : '' }}"
                                            name="nstress3" value="{{ $directshear->nstress3 }}" required>

                                        @if ($errors->has('nstress3'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nstress3') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="lemehope" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Horizontal Displacement (mm)</th>
                                        <th>Shear Force (N)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail3 as $i=>$detail) 
                                    <tr>
                                        <td class="p-0">
                                            <input id="displacement3" type="number" step="0.00001"
                                                class="m-0 form-control{{ $errors->has('displacement3') ? ' is-invalid' : '' }}"
                                                name="displacement3[{{$i+1}}]" value="{{ $detail->displacement }}"
                                                required>

                                            @if ($errors->has('displacement3'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('displacement3') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                        <td class="p-0">
                                            <input id="shear_force3" type="number" step="0.00001"
                                                class="m-0 form-control{{ $errors->has('shear_force3') ? ' is-invalid' : '' }}"
                                                name="shear_force3[{{$i+1}}]" value="{{ $detail->shear_force }}" required>

                                            @if ($errors->has('shear_force3'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('shear_force3') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div><!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

        <div class="text-right">
            <button type="submit" class="btn btn-danger" style="min-width:120px">Update</button>
        </div>
    </form>
</div>
<!-- /.content -->
@endsection
