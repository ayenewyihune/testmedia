@extends('layouts.user')

@section('css')
<style>
    .vertical-text {
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col">
            <h3>Borehole Log Sheet</h3>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="card card-primary card-outline">
        <div class="card-body table-responsive">
            <table class="table mb-4 table-bordered">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th colspan="12">Borehole Log Sheet</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- General data --}}
                    <tr>
                        <td colspan="6" class="py-2">Project: {{$log->project}}</td>
                        <td colspan="6" class="py-2">Borehole ID: {{$log->borehole_id}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="py-2">Client: {{$log->client}}</td>
                        <td colspan="6" class="py-2">Inclination: {{$log->inclination}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="py-2">Location: {{$log->location}}</td>
                        <td colspan="6" class="py-2">Total Depth (m): {{$log->depth}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="py-2">Coordinate (X): {{$log->coordinatex}}</td>
                        <td colspan="6" class="py-2">Bit Type: {{$log->bit_type}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="py-2">Coordinate (Y): {{$log->coordinatey}}</td>
                        <td colspan="6" class="py-2">Date Started: {{$log->start_date}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="py-2">Ground Elevation, asl (m): {{$log->elevation}}</td>
                        <td colspan="6" class="py-2">Date Completed: {{$log->end_date}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="py-2">Drilling Method: {{$log->drill_method}}</td>
                        <td colspan="6" class="py-2">Water Level: {{$log->water_level}}</td>
                    </tr>

                    {{-- Header --}}
                    <tr>
                        <td colspan="1" class="vertical-text">Core Run (m)</td>
                        <td colspan="1" class="vertical-text">Graphic Log</td>
                        <td colspan="3">Field Description of Soil/Rock</td>
                        <td colspan="1" class="vertical-text">Borehole Diameter (mm)</td>
                        <td colspan="1" class="vertical-text">TCR (%)</td>
                        <td colspan="1" class="vertical-text">RQD (%)</td>
                        <td colspan="1" class="vertical-text">AFS (%)</td>
                        <td colspan="1" class="vertical-text">SPT</td>
                        <td colspan="1" class="vertical-text">Sampling</td>
                        <td colspan="1" class="vertical-text">GWT</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card">
        <div class="card-body">
            <div class="text-right d-none d-md-block">
                <a href="/dashboard/log/{{$log->id}}/create-word" class="btn btn-outline-primary">Create Report</a>
                <a href="/dashboard/log/{{$log->id}}/show" class="btn btn-outline-primary">Back to
                    Data</a>
                <a href="/dashboard/log/{{$log->id}}/edit" class="btn btn-outline-primary">Edit
                    Data</a>
            </div>
    
            <div class="text-right d-md-none">
                <a href="/dashboard/log/{{$log->id}}/create-word" class="btn btn-outline-primary">Report</a>
                <a href="/dashboard/log/{{$log->id}}/show" class="btn btn-outline-primary">Back</a>
                <a href="/dashboard/log/{{$log->id}}/edit" class="btn btn-outline-primary">Edit</a>
            </div>
        </div>
    </div>

</div>

@endsection
