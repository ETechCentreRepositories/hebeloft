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
{!! Form::open(['action' => ['UsersController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="role" type="hidden" class="form-control" name="role" value="3"/>
                            <input id="username" type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
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
@endsection

<style>
    .productNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>