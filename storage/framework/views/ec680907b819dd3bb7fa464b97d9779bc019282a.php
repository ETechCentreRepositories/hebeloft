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
    <h3>Add new product</h3>
    <br>
    <?php echo Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']); ?>

    <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Name</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name', 'id'=>'Name'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Category</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('category', '', ['class' => 'form-control', 'placeholder' => 'Category', 'id'=>'category'])); ?>

                </div>
                   
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Remarks</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('remarks', '', ['class' => 'form-control', 'placeholder' => 'Remarks', 'id'=>'remarks'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Brand</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Brand', 'id'=>'brand'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>UnitPrice</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('unitPrice', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'unitPrice'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">METRO</p>
                </div>
                <div class="col-md-4">
                    <input id="metro" type="number" class="form-control" name="metro" placeholder="METRO" required>
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
                    <?php echo e(Form::text('unit', '', ['class' => 'form-control', 'placeholder' => 'Unit', 'id'=>'unit'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Size</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('size', '', ['class' => 'form-control', 'placeholder' => 'Size', 'id'=>'size'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Stock Level</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('stock_level', '', ['class' => 'form-control', 'placeholder' => 'Stock Level', 'id'=>'stock_level'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Threshold level</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('threshold', '', ['class' => 'form-control', 'placeholder' => 'Threshold level', 'id'=>'threshold'])); ?>

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
                    <?php echo e(Form::text('length', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'length'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Width</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('width', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'width'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Weight</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('weight', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'weight'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Height</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('height', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'height'])); ?>

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
                    <?php echo e(Form::text('cost', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'cost'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Last Vendor</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('lastVendor', '', ['class' => 'form-control', 'placeholder' => 'Last Vendor', 'id'=>'lastVendor'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Vendor Price</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('vendorPrice', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'vendorPrice'])); ?>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Barcode</p>
                </div>
                <div class="col-md-4">
                    <?php echo e(Form::text('barcode', '', ['class' => 'form-control', 'placeholder' => 'Barcode', 'id'=>'Barcode'])); ?>

                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-7">
            <?php echo e(Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description', 'id' => 'desc'])); ?>

        </div>
        <div class="col-md-7">
            <input type="text" id="searchField" style="text-indent:20px;" class="form-control" style="background:transparent;">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" id="selectThis">SELECT</button>
        </div>
        <div class="col-md-1">
            <input type="checkbox" onclick="myFunction()" id="myCheck">Existing product</div>
        </div>
        <div class="col-md-4">
            <h4>Select image File</h4>
            <?php echo e(Form::file('image',array('id'=>'image_add'))); ?>

            <br></br>
            <div class="centerImage col-md-3" >
               <img src="" id="addImage" width="150px" />
               <br>
            </div>
        </div>
        <div class="form-group">
            <div style="text-align:left">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
    <br>
    
    <?php echo Form::close(); ?>

</div>

<script>
    function myFunction() {
    var checkBox = document.getElementById("myCheck");

    if (checkBox.checked == true){
        document.getElementById("searchField").style.display = "block";
        document.getElementById("desc").style.display = "none";
    } else {
        document.getElementById("desc").style.display = "block";
        document.getElementById("searchField").style.display = "none";
    }
}
</script>

<?php $__env->stopSection(); ?>

<style>
    .productNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }

    #searchField {
        display: none;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>