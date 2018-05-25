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
        <p>Search item brand</p>
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
    <div class="col-md-2">
            <button type="button" class="btn btn-success btn-search" onclick="openImportCSVModal()">Import</button></a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('inventory.export.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-inflow">Export</button></a>
        </div>
        <div class="col-md-6">
            <input type="text" id="searchField" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-search" id="searchInventory">Search</button>
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
                <th>Category</th>
                <th>Quantity/Thresold</th>
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

<div id="importCSVModal" class="modal">
    <span class="close cursor" onclick="closeImportCSVModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Select your inventory file here </h3>
            <br>
            <?php echo Form::open(['action' => ['InventoryController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

                
                <?php echo e(csrf_field()); ?>


                <div class="row">
                <div style="text-align:center"><?php echo e(Form::file('inventory_csv',array('id'=>'inventory_csv'))); ?></div>
                <h3 id="addCSVFile">testing</h3>
                </div>

                <br>

                <div class="form-group">
                    <div style="text-align:center">
                        <button type="submit" class="btn btn-primary">
                            Import
                        </button>
                    </div>
                </div>
            <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $.get("<?php echo e(URL::to('ajax/inventory')); ?>",function(data){
            $("#product_brand").empty();
            $.each(data,function(i,value){
                var brand = value.Brand;
                var outlet = value.outlet_name;
                $("#product_brand").append("<option value='" +
                value.id + "'>" +brand + "</option>");
                // $("#outlet_location").append("<option value='" +
                // value.id + "'>" +outlet + "</option>");
            });
        });
        $.get("<?php echo e(URL::to('ajax/inventory-outlet')); ?>",function(data){
            $("#outlet_location").empty();
            $.each(data,function(i,value){
                var id = value.id;
                var outlet = value.outlet_name;
                var outlet_id = value.outlets_id;
                $("#outlet_location").append("<option value='" +
                outlet_id + "'>" +outlet + "</option>");
            });
            $("#outlet_location").append("<option value='1'>All</option>");
        });
    
        $("#searchField").autocomplete({
            source: "<?php echo e(URL::to('autocomplete-search')); ?>",
            minLength:1,
            select:function(key,value)
            {
                console.log(value);
            }
        });

        $("#outlet_location").change(function(){
            var outlet = $(this).val();
            $("#inventoryContent").empty();
            $.ajax({
                type: "GET",
                url: "<?php echo e(URL::TO('/retrieve-inventory-by-outlet')); ?>/" +outlet,
                // data: "outlet=" + outlet,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    for (i = 0; i < response.length; i++) {
                        $("#inventoryContent").append(
                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                            + "<td>" + response[i].Brand + "</td>"
                            + "<td>" + response[i].Name + "</td>"
                            + "<td>" + response[i].UnitPrice + "</td>"
                            + "<td></td>" 
                            + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
                        );
                    }
                },
                
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
        });

        $("#searchInventory").click(function(){
            var productName = $("#searchField").val();
            console.log(productName);
            $("#inventoryContent").empty();
            $.ajax({
                type: "GET",
                url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-name')); ?>/" + productName,
                // data: "products.Name=" + productName,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    for (i = 0; i < response.length; i++) {
                        $("#inventoryContent").append(
                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                            + "<td>" + response[i].Brand + "</td>"
                            + "<td>" + response[i].Name + "</td>"
                            + "<td>" + response[i].UnitPrice + "</td>"
                            + "<td></td>" 
                            + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
                        );
                    }
                },

                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
        });
    });

    function openImportCSVModal() {
        document.getElementById('importCSVModal').style.display = "block";
    }

    function closeImportCSVModal() {
        document.getElementById('importCSVModal').style.display = "none";
    }
</script>

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