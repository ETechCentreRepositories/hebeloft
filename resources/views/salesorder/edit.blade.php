@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')
@include('inc.unauthorized')
@endif

<br>

<div class="topMargin container">
<br>
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">Update Sales Order</div>

                <div class="card-body">
                    {{ csrf_field() }}
                    <table class="table table-striped" id="inventoryTable" >
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="inventoryContent">
            @if(count($sales) > 0)
                @foreach($sales as $sale)
                <tr>
                    <td>{{$sale->products['Name']}}</td>
                    <td>{{$sale->quantity}}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
                <br>
                </div>
            </div>
        </div>
    </div>
    {!! Form::open(['action' => ['SalesOrdersController@update', $salesOrders->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden('status', 'rejected', ['class' => 'form-control'])}}
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Rejected', ['class'=>'btn btn-primary btn-lg btn-danger btn-rejected'])}}
    {!! Form::close() !!}
    {!! Form::open(['action' => ['SalesOrdersController@update', $salesOrders->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden('status', 'accepted', ['class' => 'form-control'])}}
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Accepted', ['class'=>'btn btn-primary btn-lg btn-success btn-accepted'])}}
    {!! Form::close() !!}
</div>

<style>
    .salesOrderNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    .btn-rejected {
	  float: left;
	}
	
	.btn-accepted {
	  float: right;
	}
</style>