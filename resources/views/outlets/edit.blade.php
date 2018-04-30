@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@endif

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