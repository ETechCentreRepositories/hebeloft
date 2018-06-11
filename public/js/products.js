$(document).ready(function () {
    $("#productTable").DataTable();
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
