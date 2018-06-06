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
        <?php echo Form::open(['action' => ['ProductsController@update', $products->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Name</p>
                </div>
                <div class="col-md-5">
                    <?php echo e(Form::text('name', $products->Name, ['class' => 'form-control', 'placeholder' => 'Name'])); ?>

                </div>
                <div class="col-md-2">
                    <p style="text-align:right">OG PLU</p>
                </div>
                <div class="col-md-4">
                    <input id="ogplu" type="number" class="form-control" name="ogPLU" placeholder="OG PLU" value="<?php echo e($products->OG_PLU); ?>" required>
                </div>   
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Category</p>
                </div>
                <div class="col-md-5">
                    <?php echo e(Form::text('category', $products->Category, ['class' => 'form-control', 'placeholder' => 'Category'])); ?>

                </div>
                <div class="col-md-2">
                    <p style="text-align:right">BHG</p>
                </div>
                <div class="col-md-4">
                    <input id="bhg" type="number" class="form-control" name="bhg" placeholder="BHG" value="<?php echo e($products->BHG); ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Brand</p>
                </div>
                <div class="col-md-5">
                    <?php echo e(Form::text('brand', $products->Brand, ['class' => 'form-control', 'placeholder' => 'Brand'])); ?>

                </div>
                <div class="col-md-2">
                    <p style="text-align:right">METRO</p>
                </div>
                <div class="col-md-4">
                    <input id="metro" type="number" class="form-control" name="metro" placeholder="METRO" value="<?php echo e($products->Metro); ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>UnitPrice</p>
                </div>
                <div class="col-md-5">
                    <?php echo e(Form::text('unitPrice', $products->UnitPrice, ['class' => 'form-control', 'placeholder' => 'UnitPrice'])); ?>

                </div>
                <div class="col-md-2">
                    <p style="text-align:right">ROBINSON</p>
                </div>
                <div class="col-md-4">
                    <input id="robinson" type="number" class="form-control" name="robinson" placeholder="ROBINSON" value="<?php echo e($products->Robinsons); ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Remarks</p>
                </div>
                <div class="col-md-5">
                    <?php echo e(Form::text('remarks', $products->Remarks, ['class' => 'form-control', 'placeholder' => 'Remarks'])); ?>

                </div>
                <div class="col-md-2">
                    <p style="text-align:right">NTUC</p>
                </div>
                <div class="col-md-4">
                    <input id="ntuc" type="number" class="form-control" name="ntuc" placeholder="NTUC" value="<?php echo e($products->NTUC); ?>" required>
                </div> 
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Size</p>
                </div>
                <div class="col-md-5">
                    <?php echo e(Form::text('size', $products->Size, ['class' => 'form-control', 'placeholder' => 'Size'])); ?>

                </div>
                <div class="col-md-2">
                    <p style="text-align:right"><p style="text-align:right">Threshold level</p></p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('threshold', '', ['class' => 'form-control', 'placeholder' => 'Threshold level'])); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?php echo e(Form::textarea('description', $products->Description, ['class' => 'form-control', 'placeholder' => 'Description'])); ?>

            </div>
            <div class="col-md-4">
                <h4>Product</h4>
                <?php echo e(Form::file('image_add',array('id'=>'image_add'))); ?>

                <br></br>
                <div class="centerImage col-md-3" >
                <img src = "" id="addImage" width="150px" />
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