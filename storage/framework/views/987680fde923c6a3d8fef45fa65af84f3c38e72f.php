<?php $__env->startSection('content'); ?>

<?php if($users_id->roles_id == '1'): ?>
<?php echo $__env->make('inc.navbar_superadmin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '2'): ?>
<?php echo $__env->make('inc.navbar_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '3'): ?>
<?php echo $__env->make('inc.navbar_outletstaff', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '4'): ?>
<?php echo $__env->make('inc.navbar_wholesaler', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php endif; ?>

<br><br><br>

<h2>Sales Order</h2>
<br>
<div class="container">
    <!-- <form id="formCreateSalesRecord" action="SalesRecordsController@store" method="POST"> -->
    <?php echo Form::open(['action' => 'SalesOrdersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']); ?>

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
                <input type="date" id="salesOrderDate" name ="salesOrderDate" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10">
                <input type="text" id="salesOrderSearchField" class="form-control" style="background:transparent">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addSalesOrder" onClick="getSalesOrderProduct()">Add</button>
            </div>
        </div>
        <br>
        <table class="table table-striped" id="createSalesOrderTable">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Brand</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>Total Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="addSalesOrderContent">
            <?php if(Session::has('cartSalesOrder')): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr><td><img style="width:60px; height:60px" src="/storage/product_images/<?php echo e($product['item']['image']); ?>"/></td>
                        <td><?php echo e($product['item']['Brand']); ?></td>
                        <td><?php echo e($product['item']['Name']); ?></td>
                        <td><?php echo e($product['item']['UnitPrice']); ?></td>
                        <td><input name="quantity" type="number" id="quantity" onChange="getPrice()" type="text" style="width:60px;" value="<?php echo e($product['qty']); ?>"/></td>
                        <td><input name="discount" id="discount" type="text" style="width:60px;" value="0"/></td>
                        <td id="price"></td>
                        <td></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="form-group">
            <div>
            <button type="button" class="btn btn-primary" onClick="saveOrderProduct()">Save as Draft</button>
            <?php echo e(Form::submit('Create sales order', ['class'=>'btn btn-primary btn-lg'])); ?>

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
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>