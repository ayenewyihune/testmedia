@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col-6">
            <h2 class="d-none d-md-block">Edit Test</h2>
            <h4 class="d-md-none">Edit Test</h4>
        </div>
    </div>
</div>

<div class="container-fluid">
    <form action="/dashboard/tests/{{$test->id}}/update" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label for="designation">Short Name</label>
            <div>
                <select id="designation" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}"
                    name="designation" required>
                    <option></option>
                    <option value="Direct Shear" @if($test->designation=='Direct Shear') selected='selected' @endif>Direct Shear Test</option>
                    {{-- <option value="Triaxial (UU)" @if($test->designation=='Triaxial (UU)') selected='selected' @endif>Triaxial Test (UU)</option>
                    <option value="Triaxial (CU)" @if($test->designation=='Triaxial (CU)') selected='selected' @endif>Triaxial Test (CU)</option>
                    <option value="Triaxial (CD)" @if($test->designation=='Triaxial (CD)') selected='selected' @endif>Triaxial Test (CD)</option> --}}
                    <option value="UCS" @if($test->designation=='UCS') selected='selected' @endif>UCS Test</option>
                    <option value="SPT" @if($test->designation=='SPT') selected='selected' @endif>SPT</option>
                </select>

                @if ($errors->has('designation'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('designation') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <div>
                <input id="name" type="text" placeholder="Name" value="{{ $test->name }}"
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required>

                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="scope">Scope</label>
            <textarea id="ck_scope" type="text" class="form-control{{ $errors->has('scope') ? ' is-invalid' : '' }}"
                name="scope">{{$test->scope}}</textarea>

            @if ($errors->has('scope'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('scope') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="reference">Reference</label>
            <div>
                <input id="reference" type="text" placeholder="Reference" value="{{ $test->reference }}"
                    class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}" name="reference">

                @if ($errors->has('reference'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('reference') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="terminology">Terminology</label>
            <textarea id="ck_terminology" type="text"
                class="form-control{{ $errors->has('terminology') ? ' is-invalid' : '' }}"
                name="terminology">{{$test->terminology}}</textarea>

            @if ($errors->has('terminology'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('terminology') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="use">Use</label>
            <textarea id="ck_use" type="text" class="form-control{{ $errors->has('use') ? ' is-invalid' : '' }}"
                name="use">{{$test->use}}</textarea>

            @if ($errors->has('use'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('use') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="preparation">Preparation</label>
            <textarea id="ck_preparation" type="text"
                class="form-control{{ $errors->has('preparation') ? ' is-invalid' : '' }}"
                name="preparation">{{$test->preparation}}</textarea>

            @if ($errors->has('preparation'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('preparation') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="procedure">Procedure</label>
            <textarea id="ck_procedure" type="text"
                class="form-control{{ $errors->has('procedure') ? ' is-invalid' : '' }}"
                name="procedure">{{$test->procedure}}</textarea>

            @if ($errors->has('procedure'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('procedure') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="calculation">Calculation</label>
            <textarea id="ck_calculation" type="text"
                class="form-control{{ $errors->has('calculation') ? ' is-invalid' : '' }}"
                name="calculation">{{$test->calculation}}</textarea>

            @if ($errors->has('calculation'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('calculation') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="report">Report</label>
            <textarea id="ck_report" type="text" class="form-control{{ $errors->has('report') ? ' is-invalid' : '' }}"
                name="report">{{$test->report}}</textarea>

            @if ($errors->has('report'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('report') }}</strong>
            </span>
            @endif
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-danger" style="min-width:120px">Update</button>
        </div>
    </form>
</div>
@endsection
