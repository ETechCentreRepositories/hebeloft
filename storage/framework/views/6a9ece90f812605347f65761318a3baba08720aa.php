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
                    <th>Remarks</th>
                    <th>Transfer Request Number</th>
                    <th>Date</th>
                    <th>Process</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo e($transferRequest->outlets['outlet_name']); ?></td>
                    <td><?php echo e($transferRequest->remarks); ?></td>
                    <td><?php echo e($transferRequest->transfer_request_number); ?></td>
                    <td><?php echo e($transferRequest->date); ?></td>
                    <td><?php echo e($transferRequest->status); ?></td>
                    <td><?php echo e($transferRequest->statuses['status_name']); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>