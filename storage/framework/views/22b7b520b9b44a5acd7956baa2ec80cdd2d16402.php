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

<div class="topMargin container" onload="checkbox">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">Update Staff</div>

                <div class="card-body">
                    <?php echo Form::open(['action' => ['UsersController@update', $users->id], 'method' => 'POST']); ?>

                    <?php echo e(csrf_field()); ?>


                    

                    

                    <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo e(Form::text('name', $users->name, ['class' => 'form-control', 'placeholder' => 'Username'])); ?>


                                <?php if($errors->has('username')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group<?php echo e($errors->has('roles_id') ? ' has-error' : ''); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo e(Form::hidden('roles_id', $users->roles_id, ['class' => 'form-control', 'placeholder' => 'Role'])); ?>


                                <?php if($errors->has('roles_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('roles_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo e(Form::text('password', "", ['class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password'])); ?>


                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    

                    <?php if($users->roles_id == 3): ?>
                    <br><hr><br>

                    <label >Outlet:</label>
                    <div class="form-group row"> 
                        <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-5">
                            <label class="checkbox-inline"><input name="outlet[]" type="checkbox" value="<?php echo e($outlet->id); ?>"> <?php echo e($outlet->outlet_name); ?> </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>

                    <?php echo e(Form::hidden('_method','PUT')); ?>

                    <div class="form-group">
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary">
                                Edit User
                            </button>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<style>
    .userNav {
        background-color: #f5f8fa !important;
        color: #566B30 !important;
        pointer-events: none;
        cursor: default;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>