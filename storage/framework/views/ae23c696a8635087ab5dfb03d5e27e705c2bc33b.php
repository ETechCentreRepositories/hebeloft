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

<div class="topMargin">
    <br>
    <h3 class="card-title">Edit outlet</h3>
    <br>
    <?php echo Form::open(['action' => ['OutletsController@update', $outlet->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

    <div class="form-group modal-fields">
        <?php echo e(Form::text('outlet_name', $outlet->outlet_name, ['class' => 'form-control', 'placeholder' => 'Branch name'])); ?>

    </div>
    <div class="form-group modal-fields">
        <?php echo e(Form::text('address', $outlet->address, ['class' => 'form-control', 'placeholder' => 'Address'])); ?>

    </div>
    <div class="form-group modal-fields">
        <?php echo e(Form::text('telephone_number', $outlet->telephone_number, ['class' => 'form-control', 'placeholder' => 'Telephone number'])); ?>

    </div>
    <div class="form-group modal-fields">
        <?php echo e(Form::text('fax', $outlet->fax, ['class' => 'form-control', 'placeholder' => 'Fax'])); ?>

    </div>
    <?php echo e(Form::hidden('_method', 'PUT')); ?>

    <br>
    <div class="form-group modal-button">
        <?php echo e(Form::submit('Save', ['class'=>'btn btn-primary btn-lg'])); ?>

    </div>
    <br>
<?php echo Form::close(); ?>

</div>
<?php $__env->stopSection(); ?>

<style>
    .outletNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>