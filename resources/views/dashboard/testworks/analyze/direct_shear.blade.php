@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col">
            <h3>Direct Shear Analysis Results</h3>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Test 1 Details Analysis (Normal Stress = {{$directshear->nstress1}} kPa)</div>
        <div class="card-body table-responsive">
            <table class="table mb-4 table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Horizontal Displacement (mm)</th>
                        <th>Shear Force (N)</th>
                        <th>Shear Stress (kPa)</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($shear_force1); $i++) 
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$displacement1[$i]}}</td>
                        <td>{{$shear_force1[$i]}}</td>
                        <td>{{$shear_stress1[$i]}}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Test 2 Details Analysis (Normal Stress = {{$directshear->nstress2}} kPa)</div>
        <div class="card-body table-responsive">
            <table class="table mb-4 table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Horizontal Displacement (mm)</th>
                        <th>Shear Force (N)</th>
                        <th>Shear Stress (kPa)</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($shear_force2); $i++) 
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$displacement2[$i]}}</td>
                        <td>{{$shear_force2[$i]}}</td>
                        <td>{{$shear_stress2[$i]}}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Test 3 Details Analysis (Normal Stress = {{$directshear->nstress3}} kPa)</div>
        <div class="card-body table-responsive">
            <table class="table mb-4 table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Horizontal Displacement (mm)</th>
                        <th>Shear Force (N)</th>
                        <th>Shear Stress (kPa)</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($shear_force3); $i++) 
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$displacement3[$i]}}</td>
                        <td>{{$shear_force3[$i]}}</td>
                        <td>{{$shear_stress3[$i]}}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Shear Stress vs Horizontal Displacement Plot</div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <canvas id="sdplot" width="400" height="500"></canvas>
                </div>
            </div>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Shear vs Normal Stress Plot</div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <canvas id="snplot" width="400" height="500"></canvas>
                </div>
            </div>
            <div>
                <h5>C = {{$c}} kPa</h5>
                <h5>φ = {{$phi}} degrees</h5>
            </div>
        </div>
    </div><!-- /.card -->

    {{-- <div class="card">
        <div class="card-title mt-2 mb-0 ml-2">Shear Stress vs Horizontal Displacement Plot</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <canvas id="myChart" width="400" height="275"></canvas>
                </div>
            </div>
            <div>
                <h5>C = {{$c}} kPa</h5>
                <h5>φ = {{$phi}} degrees</h5>
            </div>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-body">
            <div class="text-right d-none d-md-block">
                <a href="/dashboard/direct-shear/{{$directshear->id}}/create-word" class="btn btn-outline-primary">Create Report</a>
                <a href="/dashboard/direct-shear/{{$directshear->id}}/show" class="btn btn-outline-primary">Back to
                    Data</a>
                <a href="/dashboard/direct-shear/{{$directshear->id}}/edit" class="btn btn-outline-primary">Edit
                    Data</a>
            </div>
    
            <div class="text-right d-md-none">
                <a href="/dashboard/direct-shear/{{$directshear->id}}/create-word" class="btn btn-outline-primary">Report</a>
                <a href="/dashboard/direct-shear/{{$directshear->id}}/show" class="btn btn-outline-primary">Back</a>
                <a href="/dashboard/direct-shear/{{$directshear->id}}/edit" class="btn btn-outline-primary">Edit</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- {!! $chart->script() !!} --}}
<script>
    // Shear Stress vs Horizontal Displacement plot
    var sdp = document.getElementById('sdplot').getContext('2d');
    var sdplot1 = {!! json_encode($sdplot1, JSON_HEX_TAG) !!};
    var sdplot2 = {!! json_encode($sdplot2, JSON_HEX_TAG) !!};
    var sdplot3 = {!! json_encode($sdplot3, JSON_HEX_TAG) !!};

    var sdplot = new Chart(sdp, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Test 1',
                data: sdplot1,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#4ca3dd',
                lineTension: 0,
                backgroundColor: '#4ca3dd',
                borderWidth: 1
            },
            {
                label: 'Test 2',
                data: sdplot2,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#db4a26',
                lineTension: 0,
                backgroundColor: '#db4a26',
                borderWidth: 1
            },
            {
                label: 'Test 3',
                data: sdplot3,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#009B77',
                lineTension: 0,
                backgroundColor: '#009B77',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Shear Stress (kPa)'
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Horizontal Displacement (mm)'
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById('snplot').getContext('2d');
    var data = {!! json_encode($data, JSON_HEX_TAG) !!};
    var data2 = {!! json_encode($data2, JSON_HEX_TAG) !!};
    var myChart = new Chart(ctx, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Failure Envelope',
                data: data,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#db4a26',
                lineTension: 0,
                backgroundColor: '#db4a26',
                borderWidth: 1
            },
            {
                label: 'Data points',
                data: data2,
                borderColor: '#000000',
                backgroundColor: '#000000',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Shear Stress (kPa)'
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Normal Stress (kPa)'
                    }
                }]
            }
        }
    });

</script>
@endsection
