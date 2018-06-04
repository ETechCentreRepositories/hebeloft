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
    <div class="row justify-content-end">
        <div class="col-md-2">
            <a href="<?php echo e(route('outlets.export.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-inflow">Export</button></a>
        </div>
        <div class="col-d-2">
            <button type="button" class="btn btn-warning" onclick="openCreateOutletModal()">Add new outlet</button>
        </div>
    </div>
    <br>
    <?php if(count($outlets) > 0): ?>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Branch name</th>
                    <th>Address</th>
                    <th>Telephone Number</th>
                    <th class="emptyHeader"></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($outlet->id); ?></td>
                    <td><?php echo e($outlet->outlet_name); ?></td>
                    <td><?php echo e($outlet->address); ?></td>
                    <td><?php echo e($outlet->telephone_number); ?></td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row outlet-buttons">
                                <div class="p-2">
                                <a href="/outlet/<?php echo e($outlet->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                                <div class="p-2">
                                    <?php echo Form::open(['action' => ['OutletsController@destroy', $outlet->id], 'method' => 'POST']); ?>

                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                        <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])); ?>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p>No outlets found</p> 
    <?php endif; ?>
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

<div class="pagination">
    <?php echo e($outlets->links()); ?>

</div>

<script>
    function openCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "block";
    }
    
    function closeCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "none";
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