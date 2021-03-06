<?php $__env->startSection('content'); ?>

<?php if($users_id->roles_id == '1'): ?>
<?php echo $__env->make('inc.navbar_superadmin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '2'): ?>
<?php echo $__env->make('inc.navbar_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '3'): ?>
<?php echo $__env->make('inc.navbar_outletstaff', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '4'): ?>
<?php echo $__env->make('inc.navbar_wholesaler', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<br><br><br>

<br>
<div class="container">
    <?php echo Form::open(['action' => 'TransferRequestController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']); ?>

    <div class="row">
        <div class="col-md-3">
            <h2>Transfer Request</h2>
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
                <input type="date" id="transferRequestDate" name ="transferRequestDate" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10">
                
                <input type="text" id="createTrSearchField" class="form-control" style="background:transparent">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addTransferRequest">Add</button>
            </div>
        </div>
        <br>
        <table class="table table-striped" id="createTransferRequestTable">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="addTransferRequestContent">
            <?php if(Session::has('cartTransferRequest')): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="<?php echo e($product['item']['id']); ?>"><td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/<?php echo e($product['item']['image']); ?>"/></td>
                        <td><?php echo e($product['item']['Name']); ?></td>
                        <td align="center"><?php echo e($product['qty']); ?></td>
                        <td><button type="button" class="btn btn-danger action-buttons" id="removeThis" onClick="removeCartItemFromTransferRequest()">Remove</button></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="row">
            <?php echo e(Form::textarea('remarks', "", ['id' => 'remarks', 'class' => 'form-control', 'placeholder' => 'Remarks'])); ?>

        </div>
        <br>
        <p><span style="color: red">*</span>To order, first save as draft, then submit. If it is not saved, you cannot submit and your unsaved request will be gone.</p>
        <div class="form-group">
            <div>
            <button type="button" class="btn btn-primary" id="saveTransferRequest" onClick="enableCreateButton()">Save as Draft</button>
            <?php echo e(Form::submit('Submit Transfer Request', ['class'=>'btn btn-primary', 'id'=>'createButton',  'disabled'])); ?>

            </div>
        </div>
        <?php echo Form::close(); ?>

        
</div>
<script>
$(document).ready(function() {
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

    $("#createTrSearchField").autocomplete({
        source: "<?php echo e(URL::to('autocomplete-search')); ?>",
        minLength:1,
        select:function(key,value)
        {
            console.log(value);
        }
    });

    var trProducts = [];
    $(document).on("click","#addTransferRequest",function(){
        var productName = $("#createTrSearchField").val();
        console.log("productName " + productName);
        $.ajax({
            type: "GET",
            url: "/retrieve-inventory-by-product-name/" + productName,
            cache:false,
            datatype: "JSON",
            success: function (response) {
                console.log(response);
                for (i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    var productId = parseInt(response[i].products_id);
                    var stockLevel = response[i].stock_level;
                    var thresholdLevel = response[i].threshold_level;
                    var maxQty = stockLevel - thresholdLevel;
                    console.log("stock level: " + stockLevel);
                    console.log("threshold level: " + thresholdLevel);
                    console.log("maxQty: " + maxQty);
                    var quantity = 0;
                    if(maxQty < thresholdLevel){
                        quantity = maxQty;
                    } else if (maxQty > thresholdLevel) {
                        quantity = thresholdLevel;
                    } else if ( maxQty == thresholdLevel) {
                        quantity = thresholdLevel;
                    }
                    console.log(quantity);

                    trProducts.push(productId);
                    console.log(trProducts);
                        
                    $("#addTransferRequestContent").append(
                        "<tr id='newRow_"+productId+"'>"
                        + "<td><img style='width:60px; height:60px' src='/hebeloft/storage/product_images/"+ response[i].image +"'/></td>"
                        + "<td>" + response[i].Name + "</td>"
                        + "<td id='price' align='center'><input name='unitPrice' type='number' id='unitPrice' type='text' style='width:60px;' value='"+ response[i].UnitPrice +"' readonly></td>"
                        + "<td id='quantity' align='center'><input name='quantity' type='number' id='qty' type='text' style='width:60px;' value='"+ quantity +"' min='"+ response[i].threshold_level +"' max='"+ maxQty +"'/></td>"
                        + "<td><button type='button' class='btn btn-danger action-buttons' id='removeTR'> Remove </button></td></tr>"
                    );
                }
            },

            error: function (obj, testStatus, errorThrown) {
                console.log("failure");
            }
        });
    });

    $("#saveTransferRequest").click(function () {
        var outlet = $('#outlet').val();
        var dates = $("#transferRequestDate").val();
        var remarks = $("#remarks").val();
        if(trProducts !== null) {
            console.log(trProducts);
            for(var i = 0; i<trProducts.length; i++){
                console.log(trProducts[i]);
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
                    url: "/transferrequest/addtocart/" + productID + "/" + quantity + "/" + outlet + "/" + dates + "/" + remarks,
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

    $(document).on("click","#removeTR",function(){
        var id = $("#removeTR").closest('tr').attr('id');
        for(var i = 0; i<trProducts.length; i++) {
            if(trProducts[i] == id) {
                trProducts.splice(i,1);
            }
        }
        $("#removeTR").closest('tr').remove();
        console.log(id);
    });
});

function removeCartItemFromTransferRequest() {
    var id = $("#removeThis").closest('tr').attr('id');
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/transferrequest/remove/" + id,
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
    function enableCreateButton() {
        document.getElementById("createButton").disabled = false;
    }
    </script>
<?php $__env->stopSection(); ?>

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>