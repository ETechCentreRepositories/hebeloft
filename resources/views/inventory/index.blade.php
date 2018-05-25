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
@endif
<br>
<div class="topMargin container">
    <div class="drop-down_brand row">
        <div class="col-md-3">
        <p>Search item brand</p>
        </div>
        <div class="col-md-9">
            <select id="product_brand" class="form-control"></select>
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>Show Location</p>
        </div>
        <div class="col-md-9">
            <select id="outlet_location" class="form-control" ></select>
        </div>
    </div>
    <br>
    <div class="row">
    <div class="col-md-2">
            <button type="button" class="btn btn-success btn-search" onclick="openImportCSVModal()">Import</button></a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('inventory.export.file',['type'=>'csv']) }}"><button type="button" class="btn btn-inflow">Export</button></a>
        </div>
        <div class="col-md-6">
            <input type="text" id="searchField" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-search" id="searchInventory">Search</button>
        </div>
    </div>
    <br>
    <table class="table table-striped sortable" id="inventoryTable" >
        <thead>
            <tr>
                <th>Image</th>
                <th>Brand</th>
                <th>Item</th>
                <th>Normal Price</th>
                <th>Category</th>
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
                <td>S${{$inventoryOutlet->products['UnitPrice']}}</td>
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

<div id="importCSVModal" class="modal">
    <span class="close cursor" onclick="closeImportCSVModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Select your inventory file here </h3>
            <br>
            {!! Form::open(['action' => ['InventoryController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{-- <f{!! Form::open(['action' => ['InventoryController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{-- <form class="form-horizontal" role="form" method="POST" action="UsersController@create"> --}}
                {{ csrf_field() }}

                <div class="row">
                <div style="text-align:center">{{Form::file('inventory_csv',array('id'=>'inventory_csv'))}}</div>
                <h3 id="addCSVFile">testing</h3>
                </div>

                <br>

                <div class="form-group">
                    <div style="text-align:center">
                        <button type="submit" class="btn btn-primary">
                            Import
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
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
        $.get("{{ URL::to('ajax/inventory-outlet')}}",function(data){
            $("#outlet_location").empty();
            $.each(data,function(i,value){
                var id = value.id;
                var outlet = value.outlet_name;
                var outlet_id = value.outlets_id;
                $("#outlet_location").append("<option value='" +
                outlet_id + "'>" +outlet + "</option>");
            });
            $("#outlet_location").append("<option value='1'>All</option>");
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

    function openImportCSVModal() {
        document.getElementById('importCSVModal').style.display = "block";
    }

    function closeImportCSVModal() {
        document.getElementById('importCSVModal').style.display = "none";
    }
</script>

<div class="pagination">
    {{$inventoryOutlets->links()}}
</div>
@endsection

<style>
    .inventoryNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>