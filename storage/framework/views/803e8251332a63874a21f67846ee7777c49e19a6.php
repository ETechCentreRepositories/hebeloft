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
    <div>
    	<h3>Transfer Request #<?php echo e($transferRequests->outlets->initial); ?>_<?php echo e($transferRequests->date); ?>_<?php echo e($transferRequests->id); ?></h3>
        <br>Date    : <?php echo e($transfers[0]->date); ?>

        <br>Status  : <?php echo e($transfers[0]->status); ?>

        <br>Contact : 9818 2584 (Helen)
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/<?php echo e($transfer->image); ?>"></td>
                    <td><?php echo e($transfer->Name); ?></td>
                    <td align="right"><?php echo e($transfer->quantity); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <br><br/>
        <table class="table headerTable">
            <tbody>
                <tr>
                    <td class="wrapContentTd noTopBorder">
                        Remarks
                    </td>
                    <td class="blackBorder">
                    <?php echo e($transfers[0]->remarks); ?>

                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
        
    }
    
    .emptyHeader {
    	pointer-events: none;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>