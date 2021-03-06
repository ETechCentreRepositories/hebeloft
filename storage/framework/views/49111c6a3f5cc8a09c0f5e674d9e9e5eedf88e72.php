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
    <div class="row">
        <div class="p-2">
            <a href="<?php echo e(route('exportSalesOrder.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-warning">Export</button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>From Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="startDate" type="date" name="from" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p style="text-align:right">To Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="p-2">
                <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="display" id="salesOrderTable">
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
                            <div class="d-flex flex-row">
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
    <div class="row">
        <div class="col-md-5">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>From Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="startDate" type="date" name="from" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p style="text-align:right">To Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="p-2">
                <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div>
        <table class="display" id="salesOrderTable">
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
<script>
$(document).ready(function(){
    $("#salesOrderTable").DataTable({
        searching: false
    });
    $('#refreshInventory').click(function(){
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        console.log(startDate + endDate);
        $("#salesOrderContent").empty();
        $.ajax({
            type: "GET",
            url: "<?php echo e(URL::TO('/ajax/salesorder/date')); ?>/" + startDate + "/" + endDate,
            cache: false,
            dataType: "JSON",
            success: function (response) {
                for (i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    $("#salesOrderContent").append(
                        "<tr><td>"+ response[i].date+"</td>"
                        + "<td>"+ response[i].status +"</td>"
                        + "<td>"+ response[i].status_name+"</td>"
                            <?php if($users_id->roles_id == '1'): ?>
                        +"<td><a href='/salesorder/"+response[i].id+"/edit'><button type='button' class='btn btn-primary action-buttons'>Edit</button></a></td></tr>"
                        <?php endif; ?>
                    );
                }
            },

            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });

    $('#search').click(function(){
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        console.log(startDate + endDate);
        $("#salesOrderContent").empty();
        $.ajax({
            type: "GET",
            url: "/ajax/salesOrder/date/" + startDate + "/" + endDate,
            cache: false,
            dataType: "JSON",
            success: function (response) {
                console.log(success);
                for (i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    $("#salesOrderContent").append(
                        "<tr><td>"+ response[i].date+"</td>"
                        + "<td>"+ response[i].status +"</td>"
                        + "<td>"+ response[i].status_name+"</td>"
                        + "<?php if($users_id->roles_id == '1'): ?>"
                        + "<td><a href='/salesorder/"+response[i].id+"/edit'><button type='button' class='btn btn-primary action-buttons'>Edit</button></a></td></tr>"
                        + "<?php endif; ?>"
                    );
                }
            },

            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });
});
    </script>
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
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>