@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col-6">
            <h2 class="d-none d-md-block">Create Test</h2>
            <h4 class="d-md-none">Create Test</h4>
        </div>
    </div>
</div>

<div class="container-fluid">
    <form action="/dashboard/tests/store" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="designation">Basic Name</label>
            <div>
                <select id="designation" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}"
                    name="designation" required>
                    <option>Select Test</option>
                    <option value="Direct Shear">Direct Shear Test</option>
                    {{-- <option value="Triaxial (UU)">Triaxial Test (UU)</option>
                    <option value="Triaxial (CU)">Triaxial Test (CU)</option>
                    <option value="Triaxial (CD)">Triaxial Test (CD)</option> --}}
                    <option value="UCS">UCS Test</option>
                    <option value="SPT">SPT</option>
                    <option value="Logging">Borehole Logging</option>
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
                <input id="name" type="text" placeholder="Name" value="{{ old('name') }}"
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                    value="{{ old('name') }}" required>

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
                name="scope" value="{{ old('scope') }}"></textarea>

            @if ($errors->has('scope'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('scope') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="reference">Reference</label>
            <div>
                <input id="reference" type="text" placeholder="Reference" value="{{ old('reference') }}"
                    class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}" name="reference"
                    value="{{ old('reference') }}">

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
                class="form-control{{ $errors->has('terminology') ? ' is-invalid' : '' }}" name="terminology"
                value="{{ old('terminology') }}"></textarea>

            @if ($errors->has('terminology'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('terminology') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="use">Use</label>
            <textarea id="ck_use" type="text" class="form-control{{ $errors->has('use') ? ' is-invalid' : '' }}"
                name="use" value="{{ old('use') }}"></textarea>

            @if ($errors->has('use'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('use') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="preparation">Preparation</label>
            <textarea id="ck_preparation" type="text"
                class="form-control{{ $errors->has('preparation') ? ' is-invalid' : '' }}" name="preparation"
                value="{{ old('preparation') }}"></textarea>

            @if ($errors->has('preparation'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('preparation') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="procedure">Procedure</label>
            <textarea id="ck_procedure" type="text"
                class="form-control{{ $errors->has('procedure') ? ' is-invalid' : '' }}" name="procedure"
                value="{{ old('procedure') }}"></textarea>

            @if ($errors->has('procedure'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('procedure') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="calculation">Calculation</label>
            <textarea id="ck_calculation" type="text"
                class="form-control{{ $errors->has('calculation') ? ' is-invalid' : '' }}" name="calculation"
                value="{{ old('calculation') }}"></textarea>

            @if ($errors->has('calculation'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('calculation') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="report">Report</label>
            <textarea id="ck_report" type="text" class="form-control{{ $errors->has('report') ? ' is-invalid' : '' }}"
                name="report" value="{{ old('report') }}"></textarea>

            @if ($errors->has('report'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('report') }}</strong>
            </span>
            @endif
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary" style="min-width:120px">Create</button>
        </div>
    </form>
</div>
@endsection
