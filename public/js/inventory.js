$(document).ready(function(){
    $("#inventoryTable").DataTable();
    $.get('ajax/product_brand',function(data){
        $("#product_brand").empty();
        $("#brand").empty();
        $( "#tryExport" ).empty();
        $("#product_brand").append("<option value='all'>All</option>");
        $.each(data,function(i,value){
            var brand = value.Brand;
            $("#product_brand").append("<option value='" +value.id + "'>"
            + brand + "</option>");
            $("#brand").append("<option value='" + value.id + "'>"
            + brand + "</option>");
            // $( "#tryExport" ).append( "<a href='{{ route('exportInventory_outlet.file',['type'=>'csv', 'brand', "+ value.id+"]) }}'><button type='button' class='btn btn-primary'>Export</button></a>" );
        });
    });
    $.get('ajax/outlet',function(data){
        $("#outlet_location").empty();
        $("#outlet").empty();
        $("#outlet_location").append("<option value='all'>All</option>");
        $.each(data,function(i,value){
            var id = value.id;
            var outlet = value.outlet_name;
            var outlet_id = value.id;
            $("#outlet_location").append("<option value='" +
            outlet_id + "'>" + outlet + "</option>");
            $("#outlet").append("<option value='" +
            outlet_id + "'>" + outlet + "</option>");
        });
        $("#outlet_location").append("<option value='1'>All</option>");
    });
    $.get('ajax/category',function(data){
        $("#category").empty();
        $.each(data,function(i,value){
            $("#category").append("<option value='" + value.Category + "'>"
            + value.Category + "</option>");
        });
    });

    $("#searchField").autocomplete({
        source: 'autocomplete-search',
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
            console.log("filter set to ALL");
            $.get('ajax/inventory',function(data){
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
                            + "<td>" + value.stock_level + "/" + value.threshold_level + "</td></tr>"
                        );
                    });
                }
            });
        } else if (outlet == "all"){
            console.log("filter through all outlets");
            $.ajax({
                type: "GET",
                url: "/retrieve-inventory-by-product-brand/" + product_brand,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                console.log(response);
                    if(response.length == 0) {
                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
                    } else {
                        for (i = 0; i < response.length; i++) {
                            $("#inventoryContent").append(
                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                                + "<td>" + response[i].Brand + "</td>"
                                + "<td>" + response[i].Name + "</td>"
                                + "<td>" + response[i].UnitPrice + "</td>"
                                + "<td>" + response[i].Category + "</td>" 
                                + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
                            );
                        }
                    }
                },
                    
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
        } else if(product_brand == "all"){
            console.log("filter through all product brands");
            $.ajax({
                type: "GET",
                url: "/retrieve-inventory-by-outlet/" + outlet,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                console.log(response);
                    if(response.length == 0) {
                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
                    } else {
                    for (i = 0; i < response.length; i++) {
                        $("#inventoryContent").append(
                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                            + "<td>" + response[i].Brand + "</td>"
                            + "<td>" + response[i].Name + "</td>"
                            + "<td>" + response[i].UnitPrice + "</td>"
                            + "<td>" + response[i].Category + "</td>" 
                            + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
                        );
                    }
                    }
                },
                
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
        } else {
            $.ajax({
                type: "GET",
                url: "/retrieve-inventory-by-filter/" + outlet + "/" + product_brand,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if(response.length == 0) {
                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
                    } else {
                        for (i = 0; i < response.length; i++) {
                            $("#inventoryContent").append(
                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                                + "<td>" + response[i].Brand + "</td>"
                                + "<td>" + response[i].Name + "</td>"
                                + "<td>" + response[i].UnitPrice + "</td>"
                                + "<td>" + response[i].Category + "</td>" 
                                + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
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
            console.log("filter set to ALL");
            $.get('ajax/inventory',function(data){
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
                            + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
                        );
                    });
                }
            });
        } else if (outlet == "all"){
            console.log("filter through all outlets");
            $.ajax({
                type: "GET",
                url: "/retrieve-inventory-by-product-brand/" + product_brand,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                console.log(response);
                    if(response.length == 0) {
                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
                    } else {
                        for (i = 0; i < response.length; i++) {
                            $("#inventoryContent").append(
                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                                + "<td>" + response[i].Brand + "</td>"
                                + "<td>" + response[i].Name + "</td>"
                                + "<td>" + response[i].UnitPrice + "</td>"
                                + "<td>" + response[i].Category + "</td>" 
                                + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
                            );
                        }
                    }
                },
                    
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
        } else if(product_brand == "all"){
            console.log("filter through all product brands");
            $.ajax({
                type: "GET",
                url: "/retrieve-inventory-by-outlet/" + outlet,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                console.log(response);
                    if(response.length == 0) {
                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
                    } else {
                    for (i = 0; i < response.length; i++) {
                        $("#inventoryContent").append(
                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                            + "<td>" + response[i].Brand + "</td>"
                            + "<td>" + response[i].Name + "</td>"
                            + "<td>" + response[i].UnitPrice + "</td>"
                            + "<td>" + response[i].Category + "</td>" 
                            + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
                        );
                    }
                    }
                },
                
                error: function (obj, textStatus, errorThrown) {
                    console.log("Error " + textStatus + ": " + errorThrown);
                }
            });
        } else {
            $.ajax({
                type: "GET",
                url: "/retrieve-inventory-by-filter/" + outlet + "/" + product_brand,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if(response.length == 0) {
                        $("#inventoryContent").append("<p style='text-align: center;'>No Inventory found</p>");
                    } else {
                        for (i = 0; i < response.length; i++) {
                            $("#inventoryContent").append(
                                "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                                + "<td>" + response[i].Brand + "</td>"
                                + "<td>" + response[i].Name + "</td>"
                                + "<td>" + response[i].UnitPrice + "</td>"
                                + "<td>" + response[i].Category + "</td>" 
                                + "<td>" + response[i].stock_level + "/" + response[i].threshold_level + "</td></tr>"
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
});

function openImportCSVModal() {
    document.getElementById('importCSVModal').style.display = "block";
}

function closeImportCSVModal() {
    document.getElementById('importCSVModal').style.display = "none";
}
function openExportCategoryModal() {
    document.getElementById('exportCategoryModal').style.display = "block";
}

function closeExportCategoryModal() {
    document.getElementById('exportCategoryModal').style.display = "none";
}
function openExportOutletModal() {
    document.getElementById('exportOutletModal').style.display = "block";
}

function closeExportOutletModal() {
    document.getElementById('exportOutletModal').style.display = "none";
}
function openExportBrandModal() {
    document.getElementById('exportBrandModal').style.display = "block";
}

function closeExportBrandModal() {
    document.getElementById('exportBrandModal').style.display = "none";
}
