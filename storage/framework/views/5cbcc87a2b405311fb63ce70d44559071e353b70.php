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
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Outlet</th>
                    <th>Total Price</th>
                    <th>Total Discount</th>
                    <th>Remarks</th>
                    <th>Date</th>
                    <th>Receipt Number</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo e($salesRecord->outlets['outlet_name']); ?></td>
                    <td><?php echo e($salesRecord->total_price); ?></td>
                    <td><?php echo e($salesRecord->total_discount); ?></td>
                    <td><?php echo e($salesRecord->remarks); ?></td>
                    <td><?php echo e($salesRecord->date); ?></td>
                    <td><?php echo e($salesRecord->receiptNumber); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>