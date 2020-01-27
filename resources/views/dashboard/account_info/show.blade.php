@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row py-4">
        <div class="col">
            <h2>Account Details</h2>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">

        <div class="card-body">
            <table class="table table-striped mb-4">
                <tbody>
                    <tr>
                        <td>First Name</td>
                        <td style="color:blue">{{$user->first_name}}</td>
                    </tr>
                    <tr>
                        <td>Middle Name</td>
                        <td style="color:blue">{{$user->middle_name}}</td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td style="color:blue">{{$user->last_name}}</td>
                    </tr>
                    <tr>
                        <td>ID</td>
                        <td style="color:blue">{{$user->user_id}}</td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td style="color:blue">{{$user->role}}</td>
                    </tr>
                </tbody>
            </table>

            <div class="text-right">
                <a href="/dashboard/edit" class="btn btn-outline-primary">Edit your
                    information</a>
            </div>
        </div>
    </div>
</div>
@endsection
