@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col-6">
            <h2 class="d-none d-md-block">List of Test Works</h2>
            <h4 class="d-md-none">List of Test Works</h4>
        </div>
        <div class="col-6 text-right">
            <a href="/dashboard/select-test" class="btn btn-primary" style="color: white;">Create Test Work</a>
        </div>
    </div>
</div>

<div class="container box">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table id="lemehope" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Institute (Company)</th>
                            <th>Test Type</th>
                            <th>Test Date</th>
                            <th>Show</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testworks as $key=>$testwork)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$testwork->institute}}</td>
                            <td>{{$testwork->test->designation}}</td>
                            <td>{{$testwork->test_date}}</td>
                            <td>
                                @if ($testwork->test->designation == 'Direct Shear')
                                <a href="/dashboard/direct-shear/{{$testwork->testwork_id}}/show" class="btn btn-primary">Show</>
                                </a>
                                @elseif ($testwork->test->designation == 'UCS')
                                <a href="/dashboard/ucs/{{$testwork->testwork_id}}/show" class="btn btn-primary">Show</>
                                </a>
                                @elseif ($testwork->test->designation == 'Triaxial (UU)')
                                <a href="/dashboard/uu-triaxial/{{$testwork->testwork_id}}/show" class="btn btn-primary">Show</>
                                </a>
                                @elseif ($testwork->test->designation == 'SPT')
                                <a href="/dashboard/spt/{{$testwork->testwork_id}}/show" class="btn btn-primary">Show</>
                                </a>
                                @elseif ($testwork->test->designation == 'Logging')
                                <a href="/dashboard/log/{{$testwork->testwork_id}}/show" class="btn btn-primary">Show</>
                                </a>
                                @endif
                            </td>
                            <td>
                                @if ($testwork->test->designation == 'Direct Shear')
                                <a href="/dashboard/direct-shear/{{$testwork->testwork_id}}/edit" class="btn btn-primary">Edit</>
                                </a>
                                @elseif ($testwork->test->designation == 'UCS')
                                <a href="/dashboard/ucs/{{$testwork->testwork_id}}/edit" class="btn btn-primary">Edit</>
                                </a>
                                @elseif ($testwork->test->designation == 'Triaxial (UU)')
                                <a href="/dashboard/uu-triaxial/{{$testwork->testwork_id}}/edit" class="btn btn-primary">Edit</>
                                </a>
                                @elseif ($testwork->test->designation == 'SPT')
                                <a href="/dashboard/spt/{{$testwork->testwork_id}}/edit" class="btn btn-primary">Edit</>
                                </a>
                                @elseif ($testwork->test->designation == 'Logging')
                                <a href="/dashboard/log/{{$testwork->testwork_id}}/edit" class="btn btn-primary">Edit</>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
