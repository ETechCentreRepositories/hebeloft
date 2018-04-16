@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">Staff Sign Up</div>

                <div class="card-body">
                    {!!Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) !!}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="radio" name="gender" value="warehouse"> Warehouse staff<br>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" name="gender" value="outlet"> Outlet staff<br>
                            </div>
                        </div>
                    </div>

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
                                <input id="email" type="text" class="form-control" name="email" value="enquiry@hebeloft.com" value="{{ old('email') }}" required autofocus>

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
                                <input id="number" type="number" class="form-control" name="number" placeholder="Phone number" value="{{ old('number') }}" required>

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