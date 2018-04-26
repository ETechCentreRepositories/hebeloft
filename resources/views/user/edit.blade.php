@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#46552c;"  >
    <div class="container">
        <a class="nav navbar-left" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'Hebeloft') }} --}}
            
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="leftNavbar navbar-nav mr-auto">
                <a href="/"><img src="../../storage/logo/hebeloft_logo.png" class="logo"/></a>
                <li><a class="homeNav nav-link" style="color:#e3b417;" href="/">Home</a></li>
                <li><a class="inventoryNav nav-link" style="color:#e3b417;" href="/inventory">Inventory</a></li>
                <li><a class="transferRequestNav nav-link" style="color:#e3b417;" href="/transfer_request">Transfer Request</a></li>
                <li><a class="salesOrderNav nav-link" style="color:#e3b417;" href="/salesorder">Sales Order</a></li>
                <li><a class="userNav nav-link" style="color:#e3b417;" href="/user">User</a></li>
                <li><a class="outletNav nav-link" style="color:#e3b417;" href="/outlet">Outlet</a></li>
                <li><a class="salesRecordNav nav-link" style="color:#e3b417;" href="/salesrecord">Sales Record</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="rightNavbar navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li><a class="nav-link" style="color:#e3b417;" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="nav-link" style="color:#e3b417;" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest 
            </ul>
        </div>
    </div>
</nav>

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
                                <input id="role" type="radio" name="role" value="5"> Warehouse staff<br>
                            </div>
                            <div class="col-md-6">
                                <input id="role" type="radio" name="role" value="3"> Outlet staff<br>
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
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>