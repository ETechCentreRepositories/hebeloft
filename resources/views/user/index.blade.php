@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="topMargin container">
    <div class="row justify-content-end">
        <div>
            <button type="button" class="btn btn-warning" onclick="openCreateUserModal()">Add new staff</button>
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
                                <button type="button" class="btn btn-primary action-buttons" onclick="openUpdateUserModal()">Edit</button>
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
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="username" type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="email" type="text" class="form-control" name="email" value="enquiry@hebeloft.com" value="{{ old('email') }}" required>

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
                    <div class="row">
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                        </div>
                    </div>
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

<div id="updateUserModal" class="modal">
    <span class="close cursor" onclick="closeUpdateUserModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Edit Staff</h3>
            <br>
            {!!Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) !!}
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <p class="idText"> Picture</p> --}}
                            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Username'])}}

                            {{-- @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif --}}
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            {{Form::text('password', "", ['class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password'])}}

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            {{Form::text('status', $user->status, ['class' => 'form-control', 'placeholder' => 'Status'])}}
                        </div>
                    </div>
                </div> --}}

                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- {{dd($roleList)}} --}}
                            {{Form::select('roles_id', $roleList, $user->roles_id)}}
                        </div>
                    </div>
                </div>

                <br><hr><br>

                <label >Outlet:</label>
                <div class="form-group row"> 
                    @foreach($outlets as $outlet) 
                    <div class="col-md-5">
                        {{-- @foreach($userOutlets as $userOutlet) --}}
                        {{-- <script>
                            $(document).ready(function(){
                                if($outlet->id == $userOutlet->outlets_id){
                                    $("#cbChecked").prop("checked",true);
                                // $(".idtext").css("color","lightgreen");
                                }
                                
                            })
                        </script> --}}
                            {{-- @if($outlet->id == $userOutlet->outlets_id) --}}
                                {{-- <label class="checkbox-inline"><input id="cbChecked" name="outlet[]" type="checkbox" value="{{$outlet->id}}" checked> {{$outlet->outlet_name}} </label> --}}
                            {{-- @else
                            <label class="checkbox-inline"><input  name="outlet[]" type="checkbox" value="{{$outlet->id}}"> {{$outlet->outlet_name}} </label> --}}
                                
                            {{-- @endif --}}
                            
                        {{-- @endforeach --}}
                            <label class="checkbox-inline"><input id="cbChecked" name="outlet[]" type="checkbox" value="{{$outlet->id}}"> {{$outlet->outlet_name}} </label>
                    </div>
                    @endforeach
                </div>

                {{Form::hidden('_method','PUT')}}
                <div class="form-group">
                    <div style="text-align:center">
                        <button type="submit" class="btn btn-primary">
                            Edit User
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

    function openUpdateUserModal() {
        document.getElementById('updateUserModal').style.display = "block";
    }

    function closeCreateUserModal() {
        document.getElementById('createUserModal').style.display = "none";
    }

    function closeUpdateUserModal() {
        document.getElementById('updateUserModal').style.display = "none";
    }
</script>
@endsection
