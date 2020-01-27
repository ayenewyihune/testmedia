@extends('layouts.user')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">SPT Data</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/testworks">Test Works</a></li>
                    <li class="breadcrumb-item active">SPT</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <form action="/dashboard/spt/{{$spt->id}}/update" method="POST">
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
                                    name="institute" value="{{ $spt->institute }}">

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
                                    name="test_date" value="{{ $spt->test_date }}">

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
                                    name="tested_by" value="{{ $spt->tested_by }}">

                                @if ($errors->has('tested_by'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tested_by') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="container-fluild form-group">
                            <label for="boring_number">Boring Number</label>
                            <div>
                                <input id="boring_number" type="text" placeholder="Boring Number"
                                    class="form-control{{ $errors->has('boring_number') ? ' is-invalid' : '' }}"
                                    name="boring_number" value="{{ $spt->boring_number }}">

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
                                    name="sample_depth" value="{{ $spt->sample_depth }}">

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
                                    name="visual_classification" value="{{ $spt->visual_classification }}">

                                @if ($errors->has('visual_classification'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('visual_classification') }}</strong>
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
            <div class="card-title mt-2 mb-0 ml-2">Correction Factors</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="container-fluild form-group">
                            <label for="efficiency">Hammer Efficiency (%)</label>
                            <div>
                                <input id="efficiency" type="number" step="0.01" placeholder="Hammer Efficiency"
                                    class="form-control{{ $errors->has('efficiency') ? ' is-invalid' : '' }}"
                                    name="efficiency" value="{{ $spt->efficiency }}">

                                @if ($errors->has('efficiency'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('efficiency') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="correction_bd">Borehole Diameter Correction</label>
                            <div>
                                <input id="correction_bd" type="number" step="0.00001" placeholder="Diameter Correction"
                                    class="form-control{{ $errors->has('correction_bd') ? ' is-invalid' : '' }}"
                                    name="correction_bd" value="{{ $spt->correction_bd }}">

                                @if ($errors->has('correction_bd'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('correction_bd') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <div class="container-fluild form-group">
                            <label for="correction_s">Sampler Correction</label>
                            <div>
                                <input id="correction_s" type="number" step="0.00001" placeholder="Sampler Correction"
                                    class="form-control{{ $errors->has('correction_s') ? ' is-invalid' : '' }}"
                                    name="correction_s" value="{{ $spt->correction_s }}">

                                @if ($errors->has('correction_s'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('correction_s') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="correction_rl">Road Length Correction</label>
                            <div>
                                <input id="correction_rl" type="number" step="0.00001"
                                    placeholder="Road Length Correction"
                                    class="form-control{{ $errors->has('correction_rl') ? ' is-invalid' : '' }}"
                                    name="correction_rl" value="{{ $spt->correction_rl }}">

                                @if ($errors->has('correction_rl'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('correction_rl') }}</strong>
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
                    <div class="card-title mt-2 mb-0 ml-2">Test Result Data</div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="lemehope" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Depth (m)</th>
                                        <th>ΔN (1st 15cm)</th>
                                        <th>ΔN (2nd 15cm)</th>
                                        <th>ΔN (3rd 15cm)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($spt->spt_details as $i=>$detail)
                                    <tr>
                                        <td class="p-0">
                                            <input id="depth" type="number" step="0.00001"
                                                class="m-0 form-control{{ $errors->has('depth') ? ' is-invalid' : '' }}"
                                                name="depth[{{$i+1}}]" value="{{ $detail->depth }}" required>

                                            @if ($errors->has('depth'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('depth') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                        <td class="p-0">
                                            <input id="dn1" type="number"
                                                class="m-0 form-control{{ $errors->has('dn1') ? ' is-invalid' : '' }}"
                                                name="dn1[{{$i+1}}]" value="{{ $detail->dn1 }}" required>

                                            @if ($errors->has('dn1'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dn1') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                        <td class="p-0">
                                            <input id="dn2" type="number"
                                                class="m-0 form-control{{ $errors->has('dn2') ? ' is-invalid' : '' }}"
                                                name="dn2[{{$i+1}}]" value="{{ $detail->dn2 }}" required>

                                            @if ($errors->has('dn2'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dn2') }}</strong>
                                            </span>
                                            @endif
                                        </td>
                                        <td class="p-0">
                                            <input id="dn3" type="number"
                                                class="m-0 form-control{{ $errors->has('dn3') ? ' is-invalid' : '' }}"
                                                name="dn3[{{$i+1}}]" value="{{ $detail->dn3 }}" required>

                                            @if ($errors->has('dn3'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dn3') }}</strong>
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
