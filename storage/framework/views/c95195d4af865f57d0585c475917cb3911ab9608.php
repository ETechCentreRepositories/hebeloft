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
        <p>Search by Brand</p>
        </div>
        <div class="col-md-9">
            <select id="product_brand" class="form-control"></select>
        </div>
    </div>
    <br>
    <?php if($users_id->roles_id == '1' || $users_id->roles_id == '2' || $users_id->roles_id == '3'): ?>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>Show Location</p>
        </div>
        <div class="col-md-9">
            <select id="outlet_location" class="form-control" ></select>
        </div>
    </div>
    <br>
    <?php endif; ?>
    
    <div class="row">
    <div class="col-md-10">
            <input type="text" id="searchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('exportInventory.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-inflow">Export</button></a>
        </div>
        <div class="col-md-6">
            <input type="text" id="searchField" class="form-control" style="background:transparent">
        </div>
        <br>
        </br>
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
    <table class="table table-striped sortable" id="inventoryTable" >
        <thead>
            <tr>
                <th>Image</th>
                <th>Brand</th>
                <th>Item</th>
                <th>Normal Price</th>
                <th>Category</th>
                <th>Quantity</th>
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
                <td align="right"><?php echo e($inventoryOutlet->stock_level); ?></td>
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

                <div style="text-align:center"><?php echo e(Form::file('inventory_csv',array('id'=>'inventorycsv','style'=>'min-width: fit-content;
    width: fit-content;'))); ?></div>
                <br>
                <div style="text-align:center">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
                <?php echo Form::close(); ?>

            </div>
       </div>
    </div>
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
        $.get("<?php echo e(URL::to('ajax/product_brand')); ?>",function(data){
            $("#product_brand").empty();
            $("#product_brand").append("<option value='all'>All</option>");
            $.each(data,function(i,value){
                var brand = value.Brand;
                $("#product_brand").append("<option value='" +
                value.id + "'>" + brand + "</option>");
            });
        });
        $.get("<?php echo e(URL::to('ajax/outlet')); ?>",function(data){
            $("#outlet_location").empty();
            $("#outlet_location").append("<option value='all'>All</option>");
            $.each(data,function(i,value){
                var id = value.id;
                var outlet = value.outlet_name;
                var outlet_id = value.id;
                $("#outlet_location").append("<option value='" +
                outlet_id + "'>" + outlet + "</option>");
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
            var product_brand = $("#product_brand").val();
            console.log("Product brand: " + product_brand);
            console.log("Outlet: " + outlet);
            $("#inventoryContent").empty();
                if (outlet == "all" && product_brand == "all") {
                    console.log("all");
                    $.get("<?php echo e(URL::to('ajax/inventory')); ?>",function(data){
	                if(data == null) {
	                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                } else {
	                    console.log(data);
	                    $.each(data,function(i,value){
	            	        $("#inventoryContent").append(
	                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ value.image +"'/></td>"
	                            + "<td>" + value.Brand + "</td>"
	                            + "<td>" + value.Name + "</td>"
	                    	    + "<td>" + value.UnitPrice + "</td>"
	                            + "<td>" + value.Category + "</td>" 
	                            + "<td>" + value.stock_level + "</td></tr>"
	                	);
	                    });
	                }
                    });
	        } else if (outlet == "all"){
	            console.log("outlet is all");
	            $.ajax({
		            type: "GET",
		            url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-brand')); ?>/" + product_brand,
		            cache: false,
		            dataType: "JSON",
		            success: function (response) {
		            console.log(response);
		                if(response.length == 0) {
		                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
		                } else {
		                    document.getElementById('pagination').style.display = 'none';
		                    for (i = 0; i < response.length; i++) {
		                        $("#inventoryContent").append(
		                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
		                            + "<td>" + response[i].Brand + "</td>"
		                            + "<td>" + response[i].Name + "</td>"
		                            + "<td>" + response[i].UnitPrice + "</td>"
		                            + "<td>" + response[i].Category + "</td>" 
		                            + "<td>" + response[i].stock_level + "</td></tr>"
		                        );
		                    }
		                }
		            },
		                
		            error: function (obj, textStatus, errorThrown) {
		                console.log("Error " + textStatus + ": " + errorThrown);
		            }
		    });
	        } else if(product_brand == "all"){
	            console.log("product brand is all");
	            $.ajax({
	                type: "GET",
	                url: "<?php echo e(URL::TO('/retrieve-inventory-by-outlet')); ?>/" + outlet,
	                cache: false,
	                dataType: "JSON",
	                success: function (response) {
	                console.log(response);
	                    if(response.length == 0) {
	                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                    } else {
	                    document.getElementById('pagination').style.display = 'none';
	                    for (i = 0; i < response.length; i++) {
	                        $("#inventoryContent").append(
	                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
	                            + "<td>" + response[i].Brand + "</td>"
	                            + "<td>" + response[i].Name + "</td>"
	                            + "<td>" + response[i].UnitPrice + "</td>"
	                            + "<td>" + response[i].Category + "</td>" 
	                            + "<td>" + response[i].stock_level + "</td></tr>"
	                        );
	                    }
	                    }
	                },
	                
	                error: function (obj, textStatus, errorThrown) {
	                    console.log("Error " + textStatus + ": " + errorThrown);
	                }
	            });
	        } else {
	            console.log("normal");
	            $.ajax({
	                type: "GET",
	                url: "<?php echo e(URL::TO('/retrieve-inventory-by-filter')); ?>/" + outlet + "/" + product_brand,
	                cache: false,
	                dataType: "JSON",
	                success: function (response) {
	                    console.log(response);
	                    if(response.length == 0) {
	                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                    } else {
	                        document.getElementById('pagination').style.display = 'none';
	                        for (i = 0; i < response.length; i++) {
	                            $("#inventoryContent").append(
	                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
	                                + "<td>" + response[i].Brand + "</td>"
	                                + "<td>" + response[i].Name + "</td>"
	                                + "<td>" + response[i].UnitPrice + "</td>"
	                                + "<td>" + response[i].Category + "</td>" 
	                                + "<td>" + response[i].stock_level + "</td></tr>"
	                            );
	                    }
	                    }
	                },
	                
	                error: function (obj, textStatus, errorThrown) {
	                    console.log("Error " + textStatus + ": " + errorThrown);
	                }
	            });
	        }
        });

        $("#product_brand").change(function(){
            var product_brand = $(this).val();
            var outlet = $("#outlet_location").val();
            console.log("Product brand: " + product_brand);
            console.log("Outlet: " + outlet);
            $("#inventoryContent").empty();
                if (outlet == "all" && product_brand == "all") {
                    console.log("all");
                    $.get("<?php echo e(URL::to('ajax/inventory')); ?>",function(data){
	                if(data == null) {
	                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                } else {
	                    console.log(data);
	                    $.each(data,function(i,value){
	            	        $("#inventoryContent").append(
	                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ value.image +"'/></td>"
	                            + "<td>" + value.Brand + "</td>"
	                            + "<td>" + value.Name + "</td>"
	                    	    + "<td>" + value.UnitPrice + "</td>"
	                            + "<td>" + value.Category + "</td>" 
	                            + "<td>" + value.stock_level + "</td></tr>"
	                	);
	                    });
	                }
                    });
	        } else if (outlet == "all"){
	            console.log("outlet is all");
	            $.ajax({
		            type: "GET",
		            url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-brand')); ?>/" + product_brand,
		            cache: false,
		            dataType: "JSON",
		            success: function (response) {
		            console.log(response);
		                if(response.length == 0) {
		                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
		                } else {
		                    document.getElementById('pagination').style.display = 'none';
		                    for (i = 0; i < response.length; i++) {
		                        $("#inventoryContent").append(
		                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
		                            + "<td>" + response[i].Brand + "</td>"
		                            + "<td>" + response[i].Name + "</td>"
		                            + "<td>" + response[i].UnitPrice + "</td>"
		                            + "<td>" + response[i].Category + "</td>" 
		                            + "<td>" + response[i].stock_level + "</td></tr>"
		                        );
		                    }
		                }
		            },
		                
		            error: function (obj, textStatus, errorThrown) {
		                console.log("Error " + textStatus + ": " + errorThrown);
		            }
		    });
	        } else if(product_brand == "all"){
	            console.log("product brand is all");
	            $.ajax({
	                type: "GET",
	                url: "<?php echo e(URL::TO('/retrieve-inventory-by-outlet')); ?>/" + outlet,
	                cache: false,
	                dataType: "JSON",
	                success: function (response) {
	                console.log(response);
	                    if(response.length == 0) {
	                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                    } else {
	                    document.getElementById('pagination').style.display = 'none';
	                    for (i = 0; i < response.length; i++) {
	                        $("#inventoryContent").append(
	                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
	                            + "<td>" + response[i].Brand + "</td>"
	                            + "<td>" + response[i].Name + "</td>"
	                            + "<td>" + response[i].UnitPrice + "</td>"
	                            + "<td>" + response[i].Category + "</td>" 
	                            + "<td>" + response[i].stock_level + "</td></tr>"
	                        );
	                    }
	                    }
	                },
	                
	                error: function (obj, textStatus, errorThrown) {
	                    console.log("Error " + textStatus + ": " + errorThrown);
	                }
	            });
	        } else if (outlet == "all"){
	            console.log("outlet is all");
	            $.ajax({
		            type: "GET",
		            url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-brand')); ?>/" + product_brand,
		            cache: false,
		            dataType: "JSON",
		            success: function (response) {
		            console.log(response);
		                if(response.length == 0) {
		                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
		                } else {
		                    document.getElementById('pagination').style.display = 'none';
		                    for (i = 0; i < response.length; i++) {
		                        $("#inventoryContent").append(
		                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
		                            + "<td>" + response[i].Brand + "</td>"
		                            + "<td>" + response[i].Name + "</td>"
		                            + "<td>" + response[i].UnitPrice + "</td>"
		                            + "<td>" + response[i].Category + "</td>" 
		                            + "<td>" + response[i].stock_level + "</td></tr>"
		                        );
		                    }
		                }
		            },
		                
		            error: function (obj, textStatus, errorThrown) {
		                console.log("Error " + textStatus + ": " + errorThrown);
		            }
		    });
	        } else if (outlet == null) {
	            $.ajax({
                    type: "GET",
		            url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-brand/for-wholesaler')); ?>/" + product_brand,
		            cache: false,
		            dataType: "JSON",
		            success: function (response) {
		            console.log(response);
		                if(response.length == 0) {
		                    $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
		                } else {
		                    document.getElementById('pagination').style.display = 'none';
		                    for (i = 0; i < response.length; i++) {
		                        $("#inventoryContent").append(
		                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
		                            + "<td>" + response[i].Brand + "</td>"
		                            + "<td>" + response[i].Name + "</td>"
		                            + "<td>" + response[i].UnitPrice + "</td>"
		                            + "<td>" + response[i].Category + "</td>" 
		                            + "<td>" + response[i].stock_level + "</td></tr>"
		                        );
		                    }
		                }
		            },
		                
		            error: function (obj, textStatus, errorThrown) {
		                console.log("Error " + textStatus + ": " + errorThrown);
		            }
		    });
	        } else {
	            console.log("normal");
	            $.ajax({
	                type: "GET",
	                url: "<?php echo e(URL::TO('/retrieve-inventory-by-filter')); ?>/" + outlet + "/" + product_brand,
	                cache: false,
	                dataType: "JSON",
	                success: function (response) {
	                    console.log(response);
	                    if(response.length == 0) {
	                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
	                    } else {
	                        document.getElementById('pagination').style.display = 'none';
	                        for (i = 0; i < response.length; i++) {
	                            $("#inventoryContent").append(
	                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
	                                + "<td>" + response[i].Brand + "</td>"
	                                + "<td>" + response[i].Name + "</td>"
	                                + "<td>" + response[i].UnitPrice + "</td>"
	                                + "<td>" + response[i].Category + "</td>" 
	                                + "<td>" + response[i].stock_level + "</td></tr>"
	                            );
	                    }
	                    }
	                },
	                
	                error: function (obj, textStatus, errorThrown) {
	                    console.log("Error " + textStatus + ": " + errorThrown);
	                }
	            });
	        }
        });

        $("#product_brand").change(function(){
            var product_brand = $(this).val();
            console.log(product_brand);
            $("#inventoryContent").empty();
            $.ajax({
                type: "GET",
                url: "<?php echo e(URL::TO('/retrieve-inventory-by-product-brand')); ?>/" +product_brand,
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
                            + "<td>" + response[i].stock_level + "</td></tr>"
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
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    if(response == null) {$("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>")
                    }else {
                    for (i = 0; i < response.length; i++) {
                        $("#inventoryContent").append(
                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                            + "<td>" + response[i].Brand + "</td>"
                            + "<td>" + response[i].Name + "</td>"
                            + "<td>" + response[i].UnitPrice + "</td>"
                            + "<td>" + response[i].Category + "</td>" 
                            + "<td>" + response[i].stock_level + "</td></tr>"
                        );
                    }
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

<div class="pagination" id="pagination">
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
    
    #searchField{
        background-image:url(http://ehostingcentre.com/hebeloft/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>