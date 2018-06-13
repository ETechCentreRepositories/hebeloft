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
<br>
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">Update Transfer Request</div>

                <div class="card-body">
                    <?php echo e(csrf_field()); ?>

                    <table class="table table-striped" id="inventoryTable" >
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryContent">
                        <?php if(count($transfers) > 0): ?>
                            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($transfer->products['Name']); ?></td>
                                <td align="right"><?php echo e($transfer->quantity); ?></td>
                                <?php echo e(Form::hidden('qtyField', $transfer->quantity, ['class' => 'form-control','id'=>'qtyField'])); ?>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e(Form::hidden('getStatus', $transferRequests->status, ['class' => 'form-control','id'=>'getStatus'])); ?>

                        <?php endif; ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <br>
        <?php if($users_id->roles_id == '3'): ?>
            <?php if($transferRequests->status != "received"): ?>
        <?php echo Form::open(['action' => ['TransferRequestController@update', $transferRequests->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'received']); ?>

            <?php echo e(Form::hidden('status', '', ['class' => 'form-control','id'=>'status'])); ?>

            <?php echo e(Form::hidden('qty', '', ['class' => 'form-control','id'=>'qty'])); ?>

            <?php echo e(Form::hidden('_method', 'PUT')); ?>

            <?php echo e(Form::submit('Received', ['class'=>'btn btn-lg btn-success','id'=>'received','name'=>'received'])); ?>

        <?php echo Form::close(); ?>

            <?php endif; ?>
        <?php endif; ?>
        <?php if($users_id->roles_id == '1'): ?>
            <?php echo Form::open(['action' => ['TransferRequestController@update', $transferRequests->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

            <?php echo e(Form::hidden('status', 'rejected', ['class' => 'form-control'])); ?>

            <?php echo e(Form::hidden('_method', 'PUT')); ?>

            <?php echo e(Form::submit('Follow Up', ['class'=>'btn btn-lg btn-danger btn-rejected'])); ?>

        <?php echo Form::close(); ?>

        <?php echo Form::open(['action' => ['TransferRequestController@update', $transferRequests->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

            <?php echo e(Form::hidden('status', 'accepted', ['class' => 'form-control'])); ?>

            <?php echo e(Form::hidden('_method', 'PUT')); ?>

            <?php echo e(Form::submit('Accepted', ['class'=>'btn btn-lg btn-success btn-accepted'])); ?>

        <?php echo Form::close(); ?>

        <?php endif; ?>
    </div>
</div>

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    .received {
        text-align: center;
    }

    .btn-rejected {
        float: left;
    }

    .btn-accepted {
        float: right;
    }
</style>

<script>
    var qtyField = document.getElementById('qtyField').value;
    console.log(qtyField);
    document.getElementById("qty").value = qtyField;

    var getStatus = document.getElementById('getStatus').value;
    console.log(getStatus);
    document.getElementById("status").value = getStatus;
</script>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>