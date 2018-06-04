<?php $__env->startSection('content'); ?>

<?php if($users_id->roles_id == '1'): ?>
<?php echo $__env->make('inc.navbar_superadmin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '2'): ?>
<?php echo $__env->make('inc.navbar_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '3'): ?>
<?php echo $__env->make('inc.navbar_outletstaff', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '4'): ?>
<?php echo $__env->make('inc.navbar_wholesaler', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php endif; ?>

<br><br>

<br>
<div class="container">
    <?php echo Form::open(['action' => 'SalesOrdersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']); ?>

        <div class="row">
            <div class="col-md-3">
                <h2>Sales Order</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <p>Date:</p>
            </div>
            <div class="col-md-9">
                <input type="date" id="salesOrderDate" name ="salesOrderDate" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10">
                <input type="text" id="salesOrderSearchField" class="form-control" style="background:transparent">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addSalesOrder">Add</button>
            </div>
        </div>
        <br>
        <table class="table table-striped" id="createSalesOrderTable">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>    
            <tbody id="addSalesOrderContent">
            <?php if(Session::has('cartSalesOrder')): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr><td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/<?php echo e($product['item']['image']); ?>"/></td>
                        <td><?php echo e($product['item']['Name']); ?></td>
                        <td><?php echo e($product['item']['UnitPrice']); ?></td>
                        <td><?php echo e($product['qty']); ?></td>
                        <td><?php echo e($product['item']['UnitPrice']*$product['qty']); ?></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
            <tbody id="total">
            <?php if(Session::has('cartSalesOrder')): ?>
                <tr><td></td>
                <td></td>
                <td></td>
                <td>Total Quantity</td>
                <td><?php echo e(Session::has('cartSalesOrder') ? Session::get('cartSalesOrder')-> totalQty : ''); ?></td></tr>
                <tr><td></td>
                <td></td>
                <td></td>
                <td>Sub total</td>
                <td></td></tr>
            <?php endif; ?>
            </tbody>
        </table>
        <div class="row">
            <?php echo e(Form::textarea('remarks', "", ['id' => 'remarks', 'class' => 'form-control', 'placeholder' => 'Remarks'])); ?>

        </div>
        <br>
        <div class="form-group">
            <div>
                <button type="button" class="btn btn-primary" id="saveSalesOrder" onClick="enableCreateButton()">Save as Draft</button>
                <?php echo e(Form::submit('Create Sales Draft', ['class'=>'btn btn-primary', 'id'=>'createButton',  'disabled'])); ?>

            </div>
        </div>
        <?php echo Form::close(); ?>

</div>

<?php $__env->stopSection(); ?>

<style>
    .salesOrderNav {
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
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>