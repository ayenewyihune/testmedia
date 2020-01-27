@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col">
            <h2>Edit Account Details</h2>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">

        <div class="card-body">
            <form method="POST" action="{{route('update_user',$user->id)}}">
                @csrf
                {{ method_field('PUT') }}

                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name')
                                                }}</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text"
                            class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name"
                            value="{{$user->first_name}}" required>

                        @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name')
                                                }}</label>

                    <div class="col-md-6">
                        <input id="middle_name" type="text"
                            class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}"
                            name="middle_name" value="{{$user->middle_name}}">

                        @if ($errors->has('middle_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('middle_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name')
                                                }}</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text"
                            class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name"
                            value="{{$user->last_name}}">

                        @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('ID')
                                                    }}</label>

                    <div class="col-md-6">
                        <input id="user_id" type="text"
                            class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id"
                            value="{{$user->user_id}}" required>

                        @if ($errors->has('user_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('user_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-7">
                        <a class="btn btn-secondary" href="/dashboard">Go Back</a>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Confirm') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
