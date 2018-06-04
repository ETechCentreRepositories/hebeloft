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

<br>
<?php if($users_id->roles_id == '1' or $users_id->roles_id == '2'): ?>
<div class="topMargin container">
    <div class="row">
        <div class="col-md-4">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>From Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="startDate" type="date" name="from" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>To Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4 fullWidthButtons">
            <div class="p-2 transfer-buttons" align="right">
                <a href="/transferrequest/create"><button type="button" class="btn btn-warning centered-buttons transferRequestButtons">Create or View New Transfer Request</button></a>
            </div>
        </div>
        <div class="col-md-10" style="padding-top:9px">
            
            <input type="text" id="transferRequestSearchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="d-flex flex-row transfer-buttons">
                <div class="p-2">
                    <button id="search" type="button" class="btn btn-sucess transferRequestButtons">Search</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-primary transferRequestButtons">Refresh</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Process</th>
                    <th>Status</th>
                    <th class="emptyHeader"></th>
                </tr>
            </thead>
            <tbody id="transferRequestContent">
                <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($transfer->date); ?></td>
                    
                    
                    <td><?php echo e($transfer->status); ?></td>
                    <td><?php echo e($transfer->statuses['status_name']); ?></td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/transferrequest/<?php echo e($transfer->id); ?>"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
                    <?php if($users_id->roles_id == '1'): ?>
                                <div class="p-2">
                                    <a href="/transferrequest/<?php echo e($transfer->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <?php echo e($transfers->links()); ?>

    </div>
</div>
<?php endif; ?>

<?php if($users_id->roles_id == '3'): ?>
<div class="topMargin container">
    <div class="row">
        <div class="col-md-4">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>From Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="startDate" type="date" name="from" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>To Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4 fullWidthButtons">
            <div class="p-2 transfer-buttons" align="right">
                <a href="/transferrequest/create"><button type="button" class="btn btn-warning centered-buttons transferRequestButtons">Create or View New Transfer Request</button></a>
            </div>
        </div>
        <div class="col-md-10" style="padding-top:9px">
            <input type="text" id="transferRequestSearchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="d-flex flex-row transfer-buttons">
                <div class="p-2">
                    <button id="search" type="button" class="btn btn-sucess transferRequestButtons">Search</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-primary transferRequestButtons">Refresh</button>
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
                    <th class="emptyHeader"></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $outletTransfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outletTransfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($outletTransfer->date); ?></td>
                    
                    
                    <td><?php echo e($outletTransfer->status); ?></td>
                    <td><?php echo e($outletTransfer->statuses['status_name']); ?></td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/transferrequest/<?php echo e($outletTransfer->id); ?>"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
                    <?php if($users_id->roles_id == '1'): ?>
                                <div class="p-2">
                                    <a href="/transferrequest/<?php echo e($transfer->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <?php echo e($transfers->links()); ?>

    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

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
    
    #transferRequestSearchField{
        background-image:url(http://localhost:8000/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>