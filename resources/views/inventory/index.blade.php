@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="topMargin container">
    <div class="drop-down_brand row">
        <div class="col-md-3">
        <p>Search Item name/brand</p>
        </div>
        <div class="col-md-9">
            <select id="product_brand" class="form-control">
            </select>
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>Show Location</p>
        </div>
        <div class="col-md-9">
            <select id="outlet_location" class="form-control" >
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
                <a href="{{ route('export.file',['type'=>'csv']) }}"><button type="button" class="btn btn-inflow">Download CSV</button></a>
        </div>
        <div class="col-md-8">
            <input type="text" id="searchField" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-search" id="searchInventory">Search</button>
        </div>
    </div>
    <br>
    <table class="table table-striped" id="inventoryTable" >
        <thead>
            <tr>
                <th>Image</th>
                <th>Brand</th>
                <th>Item</th>
                <th>Normal Price</th>
                {{-- <th>BHG SKU</th>
                <th>OG SKU</th>
                <th>Metro SKU</th> --}}
                <th>SKU</th>
                <th>Quantity/Thresold</th>
            </tr>
        </thead>
        <tbody id="inventoryContent">
            @if(count($inventoryOutlets) > 0) 
            @foreach($inventoryOutlets as $inventoryOutlet)
            <tr>
                <td>
                    <img style="width:60px; height:60px" src="/storage/product_images/{{$inventoryOutlet->products['image']}}">    
                </td>
                <td>{{$inventoryOutlet->products['Brand']}}</td>
                <td>{{$inventoryOutlet->products['Name']}}</td>
                <td>{{$inventoryOutlet->products['UnitPrice']}}</td>
                {{-- <td></td>
                <td></td>
                <td></td> --}}
                <td></td>
            <td>{{$inventoryOutlet->stock_level}}/{{$inventoryOutlet->threshold_level}}</td>
            </tr>
            @endforeach
            {{-- {{dd($inventoryOutlet->products['Brand'])}}  --}}
            @else
                <p>No Inventory found</p>
            @endif
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.get("{{ URL::to('ajax/inventory')}}",function(data){
            $("#product_brand").empty();
            $.each(data,function(i,value){
                var brand = value.Brand;
                var outlet = value.outlet_name;
                $("#product_brand").append("<option value='" +
                value.id + "'>" +brand + "</option>");
                // $("#outlet_location").append("<option value='" +
                // value.id + "'>" +outlet + "</option>");
            });
        });
        $.get("{{ URL::to('ajax/outlet')}}",function(data){
            $("#outlet_location").empty();
            $.each(data,function(i,value){
                var id = value.id;
                var outlet = value.outlet_name;
                var outlet_id = value.id;
                $("#outlet_location").append("<option value='" +
                outlet_id + "'>" +outlet + "</option>");
            });
            
        });
    
        $("#searchField").autocomplete({
            source: "{{URL::to('autocomplete-search')}}",
            minLength:1,
            select:function(key,value)
            {
                console.log(value);
            }
        });

        $("#outlet_location").change(function(){
            var outlet = $(this).val();
            $("#inventoryContent").empty();
            $.ajax({
                    type: "GET",
                    url: "{{URL::TO('/retrieve-inventory-by-outlet')}}/" +outlet,
                    // data: "outlet=" + outlet,
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        for (i = 0; i < response.length; i++) {
                            $("#inventoryContent").append(
                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                                + "<td>" + response[i].Brand + "</td>"
                                + "<td>" + response[i].Name + "</td>"
                                + "<td>" + response[i].UnitPrice + "</td>"
                                + "<td></td>" 
                                + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
                            );
                        }

                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });
        });
        $("#searchInventory").click(function(){
            var productName = $("#searchField").val();
            console.log(productName);
            $("#inventoryContent").empty();
            $.ajax({
                    type: "GET",
                    url: "{{URL::TO('/retrieve-inventory-by-product-name')}}/" + productName,
                    // data: "products.Name=" + productName,
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response);
                        for (i = 0; i < response.length; i++) {
                            $("#inventoryContent").append(
                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                                + "<td>" + response[i].Brand + "</td>"
                                + "<td>" + response[i].Name + "</td>"
                                + "<td>" + response[i].UnitPrice + "</td>"
                                + "<td></td>" 
                                + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
                            );
                        }

                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });
        });
    });
</script>
<div class="pagination">
    {{$inventoryOutlets->links()}}
</div>
@endsection

<style>
    .inventoryNav {
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>