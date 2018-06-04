@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')
@include('inc.unauthorized')
@endif

<br><br><br>

<br>
<div class="container">
    {!! Form::open(['action' => 'SalesRecordsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']) !!}
    <div class="row">
        <div class="col-md-3">
            <h2>Sales Record</h2>
        </div>
    </div>
    <br>
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
                <input type="date" id="salesRecordDate" name ="salesRecordDate" class="form-control">
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-10">
                <input type="text" id="salesRecordSearchField" class="form-control" style="background:transparent">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addSalesRecord">Add</button>
            </div>
        </div>
        <br>
        <table class="table table-striped" id="createSalesRecordTable">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="addSalesRecordContent">
                @if(Session::has('cartSalesRecord'))
                    @foreach($products as $product)
                        <tr id="{{$product['item']['id']}}"><td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/{{$product['item']['image']}}"/></td>
                        <td>{{$product['item']['Name']}}</td>
                        <td>{{$product['item']['UnitPrice']}}</td>
<<<<<<< HEAD
                        <td align="center">{{$product['qty']}}</td>
                        <td align="center" id="price">{{$product['price']*$product['qty']}}</td>
                        <td><button type="button" class="btn btn-danger action-buttons" id="removeThis" onClick="removeCartItemFromSalesRecord()">Remove</button></td></tr>
=======
                        <td>{{$product['qty']}}</td>
                        <td id="price">{{$product['price']*$product['qty']}}</td></tr>
>>>>>>> 45ac57d88eba556cce6555243add80356aa3aaa6
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="row">
            {{Form::textarea('remarks', "", ['id' => 'remarks', 'class' => 'form-control', 'placeholder' => 'Remarks'])}}
        </div>
        <br>
        <p><span style="color: red">*</span>To order, first save as draft, then submit. If it is not saved, you cannot submit and your unsaved record will be gone.</p>
        <div class="form-group">
            <div>
            <button type="button" class="btn btn-primary" id="saveSalesRecord" onClick="enableCreateButton()">Save as Draft</button>
<<<<<<< HEAD
            {{Form::submit('Submit Sales Record', ['class'=>'btn btn-primary', 'id'=>'createButton',  'disabled'])}}
=======
            {{Form::submit('Create Sales Record', ['class'=>'btn btn-primary', 'id'=>'createButton',  'disabled'])}}
>>>>>>> 45ac57d88eba556cce6555243add80356aa3aaa6
            </div>
        </div>
        {!! Form::close() !!}
</div>

@endsection

<style>
    .salesRecordNav {
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