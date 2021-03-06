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
                <div class="card-header">Update Sales Order</div>
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
                            <?php if(count($sales) > 0): ?>
                                <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($sale->products['Name']); ?></td>
                                    <td align="right"><?php echo e($sale->quantity); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php echo Form::open(['action' => ['SalesOrdersController@update', $salesOrders->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'rejected']); ?>

        <?php echo e(Form::hidden('status', 'rejected', ['class' => 'form-control'])); ?>

        <?php echo e(Form::hidden('_method', 'PUT')); ?>

        <?php echo e(Form::submit('Follow Up', ['class'=>'btn btn-primary btn-lg btn-danger btn-rejected'])); ?>

    <?php echo Form::close(); ?>

    
    <?php echo Form::open(['action' => ['SalesOrdersController@update', $salesOrders->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'accepted']); ?>

        <?php echo e(Form::hidden('status', 'accepted', ['class' => 'form-control'])); ?>

        <?php echo e(Form::hidden('_method', 'PUT')); ?>

        <?php echo e(Form::submit('Accepted', ['class'=>'btn btn-primary btn-lg btn-success btn-accepted'])); ?>

    <?php echo Form::close(); ?>

</div>
<div style="text-align: center;">
    <a href="<?php echo e(route('generateSO.file',$salesOrders)); ?>"><button class="btn btn-primary btn-lg" style="margin: 0 2% 0 0;">Generate Sales Order</button></a>
    <a href="<?php echo e(route('generatePO.file',$salesOrders)); ?>"><button class="btn btn-primary btn-lg" style="margin: 0 2%;">Generate Packing List</button></a>
    <a href="<?php echo e(route('generateDO.file',$salesOrders)); ?>"><button class="btn btn-primary btn-lg" style="margin: 0 0 0 2%;">Generate Delivery Order</button></a>
    </div>
<style>
    .salesOrderNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    .rejected {
	  float: left;
	}
	
	.accepted {
	  float: right;
	}
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>