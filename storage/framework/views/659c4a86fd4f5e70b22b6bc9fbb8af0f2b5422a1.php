<script src="<?php echo e(asset('js/products.js')); ?>" defer></script>
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
            <a href="/products/create"><button type="button" class="btn btn-warning btn-search">Add Product</button></a>
        </div>
    </div>
    <br>
    <div>
        <table class="table-striped display" id="productTable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Brand</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>UnitPrice</th>
                    <?php if($users_id->roles_id == '1'): ?>
                    <th class="emptyHeader"></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="productContent">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="<?php echo e($product->id); ?>">
                    <td><img style="width:60px; height:60px" src="/storage/product_images/<?php echo e($product->image); ?>"></td>
                    <td><?php echo e($product->Brand); ?></td>
                    <td><?php echo e($product->Name); ?></td>
                    <td><?php echo e($product->Description); ?></td>
                    <td><?php echo e($product->Category); ?></td>
                    <td><?php echo e($product->UnitPrice); ?></td>
                    <?php if($users_id->roles_id == '1'): ?>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row product-buttons">
                                <div class="p-2">
                                    <a href="/product/<?php echo e($product->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                                <div class="p-2">
                                    <?php echo Form::open(['action' => ['ProductsController@destroy', $product->id], 'method' => 'POST']); ?>

                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                        <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])); ?>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="openBulkUpdateModal()">Bulk Update</button>
    </div>
</div>

<?php $__env->stopSection(); ?>

<style>
    .productNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }

    #productSearchField{
        background-image:url(http://localhost:8000/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>