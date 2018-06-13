<?php $__env->startSection('content'); ?>

<?php if($users_id->roles_id == '1'): ?>
<?php echo $__env->make('inc.navbar_superadmin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '2'): ?>
<?php echo $__env->make('inc.navbar_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '3'): ?>
<?php echo $__env->make('inc.navbar_outletstaff', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '4'): ?>
<?php echo $__env->make('inc.navbar_wholesaler', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<br><br><br>

<br>
<div class="container">
    <div>
    <h3>Sales Order #SO_<?php echo e($salesOrder->date); ?>_<?php echo e($salesOrder->id); ?></h3>
        <br>Date    : <?php echo e($salesOrderLists[0]->date); ?>

        <br>Status  : <?php echo e($salesOrderLists[0]->status_name); ?>

        <br>Contact : <?php echo e($salesOrderLists[0]->phone_number); ?> (<?php echo e($salesOrderLists[0]->name); ?>)
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $salesOrderLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesOrderList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/<?php echo e($salesOrderList->image); ?>"></td>
                    <td><?php echo e($salesOrderList->Name); ?></td>
                    <td><?php echo e($salesOrderList->UnitPrice); ?></td>
                    <td align="right"><?php echo e($salesOrderList->quantity); ?></td>
                    <td><?php echo e($salesOrderList->subtotal); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><b>Total</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo e($totalPrice); ?></td>
                </tr>
            </tbody>
        </table>
        <table class="table headerTable">
            <tbody>
                <tr>
                    <td class="wrapContentTd noTopBorder">
                        Remarks
                    </td>
                    <td class="blackBorder">
                    <?php echo e($salesOrderLists[0]->remarks); ?>

                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .salesOrderNav {
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