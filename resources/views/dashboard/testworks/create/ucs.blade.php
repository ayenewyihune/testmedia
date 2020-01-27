@extends('layouts.user')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">UCS Data</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/testworks">Test Works</a></li>
                    <li class="breadcrumb-item active">UCS</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <form action="/dashboard/ucs/store" method="POST">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-title mt-2 mb-0 ml-2">General</div>
                    <div class="card-body">
                        <div class="container-fluild form-group">
                            <label for="institute">Institute (Company)</label>
                            <div>
                                <input id="institute" type="text" placeholder="Institute (Company)"
                                    class="form-control{{ $errors->has('institute') ? ' is-invalid' : '' }}"
                                    name="institute" value="{{ old('institute') }}">

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
                                    name="test_date" value="{{ old('test_date') }}">

                                @if ($errors->has('test_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('test_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="tested_by">Tested By</label>
                            <div>
                                <input id="tested_by" type="text" placeholder="Tested By"
                                    class="form-control{{ $errors->has('tested_by') ? ' is-invalid' : '' }}"
                                    name="tested_by" value="{{ old('tested_by') }}">

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
                                    name="boring_number" value="{{ old('boring_number') }}">

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
                                    name="sample_depth" value="{{ old('sample_depth') }}">

                                @if ($errors->has('sample_depth'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('sample_depth') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="visual_classification">Visual Classification</label>
                            <div>
                                <input id="visual_classification" type="text" placeholder="Visual Classification"
                                    class="form-control{{ $errors->has('visual_classification') ? ' is-invalid' : '' }}"
                                    name="visual_classification" value="{{ old('visual_classification') }}">

                                @if ($errors->has('visual_classification'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('visual_classification') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div><!-- /.card -->

                <div class="card card-primary card-outline">
                    <div class="card-title mt-2 mb-0 ml-2">Sample Mass (gm)</div>
                    <div class="card-body">
                        <div class="container-fluild form-group">
                            <div>
                                <input id="mass" type="number" step="0.00001" placeholder="Mass"
                                    class="form-control{{ $errors->has('mass') ? ' is-invalid' : '' }}" name="mass"
                                    value="{{ old('mass') }}" required>

                                @if ($errors->has('mass'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mass') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div><!-- /.card -->
            </div>

            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-title mt-2 mb-0 ml-2">Sample Dimensions</div>
                    <div class="card-body">

                        <div class="container-fluild form-group">
                            <label for="diameter">Diameter (mm)</label>
                            <div>
                                <input id="diameter" type="number" step="0.00001" placeholder="Diameter"
                                    class="form-control{{ $errors->has('diameter') ? ' is-invalid' : '' }}"
                                    name="diameter" value="{{ old('diameter') }}" required>

                                @if ($errors->has('diameter'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('diameter') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="height">Height (mm)</label>
                            <div>
                                <input id="height" type="number" step="0.00001" placeholder="Height"
                                    class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height"
                                    value="{{ old('height') }}" required>

                                @if ($errors->has('height'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div><!-- /.card -->

                <div class="card card-primary card-outline">
                    <div class="card-title mt-2 mb-0 ml-2">Water Content</div>
                    <div class="card-body">

                        <div class="container-fluild form-group">
                            <label for="can_no">Can No.</label>
                            <div>
                                <input id="can_no" type="text" placeholder="Can No."
                                    class="form-control{{ $errors->has('can_no') ? ' is-invalid' : '' }}" name="can_no"
                                    value="{{ old('can_no') }}" required>

                                @if ($errors->has('can_no'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('can_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="can_mass">Mass of Can (gm)</label>
                            <div>
                                <input id="can_mass" type="number" step="0.00001" placeholder="Mass of Can"
                                    class="form-control{{ $errors->has('can_mass') ? ' is-invalid' : '' }}"
                                    name="can_mass" value="{{ old('can_mass') }}" required>

                                @if ($errors->has('can_mass'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('can_mass') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="candms_mass">Mass of Can + Moist Soil (gm)</label>
                            <div>
                                <input id="candms_mass" type="number" step="0.00001"
                                    placeholder="Mass of Can + Moist Soil"
                                    class="form-control{{ $errors->has('candms_mass') ? ' is-invalid' : '' }}"
                                    name="candms_mass" value="{{ old('candms_mass') }}" required>

                                @if ($errors->has('candms_mass'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('candms_mass') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="candds_mass">Mass of Can + Dry Soil (gm)</label>
                            <div>
                                <input id="candds_mass" type="number" step="0.00001" placeholder="Mass of Can + Dry Soil"
                                    class="form-control{{ $errors->has('candds_mass') ? ' is-invalid' : '' }}"
                                    name="candds_mass" value="{{ old('candds_mass') }}" required>

                                @if ($errors->has('candds_mass'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('candds_mass') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div><!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-title mt-2 mb-0 ml-2">Test Result Data</div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Deformation (mm)</th>
                                        <th>Load (N)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 1; $i <= $records_count; $i++) <tr>
                                        <td class="p-0">
                                            <input id="deformation" type="number" step="0.00001"
                                                class="m-0 form-control{{ $errors->has('deformation') ? ' is-invalid' : '' }}"
                                                name="deformation[{{$i}}]" value="{{ old('deformation') }}" required>

                                            @if ($errors->has('deformation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('deformation') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                        <td class="p-0">
                                            <input id="load" type="number" step="0.00001"
                                                class="m-0 form-control{{ $errors->has('load') ? ' is-invalid' : '' }}"
                                                name="load[{{$i}}]" value="{{ old('load') }}" required>

                                            @if ($errors->has('load'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('load') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                        </tr>
                                        @endfor
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div><!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
        <div class="text-right">
            <button type="submit" class="btn btn-primary" style="min-width:120px">Create</button>
        </div>
    </form>
</div>
<!-- /.content -->
@endsection
