$(document).ready(function () {
    $("#productTable").DataTable();
    $("#searchField").autocomplete({
        source: "/autocomplete-search-description/",
        minLength:1,
        select:function(key,value)
        {
            console.log(value);
        }
    });
    $("#selectThis").click(function () {
        var productName = $("#searchField").val();
        console.log(productName);
        $.ajax({
            type: "GET",
            url: "/retrieve-product-by-name/" + productName,
            data: "",
            cache:false,
            datatype: "JSON",
            success: function (response) {
                console.log("success");
                $("#Name").val(response[0]['Description']);
                $("#category").val(response[0]['Category']);
                $("#remarks").val(response[0]['Remarks']);
                $("#brand").val(response[0]['Brand']);
                $("#unitPrice").val(response[0]['UnitPrice']);
                $("#metro").val(response[0]['Metro']);
                $("#og").val(response[0]['OG_PLU']);
                $("#robinson").val(response[0]['Robinsons']);
                $("#bhg").val(response[0]['BHG']);
                $("#ntuc").val(response[0]['NTUC']);
                $("#unit").val(response[0]['Unit']);
                $("#size").val(response[0]['Size']);
                $("#length").val(response[0]['ProductLength']);
                $("#width").val(response[0]['ProductWidth']);
                $("#weight").val(response[0]['ProductWeight']);
                $("#height").val(response[0]['ProductHeight']);
                $("#cost").val(response[0]['Cost']);
                $("#lastVendor").val(response[0]['LastVendor']);
                $("#vendorPrice").val(response[0]['VendorPrice']);
                $("#Barcode").val(response[0]['BarCode']);

                console.log(response);
            },

            error: function (obj, testStatus, errorThrown) {
                console.log("fail");
            }
        });
    });
    $("#search").click(function(){
        var productName = $("#productSearchField").val();
        console.log(productName);
        $("#productContent").empty();
        $(".pagination").hide();
        $.ajax({
            type: "GET",
            url: "/products/updatePrice10/",
            cache: false,
            datatype: JSON,
            success:function(response) {
                console.log(response);

                var mysql = require('mysql');

                var con = mysql.createConnection({
                    host: "127.0.0.1",
                    user: "root",
                    password: "",
                    database: "hebeloft"
                });

                con.connect(function(err) {
                    if (err) throw err;
                    con.query("SELECT * FROM products", function (err, result, fields) {
                        if (err) throw err;
                        console.log(result);
                    });
                });
            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });

    $("#bulkUpdate20").click(function () {
        $.ajax({
            type: "GET",
            url: "/products/updatePrice20/",
            cache: false,
            datatype: JSON,
            success:function(response) {
                console.log(response);

                var mysql = require('mysql');

                var con = mysql.createConnection({
                    host: "127.0.0.1",
                    user: "root",
                    password: "",
                    database: "hebeloft"
                });

                con.connect(function(err) {
                    if (err) throw err;
                    con.query("SELECT * FROM products", function (err, result, fields) {
                        if (err) throw err;
                        console.log(result);
                    });
                });
            },
            url: "/retrieve-inventory-by-product-name/" + productName,
            cache: false,
            dataType: "JSON",
            success: function (response) {
                if(response == null) {$("#inventoryContent").append(
                    "<p style='text-align: center;'>No Inventory found</p>")    
                } else {
                    for (i = 0; i < response.length; i++) {
                        $("#productContent").append(
                            "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                            + "<td>" + response[i].Brand + "</td>"
                            + "<td>" + response[i].Name + "</td>"
                            + "<td>" + response[i].Description + "</td>"
                            + "<td>" + response[i].Category + "</td>"
                            + "<td>" + response[i].UnitPrice + "</td>"
                            + "if ($users_id->roles_id == '1') {"
                            + "<td><div class='d-flex flex-column'><div class='d-flex flex-row product-buttons'><div class='p-2'>"
                            + "<a href='/product/{{$product->id}}/edit'><button type='button' class='btn btn-primary action-buttons'>Edit</button></a>"
                            + "</div><div class'p-2'><form method='POST' action='[{{URL::TO('ProductsController@destroy')}}]'>"
                            + "<input name='_method' type='hidden' value='DELETE'><input class='btn btn-danger action-buttons' type='submit' value='Delete'>"
                            + "</form>"
                            + "</div></div></div></td></tr>"
                            + "}"
                        );
                    }
                }
            },

            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });

    $("#revert").click(function () {
        $.ajax({
            type: "GET",
            url: "/products/revertPrice/",
            cache: false,
            datatype: JSON,
            success:function(response) {
                console.log(response);
            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });

    $("#image_add").change(function(){
        console.log("image_add");
        readURL(this);
    });

});

function readURL(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function(e){
            $('#addImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

