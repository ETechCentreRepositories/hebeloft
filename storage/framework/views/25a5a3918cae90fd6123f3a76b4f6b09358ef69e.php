<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="shortcut icon" href="http://localhost:8000/storage/logo/butterfly_logo.png">
    <script src="http://localhost:8000/js/sorttable.js"></script>
    <script src="http://localhost:8000/js/jquery.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/inventory.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/transfer_request.js')); ?>" defer></script>
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>" type="text/javascript"></script>
    <link href="<?php echo e(asset('css/jquery-ui.min.css')); ?>" rel="stylesheet" type="text/css"/> 
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    
    <?php echo $__env->yieldContent('script'); ?>
    
    <script>
    $(document).ready(function(){
    
        $.get("<?php echo e(URL::to('ajax/outlet')); ?>",function(data){
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
            source: "<?php echo e(URL::to('autocomplete-search')); ?>",
            minLength:1,
            select:function(key,value)
            {
                console.log(value);
            }
        });

        $("#salesOrderSearchField").autocomplete({
            source: "<?php echo e(URL::to('autocomplete-search')); ?>",
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
                url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-name')); ?>/" + productName,
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
                url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-name')); ?>/" + productName,
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
                    url: "<?php echo e(URL::TO('/salesrecord/addtocart/')); ?>/" + productID + "/" + price + "/" + quantity + "/" + outlet + "/" + date + "/" + remarks,
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
                    url: "<?php echo e(URL::TO('/salesorder/addtocart/')); ?>/" + productID + "/" + quantity + "/" + unitPrice + "/" + date + "/" + remarks,
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

    function enableCreateButton() {
        document.getElementById("createButton").disabled = false;
    }
    
    function removeCartItemFromSalesRecord() {
        console.log("testing");
        var id = $("#removeThis").closest('tr').attr('id');
        console.log(id);
        
        $.ajax({
                    type: "GET",
                    url: "<?php echo e(URL::TO('/salesrecord/remove')); ?>/" + id,
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
                    url: "<?php echo e(URL::TO('/salesorder/remove')); ?>/" + id,
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
            <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
