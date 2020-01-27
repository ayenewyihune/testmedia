@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col">
            <h3>Borehole Log Details</h3>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">General</div>
        <div class="card-body table-responsive">
            <table class="table table-striped mb-4">
                <tbody>
                    <tr>
                        <td>Project</td>
                        <td style="color:blue">{{$log->project}}</td>
                    </tr>
                    <tr>
                        <td>Client</td>
                        <td style="color:blue">{{$log->client}}</td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td style="color:blue">{{$log->location}}</td>
                    </tr>
                    <tr>
                        <td>Coordinate (X)</td>
                        <td style="color:blue">{{$log->coordinatex}}</td>
                    </tr>
                    <tr>
                        <td>Coordinate (Y)</td>
                        <td style="color:blue">{{$log->coordinatey}}</td>
                    </tr>
                    <tr>
                        <td>Ground Elevation, asl (m)</td>
                        <td style="color:blue">{{$log->elevation}}</td>
                    </tr>
                    <tr>
                        <td>Drilling Method</td>
                        <td style="color:blue">{{$log->drill_method}}</td>
                    </tr>
                    <tr>
                        <td>Borehole ID</td>
                        <td style="color:blue">{{$log->borehole_id}}</td>
                    </tr>
                    <tr>
                        <td>Inclination</td>
                        <td style="color:blue">{{$log->inclination}}</td>
                    </tr>
                    <tr>
                        <td>Total Depth (m)</td>
                        <td style="color:blue">{{$log->depth}}</td>
                    </tr>
                    <tr>
                        <td>Bit Type</td>
                        <td style="color:blue">{{$log->bit_type}}</td>
                    </tr>
                    <tr>
                        <td>Date Started</td>
                        <td style="color:blue">{{$log->start_date}}</td>
                    </tr>
                    <tr>
                        <td>Date Completed</td>
                        <td style="color:blue">{{$log->end_date}}</td>
                    </tr>
                    <tr>
                        <td>Water Level</td>
                        <td style="color:blue">{{$log->water_level}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card">
        <div class="card-body">
            <div class="text-right d-none d-md-block">
                <a href="/dashboard/log/{{$log->id}}/analyze" class="btn btn-outline-primary">Analyze
                    Test Data</a>
                <a href="/dashboard/log/{{$log->id}}/edit" class="btn btn-outline-primary">Edit Test
                    Data</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Delete Test</button>
            </div>

            <div class="text-right d-md-none">
                <a href="/dashboard/log/{{$log->id}}/analyze" class="btn btn-outline-primary mr-2">Analyze</a>
                <a href="/dashboard/log/{{$log->id}}/edit" class="btn btn-outline-primary">Edit</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Delete</button>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal modal-danger fade" id="modal-danger" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="lead">This will delete all the test data...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                    <a href="/dashboard/log/{{$log->id}}/delete" class="btn btn-danger">Delete Anyway</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection
