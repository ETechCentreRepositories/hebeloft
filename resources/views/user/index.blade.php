@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="topMargin container">
    <div class="row justify-content-end">
        <div>
            <a href="/staffsignup"><button type="button" class="btn btn-warning">Add new staff</button></a>
        </div>
    </div>
    <br>
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
                @if(count($users) > 0)
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <div class="d-flex flex-row user-buttons">
                            <div class="p-2">
                                <a href="/user/{{$user->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                            </div>
                            <div class="p-2">
                                {!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])}}
                                {!!Form::close()!!}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                    <p>No users found</p>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="pagination">
    {{$users->links()}}
</div>
@endsection
