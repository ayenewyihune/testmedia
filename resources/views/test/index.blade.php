@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="pt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <form action="/tests/search" method="POST" enctype="search">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-8 mb-1">
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="Enter test name">
                        </div>
                        <div class="col-4 text-right">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <hr class="mt-0" />

                @foreach ($tests as $test)
                <a href="/tests/{{$test->id}}" style="text-decoration: none">
                    <div class="card p-3">
                        <div class="container">
                            <h3 class="m-0">{{$test->designation}}</h3>
                            <hr class="m-0">
                            <div class="text" style="font-size:12px">
                                {!!str_limit($test->scope,300,'...')!!}
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
