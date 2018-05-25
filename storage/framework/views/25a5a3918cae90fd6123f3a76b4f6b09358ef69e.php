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

        $("#transferRequestSearchField").autocomplete({
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

        $("#createSalesRecordTable tr td").change(function() {
            console.log("try")
            // $("subtotal").html($("#quantity").val()*$("#unitPrice").val())
        });

        var products = [];
        $("#addSalesRecord").click(function() {
            var productName = $("#salesRecordSearchField").val();
            $.ajax({
                type: "GET",
                url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-name')); ?>/" + productName,
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
                                + "<td id='unitPrice'>"+response[i].UnitPrice+"</td>"
                                + "<td><input name='quantity' type='number' id='quantity' type='text' style='width:60px;' value='1'/></td>"
                                + "<td id='price'>"+response[i].UnitPrice+"</td></tr>"
                            );
                        }
                    }
                },

                error: function (obj, testStatus, errorThrown) {
                    
                }
            });
        });
        
        var trProducts = [];
        $("#addTransferRequest").click(function(){
            var productName = $("#transferRequestSearchField").val();
            console.log(productName);
            $.ajax({
                type: "GET",
                url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-name')); ?>/" + productName,
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
        });

        var orderProducts = [];
        $("#addSalesOrder").click(function() {
            var productName = $("#salesOrderSearchField").val();
            $.ajax({
                type: "GET",
                url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-name')); ?>/" + productName,
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
                                + "<td id='price'>" + response[i].UnitPrice + "</td>"
                                + "<td><input name='quantity' type='number' id='quantity' type='text' style='width:60px;' value='1'/>"
                                + "<td id='subtotal'>" + response[i].UnitPrice + "</td></tr>"
                            );
                        }
                    }
                },

                error: function (obj, testStatus, errorThrown) {
                    
                }
            });
        });

        $("#saveSalesOrder").click(function() {
            if(orderProducts !== null) {    
                var productID = orderProducts[0];
                var remarks = $("#remarks").val();
                var date = $("#salesOrderDate").val();
                var quantity =  $('#createSalesOrderTable tr:last-child td:eq(3) #quantity').val();
                var unitPrice =  $('#createSalesOrderTable tr:last-child td:eq(2) #unitPrice').val();
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
                        console.log("failure");
                    }
                });
            }
        });

        $("#saveSalesRecord").click(function () {
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
                    url: "<?php echo e(URL::TO('/salesrecord/addtocart/')); ?>/" + productID + "/" + price + "/" + quantity + "/" + outlet + "/" + date + "/" + remarks + "/" + receiptNumber,
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
        });

        $("#saveTransferRequest").click(function () {
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
                    url: "<?php echo e(URL::TO('/transferrequest/addtocart/')); ?>/" + productID + "/" + quantity + "/" + outlet + "/" + date + "/" + remarks,
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
        });
    });

</script>
   
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
