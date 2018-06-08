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
    <div class="d-flex">
    @if ($users_id->roles_id == '1')
        <div class="p-2">
            <button type="button" class="btn btn-warning" onclick="openCreateAdminModal()" style="padding-right:10dp">Register an Admin</button>
        </div>
        @endif
        <div class="p-2">
            <button type="button" class="btn btn-warning" onclick="openCreateStaffModal()">Register a Staff</button>
        </div>
        <div class="ml-auto p-2">
            <a href="{{ route('exportUser.file',['type'=>'csv']) }}"><button type="button" class="btn btn-warning">Export</button></a>
        </div>
    </div>
    <br>
    <ul class="nav nav-tabs" role="tablist">
        <li class="active userRole nav-item"><a data-toggle="tab" href="#all" class="roles nav-link active show" role="tab" aria-controls="contact" aria-selected="true">All</a></li>
        <li class="userRole nav-item"><a data-toggle="tab" href="#admins" class="roles nav-link" role="tab" aria-controls="contact" aria-selected="false">Admins</a></li>
        <li class="userRole nav-item"><a data-toggle="tab" href="#staffs" class="roles nav-link" role="tab" aria-controls="contact" aria-selected="false">Outlet Staffs</a></li>
        <li class="userRole nav-item"><a data-toggle="tab" href="#wholesalers" class="roles nav-link" role="tab" aria-controls="contact" aria-selected="false">Wholesalers</a></li>
    </ul>
    <br>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="all">
            <table class="table table-striped sortable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        @if ($users_id->roles_id == '1')
                        <th class="emptyHeader"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if(count($users) > 0)
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->roles['roles_name']}}</td>
                        @if ($users_id->roles_id == '1')
                        <td>
                            <div class="d-flex flex-row">
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
                        @endif
                    </tr>
                    @endforeach
                    @else
                        <p>No users found</p>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="admins">
            <table class="table table-striped sortable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        @if ($users_id->roles_id == '1')
                        <th class="emptyHeader"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if(count($admins) > 0)
                    @foreach($admins as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->roles['roles_name']}}</td>
                        @if ($users_id->roles_id == '1')
                        <td>
                            <div class="d-flex flex-row">
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
                        @endif
                    </tr>
                    @endforeach
                    @else
                        <p>No users found</p>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="staffs">
            <table class="table table-striped sortable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        @if ($users_id->roles_id == '1')
                        <th class="emptyHeader"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if(count($staffs) > 0)
                    @foreach($staffs as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->roles['roles_name']}}</td>
                        @if ($users_id->roles_id == '1')
                        <td>
                            <div class="d-flex flex-row">
                                    <div class="p-2">
                                        <a href="/hebeloft/user/{{$user->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                    </div>
                                <div class="p-2">
                                    {!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])}}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                        <p>No users found</p>
                    @endif
                </tbody>
            </table>
        </div>
        
        
        <div class="tab-pane fade" id="wholesalers">
            <table class="table table-striped sortable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        @if ($users_id->roles_id == '1')
                        <th class="emptyHeader"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if(count($wholesalers) > 0)
                    @foreach($wholesalers as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->roles['roles_name']}}</td>
                        @if ($users_id->roles_id == '1')
                        <td>
                            <div class="d-flex flex-row">
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
                        @endif
                    </tr>
                    @endforeach
                    @else
                        <p>No users found</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pagination">
    {{$users->links()}}
</div>

<div id="createAdminModal" class="modal">
    <span class="close cursor" onclick="closeCreateAdminModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Register an Admin</h3>
            <br>
            {!! Form::open(['action' => ['UsersController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{-- <f{!! Form::open(['action' => ['UsersController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{-- <form class="form-horizontal" role="form" method="POST" action="UsersController@create"> --}}
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="role" type="hidden" class="form-control" name="role" value="2"/>
                            <input id="adminUsername" type="text" class="form-control" name="adminUsername" placeholder="Username" value="{{ old('username') }}" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="adminPhoneNumber" type="number" class="form-control" name="adminPhoneNumber" placeholder="Phone number" value="{{ old('number') }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="adminPassword" type="password" class="form-control passwordField" name="adminPassword" placeholder="Password" required>
                    <input id="adminPasswordConfirm" type="password" class="form-control" name="adminPasswordConfirmation" placeholder="Confirm password" required>
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

<div id="createStaffModal" class="modal">
    <span class="close cursor" onclick="closeCreateStaffModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Register a Staff</h3>
            <br>
            {!! Form::open(['action' => ['UsersController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="role" type="hidden" class="form-control" name="role" value="3"/>
                            <input id="username" type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="phone_number" type="number" class="form-control" name="phone_number" placeholder="Phone number" value="{{ old('number') }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control passwordField" name="password" placeholder="Password" required>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                </div>

                <br><hr><br>
                <label >Outlet:</label>
                <div class="form-group row">  
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
    function openCreateStaffModal() {
        document.getElementById('createStaffModal').style.display = "block";
    }

    function closeCreateStaffModal() {
        document.getElementById('createStaffModal').style.display = "none";
    }
    
    function openCreateAdminModal() {
        document.getElementById('createAdminModal').style.display = "block";
    }

    function closeCreateAdminModal() {
        document.getElementById('createAdminModal').style.display = "none";
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
    
    .userRole {
    	margin-left: 10px;
    }
    
    .roles:hover { 
	background-color: #DCDCDC !important;
    }
    
    .roles {
    	color: #566b30 !important;
    }
    
    .show {
    	color: #000 !important;
    }
    
    .show:hover {
    	background-color: #f5f8fa !important;
    }
</style>