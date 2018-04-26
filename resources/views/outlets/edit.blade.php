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
                <li class="navList"><a class="homeNav nav-link" style="color:#e3b417;" href="/"><div class="navLabels">Home</div></a></li>
                <li class="navList"><a class="inventoryNav nav-link" style="color:#e3b417;" href="/inventory"><div class="navLabels">Inventory</div></a></li>
                <li class="navList"><a class="transferRequestNav nav-link" style="color:#e3b417;" href="/transfer_request"><div class="navLabels">Transfer Request</div></a></li>
                <li class="navList"><a class="salesOrderNav nav-link" style="color:#e3b417;" href="/salesorder"><div class="navLabels">Sales Order</div></a></li>
                <li class="navList"><a class="userNav nav-link" style="color:#e3b417;" href="/user"><div class="navLabels">User</div></a></li>
                <li class="navList"><a class="outletNav nav-link" style="color:#e3b417;" href="/outlet"><div class="navLabels">Outlet</div></a></li>
                <li class="navList"><a class="salesRecordNav nav-link" style="color:#e3b417;" href="/salesrecord"><div class="navLabels">Sales Record</div></a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="rightNavbar navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="navList"><a class="nav-link" style="color:#e3b417;" href="{{ route('login') }}"><div class="navLabels">{{ __('Login') }}</div></a></li>
                <li class="navList"><a class="nav-link" style="color:#e3b417;" href="{{ route('register') }}"><div class="navLabels">{{ __('Register') }}</div></a></li>
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

<div class="topMargin">
    <br>
    <h3 class="card-title">Edit outlet</h3>
    <br>
    {!! Form::open(['action' => ['OutletsController@update', $outlet->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group modal-fields">
        {{Form::text('outlet_name', $outlet->outlet_name, ['class' => 'form-control', 'placeholder' => 'Branch name'])}}
    </div>
    <div class="form-group modal-fields">
        {{Form::text('address', $outlet->address, ['class' => 'form-control', 'placeholder' => 'Address'])}}
    </div>
    <div class="form-group modal-fields">
        {{Form::text('email', $outlet->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
    </div>
    <div class="form-group modal-fields">
        {{Form::text('telephone_number', $outlet->telephone_number, ['class' => 'form-control', 'placeholder' => 'Telephone number'])}}
    </div>
    <div class="form-group modal-fields">
        {{Form::text('fax', $outlet->fax, ['class' => 'form-control', 'placeholder' => 'Fax'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    <br>
    <div class="form-group modal-button">
        {{Form::submit('Edit outlet', ['class'=>'btn btn-primary btn-lg'])}}
    </div>
    <br>
{!! Form::close() !!}
</div>
@endsection

<style>
    .outletNav {
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>