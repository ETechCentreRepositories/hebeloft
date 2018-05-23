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
<div class="topMargin container">
    <div class="row">
        <div class="col-md-5">
            <br>
            <br>
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
            <br>
            <br>
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>To Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="p-2 no-side-paddings transfer-buttons">
                <a href="/transferrequest/create"><button type="button" class="btn btn-warning centered-buttons transferRequestButtons">Create New Request</button></a>
            </div>
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
    <div class="row">
        
            
        <input type="text" class="form-control searchField" style="background:transparent; height:0.8cm;">
        
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
            <tbody id="transferRequestContent">
                <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($transfer->date); ?></td>
                    
                    
                    <td><?php echo e($transfer->status); ?></td>
                    <td><?php echo e($transfer->statuses['status_name']); ?></td>
                    <?php if($users_id->roles_id == '1'): ?>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/transferrequest/<?php echo e($transfer->id); ?>"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
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

<script>
    function openViewTransferModal() {
        document.getElementById('viewTransferModal').style.display = "block";
    }
    
    function closeViewTransferModal() {
        document.getElementById('viewTransferModal').style.display = "none";
    }
    $(document).ready(function(){
            $('#search').click(function(){
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                console.log(startDate + endDate);
                $("#transferRequestContent").empty();
            $.ajax({
                type: "GET",
                url: "<?php echo e(URL::TO('/ajax/transferrequest/date')); ?>/" + startDate + "/" + endDate,
                // data: "products.Name=" + productName,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    // console.log(response);
                    for (i = 0; i < response.length; i++) {
                        console.log(response[i]);
                        $("#transferRequestContent").append(
                            "<tr><td>"+ response[i].date+"</td>"
                            + "<td>"+ response[i].status +"</td>"
                            + "<td>"+ response[i].status_name+"</td>"
                            <?php if($users_id->roles_id == '1'): ?>
                            +"<td><a href='/transferrequest/"+response[i].id+"/edit'><button type='button' class='btn btn-primary action-buttons'>Edit</button></a></td></tr>"
                            <?php endif; ?>
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