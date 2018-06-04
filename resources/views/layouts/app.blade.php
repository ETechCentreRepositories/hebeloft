<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="shortcut icon" href="http://ehostingcentre.com/hebeloft/storage/logo/butterfly_logo.png">
    <script src="http://ehostingcentre.com/hebeloft/js/sorttable.js"></script>
    <script src="http://ehostingcentre.com/hebeloft/js/jquery.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery-ui.min.js')}}" type="text/javascript"></script>
    <link href="{{asset('css/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/> 
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    
    @yield('script')
    
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

        $("#salesOrderSearchField").autocomplete({
            source: "{{URL::to('autocomplete-search')}}",
            minLength:1,
            select:function(key,value)
            {
                console.log(value);
            }
        });

        $("#transferRequestSearchField").autocomplete({
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
                            + "<td align='center'><input name='unitPrice' type='number' id='unitPrice' type='text' style='width:60px;' value='"+ response[i].UnitPrice +"'/></td>"
                            + "<td align='center'><input name='quantity' type='number' id='qty' type='text' style='width:60px;' value='1'/></td>"
                            + "<td id='price' align='center'>"+response[i].UnitPrice+"</td>"
                            + "<td><button type='button' class='btn btn-danger action-buttons' id='removeSR'> Remove </button></td></tr>"
                        );
                    }
                },

                error: function (obj, testStatus, errorThrown) {
                    
                }
            });
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
        
        var trProducts = [];
        $(document).on("click","#addTransferRequest",function(){
            var productName = $("#transferRequestSearchField").val();
            console.log(productName);
            $.ajax({
                type: "GET",
                url: "{{URL::TO('/retrieve-inventory-by-product-name')}}/" + productName,
                data: "",
                cache:false,
                datatype: "JSON",
                success: function (response) {
                console.log(response);

                    for (i = 0; i < response.length; i++) {
                    
                            var productId = parseInt(response[i].products_id);

                            trProducts.push(productId);
                            console.log(trProducts);
                            
                            $("#addTransferRequestContent").append(
                                "<tr id='newRow_"+productId+"'>"
                                + "<td><img style='width:60px; height:60px' src='/hebeloft/storage/product_images/"+ response[i].image +"'/></td>"
                                + "<td>" + response[i].Name + "</td>"
                                + "<td align='center'><input name='quantity' type='number' id='qty' type='text' style='width:60px;' value='1'/></td>"
                                + "<td><button type='button' class='btn btn-danger action-buttons' id='removeTR'> Remove </button></td></tr>"
                            );
                      
                    }
                },

                error: function (obj, testStatus, errorThrown) {
                    console.log("fail");
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
                    // data: "",
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
                    // data: "",
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

        $("#saveTransferRequest").click(function () {
            var outlet = $('#outlet').val();
            var dates = $("#transferRequestDate").val();
            var remarks = $("#remarks").val();
            if(trProducts !== null) {
            	for(var i = 0; i<trProducts.length; i++){
            	    var productID = trProducts[i];
            	    var mainRow = document.getElementById("newRow_"+productID);
            	    var quantity = mainRow.querySelectorAll('#qty')[0].value;
            	    	console.log(productID );
	            	console.log(quantity);
	                console.log(outlet);
	                console.log(dates);
	                console.log(remarks);
	                $.ajax({
	                    type: "GET",
	                    url: "{{URL::TO('/transferrequest/addtocart/')}}/" + productID + "/" + quantity + "/" + outlet + "/" + dates + "/" + remarks,
	                    // data: "",
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
        
        $(document).on("click","#removeTR",function(){
            console.log("testing");
            var id = $("#removeTR").closest('tr').attr('id');
            for(var i = 0; i<trProducts.length; i++) {
                if(trProducts[i] == id) {
                    trProducts.splice(i,1);
                }
            }
            $("#removeTR").closest('tr').remove();
            console.log(id);
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
        
        $(document).on("click","#removeSR",function(){
            console.log("testing");
            var id = $("#removeSR").closest('tr').attr('id');
            for(var i = 0; i<trProducts.length; i++) {
                if(trProducts[i] == id) {
                    trProducts.splice(i,1);
                }
            }
            $("#removeSR").closest('tr').remove();
            console.log(id);
        });
        
    });
    
    function removeCartItemFromSalesRecord() {
        console.log("testing");
        var id = $("#removeThis").closest('tr').attr('id');
        console.log(id);
        
        $.ajax({
                    type: "GET",
                    url: "{{URL::TO('/salesrecord/remove')}}/" + id,
                    // data: "",
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
    
    function removeCartItemFromSalesOrder() {
        console.log("testing");
        var id = $("#removeThis").closest('tr').attr('id');
        console.log(id);
        
        $.ajax({
                    type: "GET",
                    url: "{{URL::TO('/salesorder/remove')}}/" + id,
                    // data: "",
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
    
    function removeCartItemFromTransferRequest() {
        console.log("testing");
        var id = $("#removeThis").closest('tr').attr('id');
        console.log(id);
        
        $.ajax({
                    type: "GET",
                    url: "{{URL::TO('/transferrequest/remove')}}/" + id,
                    // data: "",
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

<style>
@media (min-width: 768px) {
    .mobileLogo {
        visibility: hidden;
    }
}
</style>
   
</head>
<body>
    <div id="app">
        <main class="pb-5">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
</body>
</html>
