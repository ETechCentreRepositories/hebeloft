@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')

@endif

<br><br>

<br>
<div class="container">
    {!! Form::open(['action' => 'SalesOrdersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']) !!}
        <div class="row">
            <div class="col-md-3">
                <h2>Sales Order</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <p>Date:</p>
            </div>
            <div class="col-md-9">
                <input type="date" id="salesOrderDate" name ="salesOrderDate" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10">
                <input type="text" id="salesOrderSearchField" class="form-control" style="background:transparent">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addSalesOrder">Add</button>
            </div>
        </div>
        <br>
        <table class="table table-striped" id="createSalesOrderTable">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>    
            <tbody id="addSalesOrderContent">
            @if(Session::has('cartSalesOrder'))
                @foreach($products as $product)
                        <tr><td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/{{$product['item']['image']}}"/></td>
                        <td>{{$product['item']['Name']}}</td>
                        <td>{{$product['item']['UnitPrice']}}</td>
                        <td>{{$product['qty']}}</td>
                        <td>{{$product['item']['UnitPrice']*$product['qty']}}</td></tr>
                    @endforeach
                @endif
            </tbody>
            <tbody id="total">
            @if(Session::has('cartSalesOrder'))
                <tr><td></td>
                <td></td>
                <td></td>
                <td>Total Quantity</td>
                <td>{{Session::has('cartSalesOrder') ? Session::get('cartSalesOrder')-> totalQty : ''}}</td></tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td>Sub total</td>
                <td></td></tr>
            @endif
            </tbody>
        </table>
        <div class="row">
            {{Form::textarea('remarks', "", ['id' => 'remarks', 'class' => 'form-control', 'placeholder' => 'Remarks'])}}
        </div>
        <br>
        <div class="form-group">
            <div>
                <button type="button" class="btn btn-primary" id="saveSalesOrder" onClick="enableCreateButton()">Save as Draft</button>
                {{Form::submit('Create Sales Draft', ['class'=>'btn btn-primary', 'id'=>'createButton',  'disabled'])}}
            </div>
        </div>
        {!! Form::close() !!}
</div>

@endsection

<style>
    .salesOrderNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>
<script>
    function enableCreateButton() {
        document.getElementById("createButton").disabled = false;
    }
</script>