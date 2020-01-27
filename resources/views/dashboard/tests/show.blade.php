@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="container py-4">
        <h2 class="d-none d-md-block">{!!str_limit($test->name,150,'...')!!}</h2>
        <h4 class="d-md-none">{!!str_limit($test->name,150,'...')!!}</h4>
    </div>
</div>

<div class="container-fluid">

    <div class="form-group">
        <label for="designation">Short Name</label>
        <div class="container">{!!$test->designation!!}</div>
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        <div class="container">{!!$test->name!!}</div>
    </div>

    <div class="form-group">
        <label for="scope">Scope</label>
        <div class="container">{!!$test->scope!!}</div>
    </div>

    <div class="form-group">
        <label for="reference">Reference</label>
        <div class="container">{!!$test->reference!!}</div>
    </div>

    <div class="form-group">
        <label for="terminology">Terminology</label>
        <div class="container">{!!$test->terminology!!}</div>
    </div>

    <div class="form-group">
        <label for="use">Use</label>
        <div class="container">{!!$test->use!!}</div>
    </div>

    <div class="form-group">
        <label for="preparation">Preparation</label>
        <div class="container">{!!$test->preparation!!}</div>
    </div>

    <div class="form-group">
        <label for="procedure">Procedure</label>
        <div class="container">{!!$test->procedure!!}</div>
    </div>

    <div class="form-group">
        <label for="calculation">Calculation</label>
        <div class="container">{!!$test->calculation!!}</div>
    </div>

    <div class="form-group">
        <label for="report">Report</label>
        <div class="container">{!!$test->report!!}</div>
    </div>

    <div class="text-right">
        <a href="/dashboard/tests/{{$test->id}}/edit" class="btn btn-outline-primary">Edit Test</a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Delete Test</button>
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
                    <a href="/dashboard/tests/{{$test->id}}/delete" class="btn btn-danger">Delete Anyway</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection
