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
    <div class="drop-down_brand row">
        <div class="col-md-3">
        <p>Search Item name/brand</p>
        </div>
        <div class="col-md-9">
            <select id="product_brand" class="form-control"></select>
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>Show Location</p>
        </div>
        <div class="col-md-9">
            <select id="outlet_location" class="form-control" ></select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-8">
            <input type="text" id="searchField" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-search" id="searchInventory">Search</button>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('export.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-inflow">Export</button></a>
        </div>
    </div>
    <br>
    <table class="table table-striped sortable" id="inventoryTable" >
        <thead>
            <tr>
                <th>Image</th>
                <th>Brand</th>
                <th>Item</th>
                <th>Normal Price</th>
                
                <th>SKU</th>
                <th>Quantity/Thresold</th>
            </tr>
        </thead>
        <tbody id="inventoryContent">
            <?php if(count($inventoryOutlets) > 0): ?> 
            <?php $__currentLoopData = $inventoryOutlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventoryOutlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <img style="width:60px; height:60px" src="/hebeloft/storage/product_images/<?php echo e($inventoryOutlet->products['image']); ?>">    
                </td>
                <td><?php echo e($inventoryOutlet->products['Brand']); ?></td>
                <td><?php echo e($inventoryOutlet->products['Name']); ?></td>
                <td>S$<?php echo e($inventoryOutlet->products['UnitPrice']); ?></td>
                
                <td></td>
                <td><?php echo e($inventoryOutlet->stock_level); ?>/<?php echo e($inventoryOutlet->threshold_level); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <?php else: ?>
                <p>No Inventory found</p>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="pagination">
    <?php echo e($inventoryOutlets->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<style>
    .inventoryNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>