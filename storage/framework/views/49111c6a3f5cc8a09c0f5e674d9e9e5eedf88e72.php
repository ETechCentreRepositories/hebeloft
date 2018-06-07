<script src="<?php echo e(asset('js/sales_order.js')); ?>" defer></script>
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

<br>
<?php if($users_id->roles_id == '1' or $users_id->roles_id == '2'): ?>
<div class="topMargin container">
    <div class="drop-down_brand row">
        <div class="col-md-3">
            <p>From Date:</p>
        </div>
        <div class="col-md-9">
            <input id="startDate" type="date" name="from" class="form-control">
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>To Date:</p>
        </div>
        <div class="col-md-9">
            <input id="endDate" type="date" name="to" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">
            <input type="text" id="salesOrderSearchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <div class="d-flex flex-row transfer-buttons">
                <div class="p-2">
                    <button id="search" type="button" class="btn btn-sucess">Search</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
                </div>
            </div>
            
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Date (YYYY-MM-DD)</th>
                    <th>Process</th>
                    <th>Status</th>
                    <?php if($users_id->roles_id == '1'): ?>
                    <th class="emptyHeader"></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="salesOrderContent">
                    <?php $__currentLoopData = $salesOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($salesOrder->date); ?></td>
                        <td><?php echo e($salesOrder->status); ?></td>
                        <td><?php echo e($salesOrder->statuses['status_name']); ?></td>
                        <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/salesorder/<?php echo e($salesOrder->id); ?>"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
                                <div class="p-2">
                                    <a href="/salesorder/<?php echo e($salesOrder->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                            </div>
                        </div>
                    </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <?php echo e($salesOrders->links()); ?>

    </div>
</div>
<?php endif; ?>

<?php if($users_id->roles_id == '4'): ?>
<div class="topMargin container">
    <div class="row justify-content-end">
        <div>
            <a href="/salesorder/create"><button type="button" class="btn btn-warning">Create or View New Sales Order</button></a>
        </div>
    </div>
    <br>
    <div class="drop-down_brand row">
        <div class="col-md-3">
            <p>From Date:</p>
        </div>
        <div class="col-md-9">
            <input type="date" name="from" class="form-control">
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>To Date:</p>
        </div>
        <div class="col-md-9">
            <input type="date" name="to" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">
            <input type="text" id="salesOrderSearchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Process</th>
                    <th>Status</th>
                    <th>View more</th>
                </tr>
            </thead>
            <tbody id="salesOrderContent">
                    <?php $__currentLoopData = $wholesalerSalesOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wholesalerSalesOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($wholesalerSalesOrder->date); ?></td>
                        <td><?php echo e($wholesalerSalesOrder->status); ?></td>
                        <td><?php echo e($wholesalerSalesOrder->statuses['status_name']); ?></td>
                        <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/hebeloft/salesorder/<?php echo e($wholesalerSalesOrder->id); ?>"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
                            </div>
                        </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

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
    
    #salesOrderSearchField{
        background-image:url(http://localhost:8000/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>