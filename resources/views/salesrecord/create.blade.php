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
                        <td align="center">{{$product['qty']}}</td>
                        <td align="center" id="price">{{$product['price']*$product['qty']}}</td>
                        <td><button type="button" class="btn btn-danger action-buttons" id="removeThis" onClick="removeCartItemFromSalesRecord()">Remove</button></td></tr>
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
            {{Form::submit('Submit Sales Record', ['class'=>'btn btn-primary', 'id'=>'createButton',  'disabled'])}}
            </div>
        </div>
        {!! Form::close() !!}
</div>
<script>
$(document).ready(function () {

    $.get("{{URL::to('ajax/outlet')}}",function(data){
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
    var products = [];
    $("#addSalesRecord").click(function() {
        var productName = $("#salesRecordSearchField").val();
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
                    products.push(productId);
                    console.log(products);
                    $("#addSalesRecordContent").append(
                        "<tr id='newRow_"+productId+"'><td><img style='width:60px; height:60px' src='/hebeloft/storage/product_images/"+ response[i].image +"'/></td>"
                        + "<td>" + response[i].Name + "</td>"
                        + "<td align='center'><input name='unitPrice' type='number' id='unitPrice' type='text' style='width:60px;' value='"+ response[i].UnitPrice +"' readonly></td>"
                        + "<td align='center'><input name='quantity' type='number' id='qty' type='text' style='width:60px;' value='"+ response[i].threshold_level +"'  min='"+ response[i].threshold_level +"'/></td>"
                        + "<td id='price' align='center'>"+response[i].UnitPrice+"</td>"
                        + "<td><button type='button' class='btn btn-danger action-buttons' id='removeSR'> Remove </button></td></tr>"
                    );
                }
            },

            error: function (obj, testStatus, errorThrown) {
                
            }
        });
    });
    
    $("#saveSalesRecord").click(function () {
        var outlet = $('#outlet').val();
        var date = $("#salesRecordDate").val();
        var remarks = $("#remarks").val();
        if(products !== null) {
            for(var i = 0; i<products.length; i++){
                var productID = products[i];
                var mainRow = document.getElementById("newRow_"+productID);
                var quantity = mainRow.querySelectorAll('#qty')[0].value;
                var price = mainRow.querySelectorAll('#unitPrice')[0].value;
                console.log(productID);
                console.log(price);
                console.log(quantity);
                console.log(outlet);
                console.log(date);
                console.log(remarks);
                $.ajax({
                    type: "GET",
                    url: "{{URL::TO('/salesrecord/addtocart/')}}/" + productID + "/" + price + "/" + quantity + "/" + outlet + "/" + date + "/" + remarks,
                    cache:false,
                    datatype: "JSON",
                    success: function (response) {
                    console.log("successful");
                    },

                    error: function (obj, testStatus, errorThrown) {
                    console.log("failure");
                    }
                });
            }
        } else {
            console.log("null");
        }
    });
    
    $(document).on("click","#removeSR",function(){
        console.log("testing");
        var id = $("#removeSR").closest('tr').attr('id');
        for(var i = 0; i<products.length; i++) {
            if(products[i] == id) {
                products.splice(i,1);
            }
        }
        $("#removeSR").closest('tr').remove();
        console.log(id);
    });
});

function removeCartItemFromSalesRecord() {
    var id = $("#removeThis").closest('tr').attr('id');
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/salesrecord/remove/" + id,
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
</script>
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