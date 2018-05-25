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

<div class="container-fluid">
    <div class="topMargin salesOrder">
        <div class="dashboardCards d-flex flex-column">
            <h3 class="dashboardLabels">Sales Order</h3>
            <div class="cardContent d-flex flex-row">
                <div class="p-2 card salesCards card1">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber1">
                            <?php echo e($salesPacks); ?>

                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE PACKED
                        </div>
                    </div>
                </div>
                <br>
                <div class="p-2 card salesCards card2">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber2">
                            <?php echo e($salesShips); ?>

                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE SHIPPED
                        </div>
                    </div>
                </div>
                <div class="p-2 card salesCards card3">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber3">
                            <?php echo e($salesDelivers); ?>

                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE DELIVERED
                        </div>
                    </div>
                </div>
                <div class="p-2 card salesCards card4">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber4">
                            <?php echo e($salesInvoices); ?>

                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE INVOICED
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="transferRequest">
        <div class="dashboardCards d-flex flex-column">
            <h3 class="dashboardLabels">Transfer Request</h3>
            <div class="cardContent d-flex flex-row">
                <div class="p-2 card salesCards card1">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber1">
                            <?php echo e($transferPacks); ?>

                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE PACKED
                        </div>
                    </div>
                </div>
                <br>
                <div class="p-2 card salesCards card2">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber2">
                            <?php echo e($transferShips); ?>

                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE SHIPPED
                        </div>
                    </div>
                </div>
                <div class="p-2 card salesCards card3">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber3">
                            <?php echo e($transferDelivers); ?>

                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE DELIVERED
                        </div>
                    </div>
                </div>
                <div class="p-2 card salesCards card4">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber4">
                            <?php echo e($transferInvoices); ?>

                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE INVOICED
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gray row">
        <div class="col-md-6">
            <div class="dashboardTables">
                <h3 class="dashboardLabels">Audit Trails</h3>
                <table class="table table-striped">
                    <thead>
                        <tr><th class="col-md-4">Done By</th></tr>
                        <tr><th class="col-md-4">Action</th></tr>
                        <tr><th class="col-md-4">Date/Time</th></tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $auditTrails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auditTrail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="col-md-4"><?php echo e($auditTrail->action_by); ?></td>
                            <td class="col-md-4"><?php echo e($auditTrail->action); ?></td>
                            <td class="col-md-4"><?php echo e($auditTrail->created_at); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <?php echo e($auditTrails->links()); ?>

            </div>
        </div>
        
        <div class="col-md-6">
            <div class="dashboardTables">
                <h3 class="dashboardLabels">Sales Record</h3>
                <table class="table table-striped">
                    <thead>
                        <tr><th class="col-md-4">Date</th></tr>
                        <tr><th class="col-md-4">Receipt Number</th></tr>
                        <tr><th class="col-md-4">Outlet</th></tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $salesRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesRecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="col-md-4"><?php echo e($salesRecord->date); ?></td>
                            <td class="col-md-4"><?php echo e($salesRecord->receiptNumber); ?></td>
                            <td class="col-md-4"><?php echo e($salesRecord->outlets['outlet_name']); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <?php echo e($salesRecords->links()); ?>

            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<style>
    .homeNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }

    table {
        border: 2px solid #ddd;
        width: 800px;
    }

    th {
        border: none !important;
    }

    thead, tbody, tr, th, td {
        display: block;
    }

    thead{
        width: 97%;
    }

    tbody {
        width: 100%;
        overflow-y: auto;
        height: 176px;
        background-color: #f5f5f5;
    }

    td, thead > tr > th {
        float: left;
        border-bottom-width: 0;
    }

    th:hover{
        background-color: #f5f8fa !important;
        text-decoration: none !important;
        cursor: auto !important;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>