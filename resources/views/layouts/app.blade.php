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
    });


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
                    $("#addSalesRecordContent").append(
                        "<tr id='"+productId+"'><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                        + "<td>" + response[i].Name + "</td>"
                        + "<td><input name='unitPrice' type='number' id='unitPrice' type='text' style='width:60px;' value='"+response[i].UnitPrice+"'/></td>"
                        + "<td><input name='quantity' type='number' id='quantity' type='text' style='width:60px;' value='1'/></td>"
                        + "<td><input name='price' type='number' id='price' type='text' style='width:60px;' value='"+response[i].UnitPrice+"'/></td></tr>"
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
                        + "<td>" + response[i].Name + "</td>"
                        + "<td>" + response[i].UnitPrice + "</td>"
                        + "<td><input name='quantity' type='number' id='quantity' type='text' style='width:60px;' value='1'</tr>"
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
    console.log(productName);
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
                        "<tr id='"+productId+"'>"
                        + "<td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                        + "<td>" + response[i].Name + "</td>"
                        + "<td><input name='quantity' type='number' id='quantity' type='text' style='width:60px;' value='1'/></td>"
                        + "</tr>"
                    );
                }
            }
        },

        error: function (obj, testStatus, errorThrown) {
            
        }
    });
}

function saveProduct(){
    if(products !== null) {
        var productID = products[0];
        var price =  $('#createSalesRecordTable tr:last-child td:last-child #price').val();
        var quantity =  $('#createSalesRecordTable tr:last-child td:eq(3) #quantity').val();
        var outlet = $('#outlet').val();
        var date = $("#salesRecordDate").val();
        var remarks = $("#remarks").val();
        var receiptNumber = $("#receiptNumber").val();
        console.log(price);
        console.log(quantity);
        console.log(outlet);
        console.log(date);
        console.log(remarks);
        console.log(receiptNumber);
        $.ajax({
            type: "GET",
            url: "{{URL::TO('/salesrecord/addtocart/')}}/" + productID + "/" + price + "/" + quantity + "/" + outlet + "/" + date + "/" + remarks + "/" + receiptNumber,
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
    if(orderProducts !== null) {
        var productID = orderProducts[0];
        var remarks = $("#remarks").val();
        var date = $("#salesOrderDate").val();
        var outlet = $('#outlet').val();
        var quantity =  $('#createSalesOrderTable tr:last-child td:eq(3) #quantity').val();
        console.log(productID);
        console.log(remarks);
        console.log(date);
        console.log(outlet);
        console.log(quantity);
        $.ajax({
            type: "GET",
            url: "{{URL::TO('/salesorder/addtocart/')}}/" + productID + "/" + quantity + "/" + outlet + "/" + date + "/" + remarks,
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
    var outlet = $('#outlet').val();
    var date = $("#transferRequestDate").val();
    var quantity =  $('#createTransferRequestTable tr:last-child td:eq(2) #quantity').val();
    var remarks = $("#remarks").val();
    if(trProducts !== null) {
        console.log(quantity);
        console.log(outlet);
        console.log(date);
        console.log(remarks);
        var productID = trProducts[0];
        $.ajax({
            type: "GET",
            url: "{{URL::TO('/transferrequest/addtocart/')}}/" + productID + "/" + quantity + "/" + outlet + "/" + date + "/" + remarks,
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
