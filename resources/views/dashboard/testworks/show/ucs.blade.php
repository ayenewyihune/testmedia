@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col">
            <h3>UCS Test Details</h3>
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
                        <td style="color:blue">{{$ucs->institute}}</td>
                    </tr>
                    <tr>
                        <td>Date Tested</td>
                        <td style="color:blue">{{$ucs->test_date}}</td>
                    </tr>
                    <tr>
                        <td>Tested By</td>
                        <td style="color:blue">{{$ucs->tested_by}}</td>
                    </tr>
                    <tr>
                        <td>Boring Number</td>
                        <td style="color:blue">{{$ucs->boring_number}}</td>
                    </tr>
                    <tr>
                        <td>Sample Depth (m)</td>
                        <td style="color:blue">{{$ucs->sample_depth}}</td>
                    </tr>
                    <tr>
                        <td>Visual Classification</td>
                        <td style="color:blue">{{$ucs->visual_classification}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Mass and Dimension of Sample</div>
        <div class="card-body table-responsive">
            <table class="table table-striped mb-4">
                <tbody>
                    <tr>
                        <td>Diameter (mm)</td>
                        <td style="color:blue">{{$ucs->diameter}}</td>
                    </tr>
                    <tr>
                        <td>Height (mm)</td>
                        <td style="color:blue">{{$ucs->height}}</td>
                    </tr>
                    <tr>
                        <td>Mass (gm)</td>
                        <td style="color:blue">{{$ucs->mass}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Water Content</div>
        <div class="card-body table-responsive">
            <table class="table table-striped mb-4">
                <tbody>
                    <tr>
                        <td>Can No.</td>
                        <td style="color:blue">{{$ucs->can_no}}</td>
                    </tr>
                    <tr>
                        <td>Mass of Can (gm)</td>
                        <td style="color:blue">{{$ucs->can_mass}}</td>
                    </tr>
                    <tr>
                        <td>Mass of Can + Moist Soil (gm)</td>
                        <td style="color:blue">{{$ucs->candms_mass}}</td>
                    </tr>
                    <tr>
                        <td>Mass of Can + Dry Soil (gm)</td>
                        <td style="color:blue">{{$ucs->candds_mass}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
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
                        <th>Deformation (mm)</th>
                        <th>Load (N)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ucs->ucs_details as $key=>$detail)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$detail->deformation}}</td>
                        <td>{{$detail->load}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card">
        <div class="card-body">
            <div class="text-right d-none d-md-block">
                <a href="/dashboard/ucs/{{$ucs->id}}/analyze" class="btn btn-outline-primary">Analyze
                    Test Data</a>
                <a href="/dashboard/ucs/{{$ucs->id}}/edit" class="btn btn-outline-primary">Edit Test
                    Data</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Delete Test</button>
            </div>

            <div class="text-right d-md-none">
                <a href="/dashboard/ucs/{{$ucs->id}}/analyze" class="btn btn-outline-primary mr-2">Analyze</a>
                <a href="/dashboard/ucs/{{$ucs->id}}/edit" class="btn btn-outline-primary">Edit</a>
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
                    <a href="/dashboard/ucs/{{$ucs->id}}/delete" class="btn btn-danger">Delete Anyway</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection
