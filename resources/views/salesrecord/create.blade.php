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

<h2>Sales Record</h2>
<br>
<div class="container">
    <form id="formCreateSalesRecord" action="{{'SalesRecordController@create'}}" method="POST">
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
        <div class="row">
            <div class="col-md-10">
                <input type="text" id="salesRecordSearchField" class="form-control" style="background:transparent">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addSalesRecord" onClick="getProduct()">Add</button>
                <!-- <a href="{{route('product.addToCart', ['id' => 1 ])}}" class="btn btn-success pull-right" role="button">Add to Cart</a> -->
            </div>
        </div>
        <br>
        <table class="table table-striped" id="createSalesRecordTable">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Brand</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>Total Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="addSalesRecordContent">
                
            </tbody>
        </table>
    </form>
</div>

<script>
$(document).ready(function(){
        $.get("{{ URL::to('ajax/outlet')}}",function(data){
            $("#outlet").empty();
            $.each(data,function(i,value){
                var id = value.id;
                var outlet = value.outlet_name;
                var outlet_id = value.id;
                $("#outlet").append("<option value='" +
                outlet_id + "'>" +outlet + "</option>");
            });
        });

        $("#salesRecordSearchField").autocomplete({
            source: "{{URL::to('autocomplete-search')}}",
            minLength:1,
            select:function(key,value)
            {
                console.log(value);
            }
        });

    });

function getPrice(){
    var value  = $("#quantity").val();
    console.log(value);
    $("#price").html(value);
}

var products = [];
function getProduct() {
    var productName = $("#salesRecordSearchField").val();
    $.ajax({
        type: "GET",
        url: "{{URL::TO('/retrieve-inventory-by-product-name')}}/" + productName,
        // data: productName,
        cache:false,
        datatype: "JSON",
        success: function (response) {

            for (i = 0; i < response.length; i++) {

                if (response[i].stock_level > response[i].threshold_level) {

                    var productId = parseInt(response[i].products_id);

                    products.push(productId);
                    console.log(products);
                    
                    $("#addSalesRecordContent").append(
                        "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                        + "<td>" + response[i].Brand + "</td>"
                        + "<td>" + response[i].Name + "</td>"
                        + "<td>" + response[i].UnitPrice + "</td>"
                        + "<td><input name='quantity' type='number' id='quantity' onChange='getPrice()' type='text' style='width:60px;' value='1'/></td>"
                        + "<td><input name='discount' id='discount' type='text' style='width:60px;' value='0'/></td>" 
                        + "<td id='price'></td>"
                        + "<td></td></tr>"
                    );
                }
            }
        },

        error: function (obj, testStatus, errorThrown) {
            
        }
    });
}

function saveProduct(){
    console.log("testing");
    console.log(products);
    if(products !== null) {
        console.log("product not null");
        console.log(products[0]);
        var productID = products[0];
        console.log(productID);
        $.ajax({
            type: "GET",
            url: "{{URL::TO('/salesrecord/addtocart/')}}/" + productID,
            // data: "",
            cache:false,
            datatype: "JSON",
            success: function (response) {
                console.log(url);
                console.log("successful");
            },

            error: function (obj, testStatus, errorThrown) {
                console.log("failure");
            }
        });
    } else {
        console.log("null");
    }
}
</script>

@endsection