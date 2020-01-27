@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col">
            <h3>SPT Analysis Results</h3>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Adjusted N values</div>
        <div class="card-body table-responsive">
            <table class="table mb-4 table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Depth (m)</th>
                        <th>N</th>
                        <th>N60</th>
                        <th>N70</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($n); $i++) 
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$depth[$i]}}</td>
                        <td>{{$n[$i]}}</td>
                        <td>{{$n60[$i]}}</td>
                        <td>{{$n70[$i]}}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2 d-none d-md-block">Allowable Bearing Capacity According to Bowels</div>
        <div class="card-title mt-2 mb-0 ml-2 d-md-none">Allowable Bearing Capacity</div>
        <div class="card-body table-responsive">
            <table class="table mb-4 table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th colspan="3">No.</th>
                        <th colspan="3">Depth (m)</th>
                        <th colspan="7" class="text-center">Allowable Bearing Capacity (kPa)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                        @for ($i = 1.5; $i < 4.5; $i=$i+0.5) 
                        <td colspan="1">B = {{$i}} m</td>
                        @endfor
                    </tr>
                    @for ($j = 0; $j < count($depth); $j++)
                    <tr>
                        <td colspan="3">{{$j+1}}</td>
                        <td colspan="3">{{$depth[$j]}}</td>
                        @for ($i = 0; $i < 6; $i++) 
                        <td colspan="1">{{$bc[$j][$i]}}</td>
                        @endfor
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">N value vs Depth Plot</div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <canvas id="nplot" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Bearing Capacity vs Depth Plot</div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <canvas id="bcplot" width="400" height="500"></canvas>
                </div>
            </div>
        </div>
    </div><!-- /.card -->

    <div class="card">
        <div class="card-body">
            <div class="text-right d-none d-md-block">
                <a href="/dashboard/spt/{{$spt->id}}/create-word" class="btn btn-outline-primary">Create Report</a>
                <a href="/dashboard/spt/{{$spt->id}}/show" class="btn btn-outline-primary">Back to
                    Data</a>
                <a href="/dashboard/spt/{{$spt->id}}/edit" class="btn btn-outline-primary">Edit
                    Data</a>
            </div>
    
            <div class="text-right d-md-none">
                <a href="/dashboard/spt/{{$spt->id}}/create-word" class="btn btn-outline-primary">Report</a>
                <a href="/dashboard/spt/{{$spt->id}}/show" class="btn btn-outline-primary">Back</a>
                <a href="/dashboard/spt/{{$spt->id}}/edit" class="btn btn-outline-primary">Edit</a>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')
<script>
    // N value vs depth plot
    var np = document.getElementById('nplot').getContext('2d');
    var nplot = {!! json_encode($nplot, JSON_HEX_TAG) !!};
    var nplot = new Chart(np, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'N value with Depth',
                data: nplot,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#000000',
                lineTension: 0,
                backgroundColor: '#000000',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        reverse: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Depth (m)'
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'N Value'
                    }
                }]
            }
        }
    });

    // Bearing capacity vs depth plot
    var bcp = document.getElementById('bcplot').getContext('2d');
    var bcplot1p5 = {!! json_encode($bcplot1p5, JSON_HEX_TAG) !!};
    var bcplot2 = {!! json_encode($bcplot2, JSON_HEX_TAG) !!};
    var bcplot2p5 = {!! json_encode($bcplot2p5, JSON_HEX_TAG) !!};
    var bcplot3 = {!! json_encode($bcplot3, JSON_HEX_TAG) !!};
    var bcplot3p5 = {!! json_encode($bcplot3p5, JSON_HEX_TAG) !!};
    var bcplot4 = {!! json_encode($bcplot4, JSON_HEX_TAG) !!};
    var bcplot = new Chart(bcp, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'B = 1.5 m',
                data: bcplot1p5,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#4ca3dd',
                lineTension: 0,
                backgroundColor: '#4ca3dd',
                borderWidth: 1
            },
            {
                label: 'B = 2 m',
                data: bcplot2,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#db4a26',
                lineTension: 0,
                backgroundColor: '#db4a26',
                borderWidth: 1
            },
            {
                label: 'B = 2.5 m',
                data: bcplot2p5,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#009B77',
                lineTension: 0,
                backgroundColor: '#009B77',
                borderWidth: 1
            },
            {
                label: 'B = 3 m',
                data: bcplot3,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#454545',
                lineTension: 0,
                backgroundColor: '#454545',
                borderWidth: 1
            },
            {
                label: 'B = 3.5 m',
                data: bcplot3p5,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#EFC050',
                lineTension: 0,
                backgroundColor: '#EFC050',
                borderWidth: 1
            },
            {
                label: 'B = 4 m',
                data: bcplot4,
                showLine: true,
                fill: false,
                pointRadius: 2,
                borderColor: '#5B5EA6',
                lineTension: 0,
                backgroundColor: '#5B5EA6',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        reverse: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Depth (m)'
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Bearing Capacity (kPa)'
                    }
                }]
            }
        }
    });

</script>
@endsection
