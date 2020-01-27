@extends('layouts.user')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Borehole Data</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/testworks">Test Works</a></li>
                    <li class="breadcrumb-item active">Borehole Log</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <form action="/dashboard/log/store" method="POST">
        {{ csrf_field() }}

        <div class="card card-primary card-outline">
            <div class="card-title mt-2 mb-0 ml-2">General</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="container-fluild form-group">
                            <label for="project">Project</label>
                            <div>
                                <input id="project" type="text" placeholder="Project"
                                    class="form-control{{ $errors->has('project') ? ' is-invalid' : '' }}"
                                    name="project" value="{{ old('project') }}" required>

                                @if ($errors->has('project'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('project') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="client">Client</label>
                            <div>
                                <input id="client" type="text" placeholder="Client"
                                    class="form-control{{ $errors->has('client') ? ' is-invalid' : '' }}"
                                    name="client" value="{{ old('client') }}" required>

                                @if ($errors->has('client'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('client') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="location">Location</label>
                            <div>
                                <input id="location" type="text" placeholder="Location"
                                    class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                    name="location" value="{{ old('location') }}" required>

                                @if ($errors->has('location'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="coordinatex">Coordinate (X)</label>
                            <div>
                                <input id="coordinatex" type="text" placeholder="Coordinate"
                                    class="form-control{{ $errors->has('coordinatex') ? ' is-invalid' : '' }}"
                                    name="coordinatex" value="{{ old('coordinatex') }}" required>

                                @if ($errors->has('coordinatex'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('coordinatex') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="coordinatey">Coordinate (Y)</label>
                            <div>
                                <input id="coordinatey" type="text" placeholder="Coordinate"
                                    class="form-control{{ $errors->has('coordinatey') ? ' is-invalid' : '' }}"
                                    name="coordinatey" value="{{ old('coordinatey') }}" required>

                                @if ($errors->has('coordinatey'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('coordinatey') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="elevation">Ground Elevation, asl (m)</label>
                            <div>
                                <input id="elevation" type="text" placeholder="Ground Elevation"
                                    class="form-control{{ $errors->has('elevation') ? ' is-invalid' : '' }}"
                                    name="elevation" value="{{ old('elevation') }}" required>

                                @if ($errors->has('elevation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('elevation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="drill_method">Drilling Method</label>
                            <div>
                                <input id="drill_method" type="text" placeholder="Drilling Method"
                                    class="form-control{{ $errors->has('drill_method') ? ' is-invalid' : '' }}"
                                    name="drill_method" value="{{ old('drill_method') }}" required>

                                @if ($errors->has('drill_method'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('drill_method') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        
                        <div class="container-fluild form-group">
                            <label for="borehole_id">Borehole ID</label>
                            <div>
                                <input id="borehole_id" type="text" placeholder="Borehole ID"
                                    class="form-control{{ $errors->has('borehole_id') ? ' is-invalid' : '' }}"
                                    name="borehole_id" value="{{ old('borehole_id') }}" required>

                                @if ($errors->has('borehole_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('borehole_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="inclination">Inclination</label>
                            <div>
                                <input id="inclination" type="text" placeholder="Inclination"
                                    class="form-control{{ $errors->has('inclination') ? ' is-invalid' : '' }}"
                                    name="inclination" value="{{ old('inclination') }}" required>

                                @if ($errors->has('inclination'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('inclination') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="depth">Total Depth (m)</label>
                            <div>
                                <input id="depth" type="number" step="0.001" placeholder="Depth"
                                    class="form-control{{ $errors->has('depth') ? ' is-invalid' : '' }}"
                                    name="depth" value="{{ old('depth') }}" required>

                                @if ($errors->has('depth'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('depth') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="bit_type">Bit Type</label>
                            <div>
                                <input id="bit_type" type="text" placeholder="Bit Type"
                                    class="form-control{{ $errors->has('bit_type') ? ' is-invalid' : '' }}"
                                    name="bit_type" value="{{ old('bit_type') }}" required>

                                @if ($errors->has('bit_type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bit_type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="start_date">Date Started</label>
                            <div>
                                <input id="start_date" type="text" placeholder="Date Started"
                                    class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                                    name="start_date" value="{{ old('start_date') }}" required>

                                @if ($errors->has('start_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="end_date">Date Completed</label>
                            <div>
                                <input id="end_date" type="text" placeholder="Date Completed"
                                    class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                                    name="end_date" value="{{ old('end_date') }}" required>

                                @if ($errors->has('end_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <label for="water_level">Water Level</label>
                            <div>
                                <input id="water_level" type="text" placeholder="Water Level"
                                    class="form-control{{ $errors->has('water_level') ? ' is-invalid' : '' }}"
                                    name="water_level" value="{{ old('water_level') }}" required>

                                @if ($errors->has('water_level'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('water_level') }}</strong>
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
            <div class="card-title mt-2 mb-0 ml-2">Core Run</div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="core_run">
                        <thead>
                            <tr>
                                <th>Bottom Depth (m)</th>
                                <th>TCR (%)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="p-0">
                                <input id="core_depth" type="number" step="0.00001"
                                    class="m-0 form-control{{ $errors->has('core_depth') ? ' is-invalid' : '' }}"
                                    name="core_depth[]" value="{{ old('core_depth') }}" required>

                                @if ($errors->has('core_depth'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('core_depth') }}</strong>
                                </span>
                                @endif
                            </td>
                            <td class="p-0">
                                <input id="tcr" type="number" step="0.00001"
                                    class="m-0 form-control{{ $errors->has('tcr') ? ' is-invalid' : '' }}"
                                    name="tcr[]" value="{{ old('tcr') }}" required>

                                @if ($errors->has('tcr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tcr') }}</strong>
                                </span>
                                @endif
                            </td>
                            <td class="p-0 text-center">
                                <button name="add" id="add" class="btn btn-primary">Add More</button>
                            </td>
                        </tbody>
                    </table>
                </div>

            </div>
        </div><!-- /.card -->

        <div class="text-right">
            <button type="submit" class="btn btn-primary" style="min-width:120px">Create</button>
        </div>
    </form>
</div>
<!-- /.content -->
@endsection

@section('js')
<script>
$(document).ready(function() {
    var i = 1;
    $('#add').click(function() {
        i++;
        $('#core_run').append(
            '<tr><td><input type="number"'
        )
    })
})
</script>
@endsection