@extends('layouts.user')

@section('content')
<div class="container box my-4">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <form action="/dashboard/ucs/create" method="POST">
                        {{ csrf_field() }}
                        <br><br><br>
                        <h4 class="text-center">Enter Number of Records</h4>
                        <p class="text-center">(Number of records is the number of deformation and load readings made
                            during the test. Please make sure to specify it correctly.)</p>

                        <div class="container-fluild form-group">
                            <div>
                                <input id="records_count" type="number" placeholder="No. of Records"
                                    class="form-control{{ $errors->has('records_count') ? ' is-invalid' : '' }}"
                                    name="records_count" value="{{ old('records_count') }}">

                                @if ($errors->has('records_count'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('records_count') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
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
