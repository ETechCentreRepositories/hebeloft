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
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<br>
<div class="topMargin container">
    <h3>Add new product</h3>
    <br>
    <?php echo Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Product name'])); ?>

            </div>
            <div class="form-group">
                <?php echo e(Form::text('category', '', ['class' => 'form-control', 'placeholder' => 'Category'])); ?>

            </div>
            <div class="form-group">
                <?php echo e(Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Brand'])); ?>

            </div>
            <div class="form-group">
                <?php echo e(Form::text('unitPrice', '', ['class' => 'form-control', 'placeholder' => 'UnitPrice'])); ?>

            </div>
            <div class="form-group">
                <?php echo e(Form::text('remarks', '', ['class' => 'form-control', 'placeholder' => 'Remarks'])); ?>

            </div>
            <div class="form-group">
                <?php echo e(Form::text('size', '', ['class' => 'form-control', 'placeholder' => 'Size'])); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input id="ogplu" type="number" class="form-control" name="ogPLU" placeholder="OG PLU"  required>
            </div>
            <div class="form-group">
                <input id="bhg" type="number" class="form-control" name="bhg" placeholder="BHG"  required>
            </div>
            <div class="form-group">
                <input id="metro" type="number" class="form-control" name="metro" placeholder="METRO"  required>
            </div>
            <div class="form-group">
                <input id="robinson" type="number" class="form-control" name="robinson" placeholder="ROBINSON"  required>
            </div>
            <div class="form-group">
                <input id="ntuc" type="number" class="form-control" name="ntuc" placeholder="NTUC"  required>
            </div>
            <div class="form-group">
                <?php echo e(Form::text('threshold', '', ['class' => 'form-control', 'placeholder' => 'Threshold level'])); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo e(Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])); ?>

        </div>
    </div>
    <br>
    <div class="form-group">
        <div style="text-align:left">
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
    </div>
    <?php echo Form::close(); ?>

</div>
<?php $__env->stopSection(); ?>

<style>
    .productNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>