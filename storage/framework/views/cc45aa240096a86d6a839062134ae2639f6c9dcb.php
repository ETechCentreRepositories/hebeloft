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
    <div class="row justify-content-end">
        <a href="/salesrecord/create"><button type="button" class="btn btn-warning">Create or View New Sales Record</button></a>
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
        <div class="col-md-10">
        </div>
        <div class="col-md-2">
            <div class="d-flex flex-row">
            <button id="search" type="button" class="btn btn-sucess btn-search">Search</button>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
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
    <div class="pagination">
        <?php echo e($salesRecords->links()); ?>

    </div>
</div>
<script>
$(document).ready(function(){
    $('#search').click(function(){
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        console.log(startDate + endDate);
        $("#salesRecordContent").empty();
        $.ajax({
            type: "GET",
            url: "/ajax/salesOrder/date/" + startDate + "/" + endDate,
            cache: false,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                for (i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    $("#salesRecordContent").append(
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
    .salesRecordNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>