<script src="<?php echo e(asset('js/sales_record.js')); ?>" defer></script>
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

<br>
<div class="topMargin container">
    <a href="<?php echo e(route('exportSalesRecord.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-warning" style="width: auto; float: left;">Export</button></a>
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3 fullWidthButtons">
            <a href="/salesrecord/create"><button type="button" class="btn btn-warning">Create or View New Sales Record</button></a>
        </div>
    </div>
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
        <div class="col-md-5">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>To Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-3 fullWidthButtons">
            <div class="p-2">
                <button id="search" type="button" class="btn btn-sucess btn-search">Search</button>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="display" id="salesRecordTable">
            <thead>
                <tr>
                    <th>Date (YYYY-MM-DD)</th>
                    <th>Outlet</th>
                    <th>Total Price</th>
                    <th>Remarks</th>
                    <th class="emptyHeader"></th>
                </tr>
            </thead>
            <tbody id="salesRecordContent">
                    <?php $__currentLoopData = $salesRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesRecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($salesRecord->OrderDate); ?></td>
                        <td><?php echo e($salesRecord->outlets['outlet_name']); ?></td>
                        <td><?php echo e($salesRecord->total_price); ?></td>
                        <td><?php echo e($salesRecord->OrderRemarks); ?></td>
                        <td>
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row transfer-buttons">
                                    <div class="p-2">
                                        <a href="/salesrecord/<?php echo e($salesRecord->id); ?>"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $("#salesRecordTable").DataTable({
        searching: false
    });
            $('#refreshInventory').click(function(){
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                console.log(startDate + endDate);
                $("#salesRecordContent").empty();
            $.ajax({
                type: "GET",
                url: "<?php echo e(URL::TO('/ajax/salesrecord/date')); ?>/" + startDate + "/" + endDate,
                // data: "products.Name=" + productName,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    // console.log(response);
                    for (i = 0; i < response.length; i++) {
                        console.log(response[i]);
                        $("#salesRecordContent").append(
                            "<tr><td>"+ response[i].date+"</td>"
                            + "<td>"+ response[i].receiptNumber +"</td>"
                            + "<td>" + response[i].outlet_name + "</td>"
                            + "<td>" + response[i].total_price + "</td>"
                            + "<td>"+ response[i].remarks+"</td></tr>"
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
</div>

<?php $__env->stopSection(); ?>

<style>
    .salesRecordNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    #salesRecordSearchField{
        background-image:url(http://ehostingcentre.com/hebeloft/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>