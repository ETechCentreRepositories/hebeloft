@extends('layouts.app')
<script src="{{ asset('js/products.js') }}" defer></script>
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
@endif

<br>
<div class="topMargin container">
    {!! Form::open(['action' => 'PurchaseOrdersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']) !!}
        <div class="row">
            <h3>Make a new Purchase Order</h3>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <p>Date:</p>
            </div>
            <div class="col-md-9">
                <input name="purchaseOrderDate" type="date" id="purchaseOrderDate" name ="purchaseOrderDate" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10">
                <input type="text" id="purchaseOrderSearchField" class="form-control" style="background:transparent">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addPurchaseOrder">Add</button>
            </div>
        </div>
        <br>
        <table class="table table-striped" id="createpurchaseOrderTable">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>    
            <tbody id="addPurchaseOrderContent">
            </tbody>
        </table>
        <div class="row">
            {{Form::textarea('remarks', "", ['id' => 'remarks', 'class' => 'form-control', 'placeholder' => 'Remarks'])}}
        </div>
        <br>
        <div class="form-group">
            <div>
                {{Form::submit('Submit Order', ['class'=>'btn btn-primary', 'id'=>'createButton'])}}
            </div>
        </div>
        {!! Form::close() !!}
</div>

<script>
$(document).ready(function (){
    $("#purchaseOrderSearchField").autocomplete({
        source: "{{URL::to('autocomplete-search')}}",
        minLength:1,
        select:function(key,value)
        {
            console.log(value);
        }
    });
    
    var orderProducts = [];
    $("#addPurchaseOrder").click(function() {
        var productName = $("#purchaseOrderSearchField").val();
        $.ajax({
            type: "GET",
            url: "{{URL::TO('/retrieve-inventory-by-product-name')}}/" + productName,
            data: "",
            cache:false,
            datatype: "JSON",
            success: function (response) {
                 console.log("testing");
                for (i = 0; i < response.length; i++) {
                    var productId = parseInt(response[i].products_id);
                    orderProducts.push(productId);
                    $("#addPurchaseOrderContent").append(
                        "<tr id='newRow_"+productId+"'><td><img style='width:60px; height:60px' src='/hebeloft/storage/product_images/"+ response[i].image +"'/></td>"
                        + "<td>" + response[i].Name + "</td>"
                        + "<td align='center'><input name='unitPrice' type='number' id='unitPrice' type='text' style='width:60px;' value='"+ response[i].UnitPrice +"' ></td>"
                        + "<td align='center'><input name='quantity' type='number' id='qty' type='text' style='width:60px;' value='1'  min='0'/></td>"
                        + "<td><button type='button' class='btn btn-danger action-buttons' id='removePO'> Remove </button></td></tr>"
                    );
                }
            },

            error: function (obj, testStatus, errorThrown) {
                    
            }
        });
    });

    $("#createButton").click(function() {
        var date = $("#purchaseOrderDate").val();
        if(orderProducts !== null) {
            for(var i = 0; i < orderProducts.length; i++){
                var productID = orderProducts[i];
                var mainRow = document.getElementById("newRow_"+productID);
            	var quantity = mainRow.querySelectorAll('#qty')[0].value;
                var unitPrice = mainRow.querySelectorAll('#unitPrice')[0].value;
                console.log(productID);
                console.log(unitPrice);
                console.log(productID);
                console.log(remarks);
                console.log(date);
                console.log(quantity);
                $.ajax({
                    type: "GET",
                    url: "{{URL::TO('purchaseOrder/')}}" ,
                    cache:false,
                    datatype: "JSON",
                    success: function (response) {
                        console.log("successful");
                    },

                    error: function (obj, testStatus, errorThrown) {
                        console.log(obj + testStatus + errorThrown);
                    }
                });
            }
            
        } else {
            console.log("null");
        }
    });

    $(document).on("click","#removePO",function(){
        console.log("testing");
        var id = $("#removePO").closest('tr').attr('id');
        $("#removePO").closest('tr').remove();
        console.log(id);
    });
});
</script>

@endsection

<style>
    .purchaseOrderNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>