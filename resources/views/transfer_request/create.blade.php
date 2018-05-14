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

<br><br><br>

<h2>Transfer Request</h2>
<br>
<div class="container">
    <!-- <form id="formCreateSalesRecord" action="SalesRecordsController@store" method="POST"> -->
    {!! Form::open(['action' => 'TransferRequestController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']) !!}
        <div class="row">
            <div class="col-md-3">
                <p>Outlet: </p>
            </div>
            <div class="col-md-9">
                <select name="outlet" id="outlet" class="form-control"></select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <p>Date:</p>
            </div>
            <div class="col-md-9">
                <input type="date" id="transferRequestDate" name ="transferRequestDate" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10">
                <input type="text" id="transferRequestSearchField" class="form-control" style="background:transparent">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addTransferRequest" onClick="getTransferRequestProduct()">Add</button>
            </div>
        </div>
        <br>
        <table class="table table-striped" id="createTransferRequestTable">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Brand</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="addTransferRequestContent">
            @if(Session::has('cartTransferRequest'))
                @foreach($products as $product)
                        <tr><td><img style="width:60px; height:60px" src="/storage/product_images/{{$product['item']['image']}}"/></td>
                        <td>{{$product['item']['Brand']}}</td>
                        <td>{{$product['item']['Name']}}</td>
                        <td><input name="quantity" type="number" id="quantity" onChange="getPrice()" type="text" style="width:60px;" value="{{$product['qty']}}"/></td>
                        <td></td></tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="form-group">
            <div>
            <button type="button" class="btn btn-primary" onClick="saveTRProduct()">Save as Draft</button>
            {{Form::submit('Create Transfer Request', ['class'=>'btn btn-primary'])}}
            </div>
        </div>
        {!! Form::close() !!}
</div>

@endsection

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>