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
    <h3>Edit product</h3>
    <br>
        <?php echo Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

        <div class="form-group">
        <div class="row">
                <div class="col-md-1">
                    <p>Name</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('name', $product->Name, ['class' => 'form-control', 'placeholder' => 'Name'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Category</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('category', $product->Category, ['class' => 'form-control', 'placeholder' => 'Category'])); ?>

                </div>
                   
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Remarks</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('remarks', $product->Remarks, ['class' => 'form-control', 'placeholder' => 'Remarks'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Brand</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('brand', $product->Brand, ['class' => 'form-control', 'placeholder' => 'Brand'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>UnitPrice</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('unitPrice', $product->UnitPrice, ['class' => 'form-control', 'placeholder' => '00.00'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">METRO</p>
                </div>
                <div class="col-md-4">
                    <input id="metro" type="number" class="form-control" name="metro" placeholder="METRO" value="<?php echo e($product->Metro); ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>OG PLU</p>
                </div>
                <div class="col-md-4">
                    <input id="og" type="number" class="form-control" name="og" placeholder="OG PLU" required>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">ROBINSON</p>
                </div>
                <div class="col-md-4">
                    <input id="robinson" type="number" class="form-control" name="robinson" placeholder="ROBINSON" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>BHG</p>
                </div>
                <div class="col-md-4">
                    <input id="bhg" type="number" class="form-control" name="bhg" placeholder="BHG" required>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">NTUC</p>
                </div>
                <div class="col-md-4">
                    <input id="ntuc" type="number" class="form-control" name="ntuc" placeholder="NTUC" required>
                </div> 
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Unit</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('unit', $product->Unit, ['class' => 'form-control', 'placeholder' => 'Unit'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Size</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('size', $product->Size, ['class' => 'form-control', 'placeholder' => 'Size'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Stock Level</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('stock_level', '', ['class' => 'form-control', 'placeholder' => 'Stock Level'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Threshold level</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('threshold', '', ['class' => 'form-control', 'placeholder' => 'Threshold level'])); ?>

                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Length</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('length', $product->ProductLength, ['class' => 'form-control', 'placeholder' => '00.00'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Width</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('width', $product->ProductWidth, ['class' => 'form-control', 'placeholder' => '00.00'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Weight</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('weight', $product->ProductWeight, ['class' => 'form-control', 'placeholder' => '00.00'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Height</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('height', $product->ProductHeight, ['class' => 'form-control', 'placeholder' => '00.00'])); ?>

                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Cost</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('cost', $product->Cost, ['class' => 'form-control', 'placeholder' => '00.00'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Last Vendor</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('lastVendor', $product->LastVendor, ['class' => 'form-control', 'placeholder' => 'Last Vendor'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Vendor Price</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('vendorPrice', $product->VendorPrice, ['class' => 'form-control', 'placeholder' => '00.00'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Barcode</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('barcode', $product->Barcode, ['class' => 'form-control', 'placeholder' => 'Barcode'])); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?php echo e(Form::textarea('description', $product->Description, ['class' => 'form-control', 'placeholder' => 'Description'])); ?>

            </div>
            <div class="col-md-4">
                <h4>Product</h4>
                <?php echo e(Form::file('image_add',array('id'=>'image_add'))); ?>

                <br></br>
                <div class="centerImage col-md-3" >
                <img src = "/storage/product_images/<?php echo e($product->image); ?>" id="addImage" width="150px" />
                <br>
                </div>
            </div>
        </div>
        <?php echo e(Form::hidden('_method', 'PUT')); ?>

    <br>
    <div class="form-group">
        <div style="text-align:left">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    <?php echo Form::close(); ?>

</div>
<?php $__env->stopSection(); ?>

<style>
    .productNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>