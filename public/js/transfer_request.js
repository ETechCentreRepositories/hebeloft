$(document).ready(function(){
    $('#search').click(function(){
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        console.log(startDate + endDate);
        $("#transferRequestContent").empty();
        $.ajax({
            type: "GET",
            url: "/ajax/transferrequest/date/" + startDate + "/" + endDate,
            cache: false,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                for (i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    $("#transferRequestContent").append(
                        "<tr><td>"+ response[i].date+"</td>"
                        + "<td>"+ response[i].status +"</td>"
                        + "<td>"+ response[i].status_name+"</td>"
                        + "@if ($users_id->roles_id == '1')"
                        + "<td><a href='/transferrequest/"+response[i].id+"/edit'><button type='button' class='btn btn-primary action-buttons'>Edit</button></a></td></tr>"
                        + "@endif"
                    );
                }
            },

            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });

    $("#transferRequestSearchField").autocomplete({
        source: 'autocomplete-search',
        minLength:1,
        select:function(key,value)
        {
            console.log(value);
        }
    });

    var trProducts = [];
    $(document).on("click","#addTransferRequest",function(){
        var productName = $("#transferRequestSearchField").val();
        console.log(productName);
        $.ajax({
            type: "GET",
            url: "/retrieve-inventory-by-product-name/" + productName,
            cache:false,
            datatype: "JSON",
            success: function (response) {
                console.log(response);
                for (i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    var productId = parseInt(response[i].products_id);

                    trProducts.push(productId);
                    console.log(trProducts);
                        
                    $("#addTransferRequestContent").append(
                        "<tr id='newRow_"+productId+"'>"
                        + "<td><img style='width:60px; height:60px' src='/hebeloft/storage/product_images/"+ response[i].image +"'/></td>"
                        + "<td>" + response[i].Name + "</td>"
                        + "<td align='center'><input name='quantity' type='number' id='qty' type='text' style='width:60px;' value='1'/></td>"
                        + "<td><button type='button' class='btn btn-danger action-buttons' id='removeTR'> Remove </button></td></tr>"
                    );
                }
            },

            error: function (obj, testStatus, errorThrown) {
                console.log("failure");
            }
        });
    });

    $("#saveTransferRequest").click(function () {
        var outlet = $('#outlet').val();
        var dates = $("#transferRequestDate").val();
        var remarks = $("#remarks").val();
        if(trProducts !== null) {
            console.log(trProducts);
            for(var i = 0; i<trProducts.length; i++){
                console.log(trProducts[i]);
                var productID = trProducts[i];
                var mainRow = document.getElementById("newRow_"+productID);
                var quantity = mainRow.querySelectorAll('#qty')[0].value;
                console.log(productID );
                console.log(quantity);
                console.log(outlet);
                console.log(dates);
                console.log(remarks);
                $.ajax({
                    type: "GET",
                    url: "/transferrequest/addtocart/" + productID + "/" + quantity + "/" + outlet + "/" + dates + "/" + remarks,
                    cache:false,
                    datatype: "JSON",
                    success: function (response) {
                        console.log("successful");
                    },

                    error: function (obj, testStatus, errorThrown) {
                        console.log("failure");
                    }
                });
            }
        } else {
            console.log("null");
        }
    });

    $(document).on("click","#removeTR",function(){
        var id = $("#removeTR").closest('tr').attr('id');
        for(var i = 0; i<trProducts.length; i++) {
            if(trProducts[i] == id) {
                trProducts.splice(i,1);
            }
        }
        $("#removeTR").closest('tr').remove();
        console.log(id);
    });
});

function removeCartItemFromTransferRequest() {
    var id = $("#removeThis").closest('tr').attr('id');
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/transferrequest/remove/" + id,
        cache:false,
        datatype: "JSON",
        success: function (response) {
            console.log("successful");
            $("#removeThis").closest('tr').remove();
        },

        error: function (obj, testStatus, errorThrown) {
            console.log("failure");
        }
    });
}

function openViewTransferModal() {
    document.getElementById('viewTransferModal').style.display = "block";
}

function closeViewTransferModal() {
    document.getElementById('viewTransferModal').style.display = "none";
}