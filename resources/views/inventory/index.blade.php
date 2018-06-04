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
<<<<<<< HEAD
        <p>Search by Brand</p>
=======
        <p>Search item brand</p>
>>>>>>> 45ac57d88eba556cce6555243add80356aa3aaa6
        </div>
        <div class="col-md-9">
            <select id="product_brand" class="form-control"></select>
        </div>
    </div>
    <br>
    @if ($users_id->roles_id == '1' || $users_id->roles_id == '2' || $users_id->roles_id == '3')
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>Show Location</p>
        </div>
        <div class="col-md-9">
            <select id="outlet_location" class="form-control" ></select>
        </div>
    </div>
    <br>
    @endif
    
    <div class="row">
<<<<<<< HEAD
    <div class="col-md-10">
            <input type="text" id="searchField" style="text-indent:20px;" class="form-control" style="background:transparent">
=======
    <div class="col-md-2">
            <button type="button" class="btn btn-success btn-search" onclick="openImportCSVModal()">Import</button></a>
>>>>>>> 45ac57d88eba556cce6555243add80356aa3aaa6
        </div>
        <div class="col-md-2">
            <a href="{{ route('inventory.export.file',['type'=>'csv']) }}"><button type="button" class="btn btn-inflow">Export</button></a>
        </div>
        <div class="col-md-6">
            <input type="text" id="searchField" class="form-control" style="background:transparent">
        </div>
<<<<<<< HEAD
        <br>
        </br>
    	@if ($users_id->roles_id == '1' || $users_id->roles_id == '2' || $users_id->roles_id == '3')
    	    <div class="col-md-2">
                <button type="button" class="btn btn-success btn-search" onclick="openImportCSVModal()">Import</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('exportInventory.file',['type'=>'csv']) }}"><button type="button" class="btn btn-warning" style="width: 100%;">Export</button></a>
            </div>
        @endif
        
=======
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-search" id="searchInventory">Search</button>
        </div>
>>>>>>> 45ac57d88eba556cce6555243add80356aa3aaa6
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
                <th>Quantity</th>
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
<<<<<<< HEAD
                <td>${{$inventoryOutlet->products['UnitPrice']}}</td>
                <td>{{$inventoryOutlet->products['Category']}}</td>
                <td align="right">{{$inventoryOutlet->stock_level}}</td>
=======
                <td>S${{$inventoryOutlet->products['UnitPrice']}}</td>
                {{-- <td></td>
                <td></td>
                <td></td> --}}
                <td></td>
                <td>{{$inventoryOutlet->stock_level}}/{{$inventoryOutlet->threshold_level}}</td>
>>>>>>> 45ac57d88eba556cce6555243add80356aa3aaa6
            </tr>
            @endforeach
            @else
                <p style="text-align-center">No Inventory found</p>
            @endif
        </tbody>
    </table>
    
    <div id="importCSVModal" class="modal">
        <span class="close cursor" onclick="closeImportCSVModal()">&times;</span>
        <div class="card modalCard">
            <div class="card-body">
                <h3>Import inventory file</h3>
                <br><br><br><br><br>
                {!! Form::open(['action' => ['InventoryController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div style="text-align:center">{{Form::file('inventory_csv',array('id'=>'inventorycsv','style'=>'min-width: fit-content;
    width: fit-content;'))}}</div>
                <br>
                <div style="text-align:center">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
                {!! Form::close() !!}
            </div>
       </div>
    </div>
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
        $.get("{{ URL::to('ajax/product_brand')}}",function(data){
            $("#product_brand").empty();
            $("#product_brand").append("<option value='all'>All</option>");
            $.each(data,function(i,value){
                var brand = value.Brand;
                $("#product_brand").append("<option value='" +
                value.id + "'>" + brand + "</option>");
            });
        });
        $.get("{{ URL::to('ajax/outlet')}}",function(data){
            $("#outlet_location").empty();
            $("#outlet_location").append("<option value='all'>All</option>");
            $.each(data,function(i,value){
                var id = value.id;
                var outlet = value.outlet_name;
                var outlet_id = value.id;
                $("#outlet_location").append("<option value='" +
                outlet_id + "'>" + outlet + "</option>");
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
            var product_brand = $("#product_brand").val();
            console.log("Product brand: " + product_brand);
            console.log("Outlet: " + outlet);
            $("#inventoryContent").empty();
                if (outlet == "all" && product_brand == "all") {
                    console.log("all");
                    $.get("{{ URL::to('ajax/inventory')}}",function(data){
	                if(data == null) {
	                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                } else {
	                    console.log(data);
	                    $.each(data,function(i,value){
	            	        $("#inventoryContent").append(
	                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ value.image +"'/></td>"
	                            + "<td>" + value.Brand + "</td>"
	                            + "<td>" + value.Name + "</td>"
	                    	    + "<td>" + value.UnitPrice + "</td>"
	                            + "<td>" + value.Category + "</td>" 
	                            + "<td>" + value.stock_level + "</td></tr>"
	                	);
	                    });
	                }
                    });
	        } else if (outlet == "all"){
	            console.log("outlet is all");
	            $.ajax({
		            type: "GET",
		            url: "{{URL::TO('/retrieve-inventory-by-product-brand')}}/" + product_brand,
		            cache: false,
		            dataType: "JSON",
		            success: function (response) {
		            console.log(response);
		                if(response.length == 0) {
		                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
		                } else {
		                    document.getElementById('pagination').style.display = 'none';
		                    for (i = 0; i < response.length; i++) {
		                        $("#inventoryContent").append(
		                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
		                            + "<td>" + response[i].Brand + "</td>"
		                            + "<td>" + response[i].Name + "</td>"
		                            + "<td>" + response[i].UnitPrice + "</td>"
		                            + "<td>" + response[i].Category + "</td>" 
		                            + "<td>" + response[i].stock_level + "</td></tr>"
		                        );
		                    }
		                }
		            },
		                
		            error: function (obj, textStatus, errorThrown) {
		                console.log("Error " + textStatus + ": " + errorThrown);
		            }
		    });
	        } else if(product_brand == "all"){
	            console.log("product brand is all");
	            $.ajax({
	                type: "GET",
	                url: "{{URL::TO('/retrieve-inventory-by-outlet')}}/" + outlet,
	                cache: false,
	                dataType: "JSON",
	                success: function (response) {
	                console.log(response);
	                    if(response.length == 0) {
	                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                    } else {
	                    document.getElementById('pagination').style.display = 'none';
	                    for (i = 0; i < response.length; i++) {
	                        $("#inventoryContent").append(
	                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
	                            + "<td>" + response[i].Brand + "</td>"
	                            + "<td>" + response[i].Name + "</td>"
	                            + "<td>" + response[i].UnitPrice + "</td>"
	                            + "<td>" + response[i].Category + "</td>" 
	                            + "<td>" + response[i].stock_level + "</td></tr>"
	                        );
	                    }
	                    }
	                },
	                
	                error: function (obj, textStatus, errorThrown) {
	                    console.log("Error " + textStatus + ": " + errorThrown);
	                }
	            });
	        } else {
	            console.log("normal");
	            $.ajax({
	                type: "GET",
	                url: "{{URL::TO('/retrieve-inventory-by-filter')}}/" + outlet + "/" + product_brand,
	                cache: false,
	                dataType: "JSON",
	                success: function (response) {
	                    console.log(response);
	                    if(response.length == 0) {
	                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                    } else {
	                        document.getElementById('pagination').style.display = 'none';
	                        for (i = 0; i < response.length; i++) {
	                            $("#inventoryContent").append(
	                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
	                                + "<td>" + response[i].Brand + "</td>"
	                                + "<td>" + response[i].Name + "</td>"
	                                + "<td>" + response[i].UnitPrice + "</td>"
	                                + "<td>" + response[i].Category + "</td>" 
	                                + "<td>" + response[i].stock_level + "</td></tr>"
	                            );
	                    }
	                    }
	                },
	                
	                error: function (obj, textStatus, errorThrown) {
	                    console.log("Error " + textStatus + ": " + errorThrown);
	                }
	            });
	        }
        });

        $("#product_brand").change(function(){
            var product_brand = $(this).val();
            var outlet = $("#outlet_location").val();
            console.log("Product brand: " + product_brand);
            console.log("Outlet: " + outlet);
            $("#inventoryContent").empty();
                if (outlet == "all" && product_brand == "all") {
                    console.log("all");
                    $.get("{{ URL::to('ajax/inventory')}}",function(data){
	                if(data == null) {
	                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                } else {
	                    console.log(data);
	                    $.each(data,function(i,value){
	            	        $("#inventoryContent").append(
	                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ value.image +"'/></td>"
	                            + "<td>" + value.Brand + "</td>"
	                            + "<td>" + value.Name + "</td>"
	                    	    + "<td>" + value.UnitPrice + "</td>"
	                            + "<td>" + value.Category + "</td>" 
	                            + "<td>" + value.stock_level + "</td></tr>"
	                	);
	                    });
	                }
                    });
	        } else if (outlet == "all"){
	            console.log("outlet is all");
	            $.ajax({
		            type: "GET",
		            url: "{{URL::TO('/retrieve-inventory-by-product-brand')}}/" + product_brand,
		            cache: false,
		            dataType: "JSON",
		            success: function (response) {
		            console.log(response);
		                if(response.length == 0) {
		                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
		                } else {
		                    document.getElementById('pagination').style.display = 'none';
		                    for (i = 0; i < response.length; i++) {
		                        $("#inventoryContent").append(
		                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
		                            + "<td>" + response[i].Brand + "</td>"
		                            + "<td>" + response[i].Name + "</td>"
		                            + "<td>" + response[i].UnitPrice + "</td>"
		                            + "<td>" + response[i].Category + "</td>" 
		                            + "<td>" + response[i].stock_level + "</td></tr>"
		                        );
		                    }
		                }
		            },
		                
		            error: function (obj, textStatus, errorThrown) {
		                console.log("Error " + textStatus + ": " + errorThrown);
		            }
		    });
	        } else if(product_brand == "all"){
	            console.log("product brand is all");
	            $.ajax({
	                type: "GET",
	                url: "{{URL::TO('/retrieve-inventory-by-outlet')}}/" + outlet,
	                cache: false,
	                dataType: "JSON",
	                success: function (response) {
	                console.log(response);
	                    if(response.length == 0) {
	                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                    } else {
	                    document.getElementById('pagination').style.display = 'none';
	                    for (i = 0; i < response.length; i++) {
	                        $("#inventoryContent").append(
	                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
	                            + "<td>" + response[i].Brand + "</td>"
	                            + "<td>" + response[i].Name + "</td>"
	                            + "<td>" + response[i].UnitPrice + "</td>"
	                            + "<td>" + response[i].Category + "</td>" 
	                            + "<td>" + response[i].stock_level + "</td></tr>"
	                        );
	                    }
	                    }
	                },
	                
	                error: function (obj, textStatus, errorThrown) {
	                    console.log("Error " + textStatus + ": " + errorThrown);
	                }
	            });
	        } else if (outlet == "all"){
	            console.log("outlet is all");
	            $.ajax({
		            type: "GET",
		            url: "{{URL::TO('/retrieve-inventory-by-product-brand')}}/" + product_brand,
		            cache: false,
		            dataType: "JSON",
		            success: function (response) {
		            console.log(response);
		                if(response.length == 0) {
		                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
		                } else {
		                    document.getElementById('pagination').style.display = 'none';
		                    for (i = 0; i < response.length; i++) {
		                        $("#inventoryContent").append(
		                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
		                            + "<td>" + response[i].Brand + "</td>"
		                            + "<td>" + response[i].Name + "</td>"
		                            + "<td>" + response[i].UnitPrice + "</td>"
		                            + "<td>" + response[i].Category + "</td>" 
		                            + "<td>" + response[i].stock_level + "</td></tr>"
		                        );
		                    }
		                }
		            },
		                
		            error: function (obj, textStatus, errorThrown) {
		                console.log("Error " + textStatus + ": " + errorThrown);
		            }
		    });
	        } else if (outlet == null) {
	            $.ajax({
                    type: "GET",
		            url: "{{URL::TO('/retrieve-inventory-by-product-brand/for-wholesaler')}}/" + product_brand,
		            cache: false,
		            dataType: "JSON",
		            success: function (response) {
		            console.log(response);
		                if(response.length == 0) {
		                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
		                } else {
		                    document.getElementById('pagination').style.display = 'none';
		                    for (i = 0; i < response.length; i++) {
		                        $("#inventoryContent").append(
		                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
		                            + "<td>" + response[i].Brand + "</td>"
		                            + "<td>" + response[i].Name + "</td>"
		                            + "<td>" + response[i].UnitPrice + "</td>"
		                            + "<td>" + response[i].Category + "</td>" 
		                            + "<td>" + response[i].stock_level + "</td></tr>"
		                        );
		                    }
		                }
		            },
		                
		            error: function (obj, textStatus, errorThrown) {
		                console.log("Error " + textStatus + ": " + errorThrown);
		            }
		    });
	        } else {
	            console.log("normal");
	            $.ajax({
	                type: "GET",
	                url: "{{URL::TO('/retrieve-inventory-by-filter')}}/" + outlet + "/" + product_brand,
	                cache: false,
	                dataType: "JSON",
	                success: function (response) {
	                    console.log(response);
	                    if(response.length == 0) {
	                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                    } else {
	                        document.getElementById('pagination').style.display = 'none';
	                        for (i = 0; i < response.length; i++) {
	                            $("#inventoryContent").append(
	                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
	                                + "<td>" + response[i].Brand + "</td>"
	                                + "<td>" + response[i].Name + "</td>"
	                                + "<td>" + response[i].UnitPrice + "</td>"
	                                + "<td>" + response[i].Category + "</td>" 
	                                + "<td>" + response[i].stock_level + "</td></tr>"
	                            );
	                    }
	                    }
	                },
	                
	                error: function (obj, textStatus, errorThrown) {
	                    console.log("Error " + textStatus + ": " + errorThrown);
	                }
	            });
	        }
        });

        $("#product_brand").change(function(){
            var product_brand = $(this).val();
            console.log(product_brand);
            $("#inventoryContent").empty();
            $.ajax({
                type: "GET",
                url: "{{URL::TO('/retrieve-inventory-by-product-brand')}}/" +product_brand,
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
                            + "<td>" + response[i].stock_level + "</td></tr>"
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
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    if(response == null) {$("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>")
                    }else {
                    for (i = 0; i < response.length; i++) {
                        $("#inventoryContent").append(
                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                            + "<td>" + response[i].Brand + "</td>"
                            + "<td>" + response[i].Name + "</td>"
                            + "<td>" + response[i].UnitPrice + "</td>"
                            + "<td>" + response[i].Category + "</td>" 
                            + "<td>" + response[i].stock_level + "</td></tr>"
                        );
                    }
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

<div class="pagination" id="pagination">
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
    
    #searchField{
        background-image:url(http://ehostingcentre.com/hebeloft/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>