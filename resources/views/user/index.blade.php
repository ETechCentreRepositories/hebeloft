@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')
@include('inc.unauthorized')
@endif

<br>
<div class="topMargin container">
    <div class="row justify-content-end">
        <button type="button" class="btn btn-warning" onclick="openCreateUserModal()">Add new staff</button>
    </div>
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="emptyHeader"></th>
                </tr>
            </thead>
            <tbody>
                @if(count($users) > 0)
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->roles['roles_name']}}</td>
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

<div id="createUserModal" class="modal">
    <span class="close cursor" onclick="closeCreateUserModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Staff Sign Up</h3>
            <br>
            {!! Form::open(['action' => ['UsersController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{-- <f{!! Form::open(['action' => ['UsersController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{-- <form class="form-horizontal" role="form" method="POST" action="UsersController@create"> --}}
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input id="role" type="radio" name="role" value="5"> Warehouse staff<br>
                        </div>
                        <div class="col-md-6">
                            <input id="role" type="radio" name="role" value="3"> Outlet staff<br>
                        </div>
                    </div>
                </div>
                
                {{-- <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}"> --}}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="email" type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group hiddenField">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="email" type="hidden" class="form-control" name="email" value="enquiry@hebeloft.com" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="phone_number" type="number" class="form-control" name="phone_number" placeholder="Phone number" value="{{ old('number') }}" required>

                            @if ($errors->has('number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control passwordField" name="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                </div>

                <br><hr><br>
                <label >Outlet:</label>
                <div class="form-group row">  
                    @foreach($outlets as $outlet)
                        <div class="col-md-5">
                        <label class="checkbox-inline"><input name="outlet[]" type="checkbox" value="{{$outlet->id}}"> {{$outlet->outlet_name}} </label>
                            </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <div style="text-align:center">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
    function openCreateUserModal() {
        document.getElementById('createUserModal').style.display = "block";
    }

    function closeCreateUserModal() {
        document.getElementById('createUserModal').style.display = "none";
    }
</script>
@endsection

<style>
    .userNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>