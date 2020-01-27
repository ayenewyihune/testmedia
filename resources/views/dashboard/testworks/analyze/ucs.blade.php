@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col">
            <h3>UCS Analysis Results</h3>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Basic Sample Values</div>
        <div class="card-body table-responsive">
            <table class="table table-striped mb-4">
                <tbody>
                    <tr>
                        <td>Area</td>
                        <td style="color:#000000">{{$basic[0]}} mm2</td>
                    </tr>
                    <tr>
                        <td>Volume</td>
                        <td style="color:#000000">{{$basic[1]}} mm3</td>
                    </tr>
                    <tr>
                        <td>Wet Unit Weight</td>
                        <td style="color:#000000">{{$basic[2]}} kN/m3</td>
                    </tr>
                    <tr>
                        <td>Water Content</td>
                        <td style="color:#000000">{{$basic[3]}} %</td>
                    </tr>
                    <tr>
                        <td>Dry Unit Weight</td>
                        <td style="color:#000000">{{$basic[4]}} kN/m3</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Test Details Analysis</div>
        <div class="card-body table-responsive">
            <table class="table mb-4 table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Sample Deformation (mm)</th>
                        <th>Strain</th>
                        <th>% Strain</th>
                        <th>Corrected Area (mm2)</th>
                        <th>Load (N)</th>
                        <th>Stress (kPa)</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($load); $i++) 
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$deformation[$i]}}</td>
                        <td>{{round($deformation[$i]/$ucs->height,3)}}</td>
                        <td>{{round($deformation[$i]*100/$ucs->height,1)}}</td>
                        <td>{{round($basic[0]/(1-$deformation[$i]/$ucs->height),3)}}</td>
                        <td>{{$load[$i]}}</td>
                        <td>{{round($load[$i]*1000/($basic[0]/(1-$deformation[$i]/$ucs->height)),3)}}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Stress vs Strain Plot</div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <canvas id="ssplot" width="400" height="500"></canvas>
                    {{-- <img id="url" /> --}}
                </div>
            </div>
        </div>
    </div><!-- /.card -->

    <div class="card card-primary card-outline">
        <div class="card-title mt-2 mb-0 ml-2">Shear vs Normal Stress Plot</div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <canvas id="snplot" height="210"></canvas>
                </div>
            </div>
            <div class="py-4">
                <h5>Unconfined Compressive Strength (qu) = {{$qu}} kPa</h5>
                <h5>Cohesion (Cu) = {{$qu/2}} kPa</h5>
            </div>
        </div>
    </div><!-- /.card -->

    <div class="card">
        <div class="card-body">
            <div class="text-right d-none d-md-block">
                {{-- <button id="createReport" class="btn btn-outline-primary">Create Report</button> --}}
                <a href="/dashboard/ucs/{{$ucs->id}}/create-word" class="btn btn-outline-primary">Create Report</a>
                <a href="/dashboard/ucs/{{$ucs->id}}/show" class="btn btn-outline-primary">Back to
                    Data</a>
                <a href="/dashboard/ucs/{{$ucs->id}}/edit" class="btn btn-outline-primary">Edit
                    Data</a>
            </div>
    
            <div class="text-right d-md-none">
                <a href="/dashboard/ucs/{{$ucs->id}}/create-word" class="btn btn-outline-primary">Report</a>
                <a href="/dashboard/ucs/{{$ucs->id}}/show" class="btn btn-outline-primary">Back</a>
                <a href="/dashboard/ucs/{{$ucs->id}}/edit" class="btn btn-outline-primary">Edit</a>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')
<script>
    // Stress vs Strain plot
    var ssp = document.getElementById('ssplot').getContext('2d');
    var ssplot = {!! json_encode($ssplot, JSON_HEX_TAG) !!};
    var ssplot = new Chart(ssp, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Stress vs Strain Curve',
                data: ssplot,
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
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Axial Stress (kPa)'
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Axial Strain (%)'
                    }
                }]
            }
        }
    });

    // Shear stress vs normal stress plot
    var snp = document.getElementById('snplot').getContext('2d');
    var snplot = {!! json_encode($snplot, JSON_HEX_TAG) !!};
    var snplot = new Chart(snp, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Mohr Circle',
                data: snplot,
                showLine: true,
                pointRadius: 1,
                fill: false,
                borderColor: '#000000',
                lineTension: 0.25,
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

{{-- <script>
document.getElementById('createReport').addEventListener('click', createReport);

function createReport() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (this.status == 200) {
            console.log(this.responseText);
        }
    }
}
</script> --}}
@endsection
