<?php $__env->startSection('content'); ?>

<?php if($users_id->roles_id == '1'): ?>
<?php echo $__env->make('inc.navbar_superadmin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '2'): ?>
<?php echo $__env->make('inc.navbar_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '3'): ?>
<?php echo $__env->make('inc.navbar_outletstaff', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '4'): ?>
<?php echo $__env->make('inc.navbar_wholesaler', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<br><br><br>

<br>
<div class="container">
    <?php echo Form::open(['action' => 'SalesRecordsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']); ?>

    <div class="row">
        <div class="col-md-3">
            <h2>Sales Record</h2>
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
                <input type="date" id="salesRecordDate" name ="salesRecordDate" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <p>Reciept number: </p>
            </div>
            <div class="col-md-9">
                <input type="text" id="receiptNumber" name ="receiptNumber" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10">
                <input type="text" id="salesRecordSearchField" class="form-control" style="background:transparent">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addSalesRecord">Add</button>
            </div>
        </div>
        <br>
        <table class="table table-striped" id="createSalesRecordTable">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody id="addSalesRecordContent">
                <?php if(Session::has('cartSalesRecord')): ?>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="<?php echo e($product['item']['id']); ?>"><td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/<?php echo e($product['item']['image']); ?>"/></td>
                        <td><?php echo e($product['item']['Name']); ?></td>
                        <td><input name="unitPrice" type="number" id="unitPrice" type="text" style="width:60px;" value="<?php echo e($product['item']['UnitPrice']); ?>"/></td>
                        <td><input name="quantity" type="number" id="quantity" type="text" style="width:60px;" value="<?php echo e($product['qty']); ?>"/></td>
                        <td id="price"><input name="price" type="number" id="price" type="text" style="width:60px;" value="<?php echo e($product['price']); ?>"/></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="row">
            <?php echo e(Form::textarea('remarks', "", ['id' => 'remarks', 'class' => 'form-control', 'placeholder' => 'Remarks'])); ?>

        </div>
        <br></br>
        <div class="form-group">
            <div>
            <button type="button" class="btn btn-primary" id="saveSalesRecord" onClick="enableCreateButton()">Save as Draft</button>
            <?php echo e(Form::submit('Create Sales Record', ['class'=>'btn btn-primary', 'id'=>'createButton',  'disabled'])); ?>

            </div>
        </div>
        <?php echo Form::close(); ?>

</div>

<?php $__env->stopSection(); ?>

<style>
    .salesRecordNav {
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

    Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});


    $(document).ready( function() {
    $('#salesRecordDate').val(new Date().toDateInputValue());
});​
</script>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>