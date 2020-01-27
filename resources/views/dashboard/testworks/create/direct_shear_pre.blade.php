@extends('layouts.user')

@section('content')
<div class="container box my-4">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <form action="/dashboard/direct-shear/create" method="POST">
                        {{ csrf_field() }}
                        <br><br><br>
                        <h4 class="text-center">Enter Number of Records</h4>
                        <p class="text-center">(Number of records is the number of horizontal displacement and shear
                            force readings made during the test. Please make sure to specify it correctly.)</p>

                        <div class="container-fluild form-group">
                            <div>
                                <input id="records_count1" type="number" placeholder="Test 1"
                                    class="form-control{{ $errors->has('records_count1') ? ' is-invalid' : '' }}"
                                    name="records_count1" value="{{ old('records_count1') }}">

                                @if ($errors->has('records_count1'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('records_count1') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <div>
                                <input id="records_count2" type="number" placeholder="Test 2"
                                    class="form-control{{ $errors->has('records_count2') ? ' is-invalid' : '' }}"
                                    name="records_count2" value="{{ old('records_count2') }}">

                                @if ($errors->has('records_count2'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('records_count2') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="container-fluild form-group">
                            <div>
                                <input id="records_count3" type="number" placeholder="Test 3"
                                    class="form-control{{ $errors->has('records_count3') ? ' is-invalid' : '' }}"
                                    name="records_count3" value="{{ old('records_count3') }}">

                                @if ($errors->has('records_count3'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('records_count3') }}</strong>
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
