@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br><br>
<div class="container">
    <div class="row justify-content-end">
        <div>
            <a href="/staffsignup"><button type="button" class="btn btn-warning">Add new staff</button></a>
        </div>
    </div>
    <br><br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->uname}}</td>
                    <td>john@example.com</td>
                    <td>
                        <div class="d-flex flex-row">
                            <div class="p-2">
                                <a href="/staffsignup"><button type="button" class="btn btn-primary">Edit</button></a>
                            </div>
                            <div class="p-2">
                                <a href="/staffsignup"><button type="button" class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
