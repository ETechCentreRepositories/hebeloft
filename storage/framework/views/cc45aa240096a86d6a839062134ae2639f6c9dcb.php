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
    <div class="row justify-content-end">
        <a href="/salesrecord/create"><button type="button" class="btn btn-warning">Add Sales Record</button></a>
    </div>
    <br>
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
        <div class="col-md-8">
            <input type="text" class="form-control" style="background:transparent;">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('salesrecord.export.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-inflow">Export</button></a>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Date (YYYY-MM-DD)</th>
                    <th>Receipt Number</th>
                    <th>Outlet</th>
                    <th>Total Price</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody id="salesRecordContent">
                    <?php $__currentLoopData = $salesRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesRecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($salesRecord->date); ?></td>
                        <td><?php echo e($salesRecord->receiptNumber); ?></td>
                        <td><?php echo e($salesRecord->outlets['outlet_name']); ?></td>
                        <td><?php echo e($salesRecord->total_price); ?></td>
                        <td><?php echo e($salesRecord->remarks); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <?php echo e($salesRecords->links()); ?>

    </div>
    <script>
        $(document).ready(function(){
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
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>