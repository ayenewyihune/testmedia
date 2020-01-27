@extends('layouts.user')

@section('content')
<div class="container box my-4">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <form action="/dashboard/create-testwork" method="POST">
                        {{ csrf_field() }}
                        <br><br><br>
                        <h4 class="text-center mb-4">Select Test Type</h4>
                        <select id="test_type" class="form-control{{ $errors->has('test_type') ? ' is-invalid' : '' }}"
                            name="test_type" required>
                            <option>Select test</option>
                            <option value="Direct Shear">Direct Shear Test</option>
                            {{-- <option value="Triaxial (UU)">Triaxial Test (UU)</option>
                            <option value="Triaxial (CU)">Triaxial Test (CU)</option>
                            <option value="Triaxial (CD)">Triaxial Test (CD)</option> --}}
                            <option value="UCS">UCS Test</option>
                            <option value="SPT">SPT</option>
                            <option value="Logging">Log a Borehole</option>
                        </select>

                        @if ($errors->has('test_type'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('test_type') }}</strong>
                        </span>
                        @endif
                        <div class="text-center py-4">
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function select_test() {
        var testType = document.getElementById('test_type').value;
        if (testType == 'Direct Shear') {
            this.
        }
    }

</script>
@endsection
