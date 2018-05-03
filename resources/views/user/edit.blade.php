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

<div class="topMargin container" onload="checkbox">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">Update Staff</div>

                <div class="card-body">
                    {!!Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) !!}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="roles_id" type="radio" name="roles_id" value="5"> Warehouse staff<br>
                            </div>
                            <div class="col-md-6">
                                <input id="roles_id" type="radio" name="roles_id" value="3"> Outlet staff<br>
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <div class="row">
                            <div class="col-md-12">
                                {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Username'])}}

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
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

                    <br><hr><br>

                    <label >Outlet:</label>
                    <div class="form-group row"> 
                        @foreach($outlets as $outlet)
                        <div class="col-md-5">
                            <label class="checkbox-inline"><input name="outlet[]" type="checkbox" value="{{$outlet->id}}"> {{$outlet->outlet_name}} </label>
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
</div>
@endsection

<style>
    .userNav {
        background-color: #f5f8fa !important;
        color: #566B30 !important;
        pointer-events: none;
        cursor: default;
    }
</style>