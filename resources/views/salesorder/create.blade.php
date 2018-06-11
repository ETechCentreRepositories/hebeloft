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
                    <th></th>
                </tr>
            </thead>    
            <tbody id="addSalesOrderContent">
            @if(Session::has('cartSalesOrder'))
                @foreach($products as $product)
                    <tr id="{{$product['item']['id']}}"><td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/{{$product['item']['image']}}"/></td>
                    <td>{{$product['item']['Name']}}</td>
                    <td>{{$product['item']['UnitPrice']}}</td>
                    <td align="center">{{$product['qty']}}</td>
                    <td align="center">{{$product['item']['UnitPrice']*$product['qty']}}</td>
                    <td><button type="button" class="btn btn-danger action-buttons" id="removeThis" onClick="removeCartItemFromSalesOrder()">Remove</button></td></tr>
                @endforeach
            @endif
            </tbody>
            <tbody id="total">
            @if(Session::has('cartSalesOrder'))
                <tr><td></td>
                <td></td>
                <td></td>
                <td>Total Quantity</td>
                <td>{{Session::has('cartSalesOrder') ? Session::get('cartSalesOrder')-> totalQty : ''}}</td>
                </tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td>Sub total</td>
                <td></td>
                <td></td></tr>
            @endif
            </tbody>
        </table>
        <div class="row">
            {{Form::textarea('remarks', "", ['id' => 'remarks', 'class' => 'form-control', 'placeholder' => 'Remarks'])}}
        </div>
        <br>
        <p><span style="color: red">*</span>To order, first save as draft, then submit. If it is not saved, you cannot submit and your unsaved order will be gone.</p>
        <div class="form-group">
            <div>
                <button type="button" class="btn btn-primary" id="saveSalesOrder" onClick="enableCreateButton()">Save as draft</button>
                {{Form::submit('Submit Order', ['class'=>'btn btn-primary', 'id'=>'createButton',  'disabled'])}}
            </div>
        </div>
        {!! Form::close() !!}
</div>
<script>
$(document).ready(function (){
    $("#salesOrderSearchField").autocomplete({
        source: "{{URL::to('autocomplete-search')}}",
        minLength:1,
        select:function(key,value)
        {
            console.log(value);
        }
    });

    var orderProducts = [];
    $("#addSalesOrder").click(function() {
        console.log("distinct");
        var productName = $("#salesOrderSearchField").val();
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
                    console.log(orderProducts);
                    $("#addSalesOrderContent").append(
                        "<tr id='newRow_"+productId+"'><td><img style='width:60px; height:60px' src='/hebeloft/storage/product_images/"+ response[i].image +"'/></td>"
                        + "<td>" + response[i].Name + "</td>"
                        + "<td align='center'><input name='unitPrice' type='number' id='unitPrice' type='text' style='width:60px;' value='"+ response[i].UnitPrice +"'/></td>"
                        + "<td align='center'><input name='quantity' type='number' id='qty' type='text' style='width:60px;' value='1'/></td>"
                        + "<td align='center'>" + response[i].UnitPrice + "</td>"
                        + "<td><button type='button' class='btn btn-danger action-buttons' id='removeSO'> Remove </button></td></tr>"
                    );
                }
            },

            error: function (obj, testStatus, errorThrown) {
                    
            }
        });
    });

    $("#saveSalesOrder").click(function() {
        var remarks = $("#remarks").val();
        var date = $("#salesOrderDate").val();
        if(orderProducts !== null) {
            for(var i = 0; i < orderProducts.length; i++){
                var productID = orderProducts[i];
                var mainRow = document.getElementById("newRow_"+productID);
            	var quantity = mainRow.querySelectorAll('#qty')[0].value;
            	var unitPrice = mainRow.querySelectorAll('#unitPrice')[0].value;
            }
            console.log(productID);
            console.log(unitPrice);
            console.log(productID);
            console.log(remarks);
            console.log(date);
            console.log(quantity);
            $.ajax({
                type: "GET",
                url: "{{URL::TO('/salesorder/addtocart/')}}/" + productID + "/" + quantity + "/" + unitPrice + "/" + date + "/" + remarks,
                cache:false,
                datatype: "JSON",
                success: function (response) {
                    console.log("successful");
                },

                error: function (obj, testStatus, errorThrown) {
                    console.log(obj + testStatus + errorThrown);
                }
            });
        } else {
            console.log("null");
        }
    });

    $(document).on("click","#removeSO",function(){
        console.log("testing");
        var id = $("#removeSO").closest('tr').attr('id');
        for(var i = 0; i<trProducts.length; i++) {
            if(trProducts[i] == id) {
                trProducts.splice(i,1);
            }
        }
        $("#removeSO").closest('tr').remove();
        console.log(id);
    });
});

function removeCartItemFromSalesOrder() {
    console.log("testing");
    //retreive the element inside the tr
    //retrieve the "closest tr"
    //retrieve .attr('id')
    var id = $("#removeThis").closest('tr').attr('id');
    console.log(id);
        
    $.ajax({
        type: "GET",
        url: "{{URL::TO('/salesorder/remove')}}/" + id,
        cache:false,
        datatype: "JSON",
            success: function (response) {
                console.log("successful");
                $("#removeThis").closest('tr').remove();
                },

            error: function (obj, testStatus, errorThrown) {
                console.log("failure");
            }
        });
    }
    
function enableCreateButton() {
     document.getElementById("createButton").disabled = false;
}
</script>
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