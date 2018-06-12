<script src="<?php echo e(asset('js/inventory.js')); ?>" defer></script>
<?php $__env->startSection('content'); ?>

<?php if($users_id->roles_id == '1'): ?>
<?php echo $__env->make('inc.navbar_superadmin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '2'): ?>
<?php echo $__env->make('inc.navbar_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '3'): ?>
<?php echo $__env->make('inc.navbar_outletstaff', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '4'): ?>
<?php echo $__env->make('inc.navbar_wholesaler', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<br>
<div class="topMargin container">
    <div class="row">
        <div class="col-md-5">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>Search by Brand</p>
                </div>
                <div class="col-md-8">
                    <select id="product_brand" class="form-control"></select>
                </div>
            </div>
        </div>
        <?php if($users_id->roles_id == '1' || $users_id->roles_id == '2' || $users_id->roles_id == '3'): ?>
        <div class="col-md-5">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p style="text-align:right">Show Location</p>
                </div>
                <div class="col-md-8">
                    <select id="outlet_location" class="form-control" ></select>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-2 p-2">
            <button type="button" class="btn btn-default btn-search" id="searchInventory">Search</button>
        </div>
    </div>
    <br>
    <div class="row">
        <?php if($users_id->roles_id == '1' || $users_id->roles_id == '2' || $users_id->roles_id == '3'): ?>
        <div class="col-md-2">
            <button type="button" class="btn btn-success btn-search" onclick="openImportCSVModal()">Import</button>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('exportInventory.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-warning" style="width: 100%;">Export</button></a>
        </div>
        <?php endif; ?>
    </div>
    <br>
    <table class="display nowrap" id="inventoryTable" width="100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Brand</th>
                <th>Item</th>
                <th>Normal Price</th>
                <th>Category</th>
                <th>Quantity/Threshold Level</th>
            </tr>
        </thead>
        <tbody id="inventoryContent">
            <?php if(count($inventoryOutlets) > 0): ?> 
            <?php $__currentLoopData = $inventoryOutlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventoryOutlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <img style="width:60px; height:60px" src="/storage/product_images/<?php echo e($inventoryOutlet->products['image']); ?>">    
                </td>
                <td><?php echo e($inventoryOutlet->products['Brand']); ?></td>
                <td><?php echo e($inventoryOutlet->products['Name']); ?></td>
                <td>$<?php echo e($inventoryOutlet->products['UnitPrice']); ?></td>
                <td><?php echo e($inventoryOutlet->products['Category']); ?></td>
                <td align="right"><?php echo e($inventoryOutlet->stock_level); ?>/<?php echo e($inventoryOutlet->stock_level); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p style="text-align-center">No Inventory found</p>
            <?php endif; ?>
        </tbody>
    </table>

    <div id="importCSVModal" class="modal">
        <span class="close cursor" onclick="closeImportCSVModal()">&times;</span>
        <div class="card modalCard">
            <div class="card-body">
                <h3>Import inventory file</h3>
                <br><br><br><br><br>
                <?php echo Form::open(['action' => ['InventoryController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

                <div style="text-align:center">
                    <?php echo e(Form::file('inventory_csv',array('id'=>'inventorycsv','style'=>'min-width: fit-content; width: fit-content;'))); ?>

                </div>
                <br>
                <div style="text-align:center">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
                <?php echo Form::close(); ?>

            </div>
       </div>
    </div>
</div>


    <script type="text/javascript">
        $(document).ready(function () {
            $("#inventoryTable").DataTable();
        });
        
    </script>

<?php $__env->stopSection(); ?>

<style>
    .inventoryNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    #searchField{
        background-image:url(http://localhost:8000/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>