@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col">
            <h3>SPT Details</h3>
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
                        <td>Institute (Company)</td>
                        <td style="color:blue">{{$spt->institute}}</td>
                    </tr>
                    <tr>
                        <td>Date Tested</td>
                        <td style="color:blue">{{$spt->test_date}}</td>
                    </tr>
                    <tr>
                        <td>Tested By</td>
                        <td style="color:blue">{{$spt->tested_by}}</td>
                    </tr>
                    <tr>
                        <td>Boring Number</td>
                        <td style="color:blue">{{$spt->boring_number}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Correction Coefficients</div>
        <div class="card-body table-responsive">
            <table class="table table-striped mb-4">
                <tbody>
                    <tr>
                        <td>Hammer Efficiency (%)</td>
                        <td style="color:blue">{{$spt->efficiency}}</td>
                    </tr>
                    <tr>
                        <td>Borehole Diameter Correction</td>
                        <td style="color:blue">{{$spt->correction_bd}}</td>
                    </tr>
                    <tr>
                        <td>Sampler Correction</td>
                        <td style="color:blue">{{$spt->correction_s}}</td>
                    </tr>
                    <tr>
                        <td>Road Length Correction</td>
                        <td style="color:blue">{{$spt->correction_rl}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Test Details</div>
        <div class="card-body table-responsive">
            <table class="table mb-4 table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Depth (m)</th>
                        <th>ΔN (1st 15cm)</th>
                        <th>ΔN (2nd 15cm)</th>
                        <th>ΔN (3rd 15cm)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spt->spt_details as $key=>$detail)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$detail->depth}}</td>
                        <td>{{$detail->dn1}}</td>
                        <td>{{$detail->dn2}}</td>
                        <td>{{$detail->dn3}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card">
        <div class="card-body">
            <div class="text-right d-none d-md-block">
                <a href="/dashboard/spt/{{$spt->id}}/analyze" class="btn btn-outline-primary">Analyze
                    Test Data</a>
                <a href="/dashboard/spt/{{$spt->id}}/edit" class="btn btn-outline-primary">Edit Test
                    Data</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Delete Test</button>
            </div>

            <div class="text-right d-md-none">
                <a href="/dashboard/spt/{{$spt->id}}/analyze" class="btn btn-outline-primary mr-2">Analyze</a>
                <a href="/dashboard/spt/{{$spt->id}}/edit" class="btn btn-outline-primary">Edit</a>
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
                    <a href="/dashboard/spt/{{$spt->id}}/delete" class="btn btn-danger">Delete Anyway</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection
