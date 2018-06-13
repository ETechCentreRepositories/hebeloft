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

<br>
<div class="topMargin container">
    <a href="<?php echo e(route('exportOutlet.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-warning" style="width: auto; float: left;">Export</button></a>
    <div class="row justify-content-end">
        <div class="col-d-2">
            <button type="button" class="btn btn-warning" onclick="openCreateOutletModal()">Add new outlet</button>
        </div>
    </div>
    <br>
    <div>
        <table class="display" id="outletTable">
            <thead>
                <tr>
                    <th>Branch name</th>
                    <th>Address</th>
                    <th>Telephone Number</th>
                    <?php if($users_id->roles_id == '1'): ?>
                    <th class="emptyHeader"></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="<?php echo e($outlet->id); ?>">
                    <td><?php echo e($outlet->outlet_name); ?></td>
                    <td><?php echo e($outlet->address); ?></td>
                    <td><?php echo e($outlet->telephone_number); ?></td>
                    <?php if($users_id->roles_id == '1'): ?>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row outlet-buttons">
                                <div class="p-2">
                                <a href="/outlet/<?php echo e($outlet->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                                <div class="p-2">
                                <a href="/outlet/<?php echo e($outlet->id); ?>"><button type="button" class="btn btn-danger" id="delete">Delete</button>
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
</div>

<?php if(count($outlets) > 0): ?>
<div id="createOutletModal" class="modal">
    <span class="close cursor" onclick="closeCreateOutletModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Create outlet</h3>
            <br>
            <?php echo Form::open(['action' => 'OutletsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']); ?>

            <div class="form-group modal-fields">
                <?php echo e(Form::text('outlet_name', '', ['class' => 'form-control', 'placeholder' => 'Branch name'])); ?>

            </div>
            <div class="form-group modal-fields">
                <?php echo e(Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Address'])); ?>

            </div>
            <div class="form-group modal-fields">
                <?php echo e(Form::text('telephone_number', '', ['class' => 'form-control', 'placeholder' => 'Telephone number'])); ?>

            </div>
            <br>
            <div class="form-group modal-button">
                <?php echo e(Form::submit('Create outlet', ['class'=>'btn btn-primary btn-lg'])); ?>

            </div>
            <br>
        <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php endif; ?>

<div id="deleteOutletModal" class="modal">
    <span class="close cursor" onclick="closeDeleteOutletModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            
            <h3 class="card-title">Delete Confirmation</h3>
            <br>
            <h3>Are you sure you want to delete this outlet?</h3>
            <p>The following staffs are tied to this outlet:</p>
            <?php $__currentLoopData = $userOutlets->where('outlets_id','==',$outlet->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userOutlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($userOutlet->users['name']); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php echo Form::open(['action' => ['OutletsController@destroy', $outlet->id], 'method' => 'POST']); ?>

                <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])); ?>

            <?php echo Form::close(); ?>

    </div>
</div>

<script>
$(document).ready(function () {
    $("#outletTable").DataTable();
});
    function openCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "block";
    }
    
    function closeCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "none";
    }
    function openDeleteOutletModal() {
        document.getElementById('deleteOutletModal').style.display = "block";
    }
    function closeDeleteOutletModal() {
        document.getElementById('deleteOutletModal').style.display = "none";
    }
</script>
<?php $__env->stopSection(); ?>

<style>
    .outletNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>