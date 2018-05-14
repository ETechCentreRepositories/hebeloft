<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="shortcut icon" href="http://localhost:8000/storage/logo/butterfly_logo.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     
     <script src="{{asset('js/jquery-ui.min.js')}}" type="text/javascript"></script>
     <link href="{{asset('css/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/> 
     {{-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> --}}
{{-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    {{-- <script type="text/javascript" rel="stylesheet" src="js/app.js" ></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
    @yield('script')
    {{-- <script>
        $(document).ready(function(){
            if($outlet->id == $userOutlet->outlets_id){
                $("#cbChecked").attr("checked","checked");
            // $(".idtext").css("color","lightgreen");
            }
            
        })
    </script> --}}

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

    });

function getPrice(){
    var value  = $("#quantity").val();
    console.log(value);
    $("#price").html(value);
}

var products = [];
function getSalesRecordProduct() {
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

var orderProducts = [];
function getSalesOrderProduct() {
    var productName = $("#salesOrderSearchField").val();
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

                    orderProducts.push(productId);
                    console.log(orderProducts);
                    
                    $("#addSalesOrderContent").append(
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

var trProducts = [];
function getTransferRequestProduct() {
    var productName = $("#transferRequestSearchField").val();
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

                    trProducts.push(productId);
                    console.log(trProducts);
                    
                    $("#addTransferRequestContent").append(
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

function saveOrderProduct(){
    console.log("testing");
    console.log(orderProducts);
    if(orderProducts !== null) {
        console.log("product not null");
        console.log(orderProducts[0]);
        var productID = orderProducts[0];
        console.log(productID);
        $.ajax({
            type: "GET",
            url: "{{URL::TO('/salesOrder/addtocart/')}}/" + productID,
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
    } else {
        console.log("null");
    }
}

function saveTRProduct(){
    console.log("testing");
    console.log(trProducts);
    if(trProducts !== null) {
        console.log("product not null");
        console.log(trProducts[0]);
        var productID = trProducts[0];
        console.log(productID);
        $.ajax({
            type: "GET",
            url: "{{URL::TO('/transfer_request/addtocart/')}}/" + productID,
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
    } else {
        console.log("null");
    }
}
</script>
   
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
