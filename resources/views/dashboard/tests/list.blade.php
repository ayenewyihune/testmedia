@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col-6">
            <h2 class="d-none d-md-block">List of Tests</h2>
            <h4 class="d-md-none">List of Tests</h4>
        </div>
        <div class="col-6 text-right">
            <a href="/dashboard/tests/create" class="btn btn-primary" style="color: white;">Create Test</a>
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
                            <th>Short Name</th>
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>Date Updated</th>
                            <th>Show Test</th>
                            <th>Edit Test</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tests as $key=>$test)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{!!str_limit($test->designation,40,'...')!!}</td>
                            <td>{!!str_limit($test->name,50,'...')!!}</td>
                            <td>{{$test->created_at->format('d/m/Y')}}</td>
                            <td>{{$test->updated_at->format('d/m/Y')}}</td>
                            <td>
                                <a href="{{route('dashboard.show_test', $test->id)}}"
                                    class="btn btn-primary">Show</>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('dashboard.edit_test', $test->id)}}"
                                    class="btn btn-outline-primary">Edit</>
                                </a>
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
