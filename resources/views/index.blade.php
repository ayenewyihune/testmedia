@extends('layouts.app')

@section('css')
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- Page Content --}}
<div class="container py-1">

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8 offset-md-2">
            <br><br><br><br><br><br>
            <div id="welcome" class="text-center center" style="opacity:0;">
                @guest
                <h2 class="display-4 mb-3" style="font-size: 1.4rem">Welcome to Testmedia, a laboratory test management
                    platform. You can see tests and
                    test procedures as a guest, but you need to login or register to create testworks.</h2>
                <div class="text-center">
                    <a class="btn btn-outline-primary mr-2" href="/login" role="button">Login here</a>
                    <a class="btn btn-primary" href="/register" role="button">Register</a>
                </div>
                @else
                <h2 class="display-4 mb-3" style="font-size: 1.4rem">Welcome to Testmedia, a laboratory test management
                    platform. You are already logged in, you can click the dashboard button to see your dashboard or
                    click the tests button to see tests.</h2>
                <div class="text-center">
                    <a class="btn btn-primary mr-2" href="/dashboard/testworks" role="button">Dashboard</a>
                    <a class="btn btn-outline-primary mr-2" href="/tests" role="button">Tests</a>
                </div>
                @endguest
            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("#welcome").animate({
            opacity: '1'
        }, 1500);
    });

</script>
@endsection
