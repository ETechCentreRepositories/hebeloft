@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br><br><br>

<h2>Sales Record</h2>
<br>
<div class="container">
    <form id="formCreateSalesRecord" action="{{'SalesRecordController@create'}}" method="POST">
        <div class="row">
            <div class="col-md-3">
                <p>Outlet: </p>
            </div>
            <div class="col-md-9">
                <select name="outlet" id="outlet" class="form-control"></select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <p>Date:</p>
            </div>
            <div class="col-md-9">
                <input type="date" id="salesRecordDate" name ="salesRecordDate" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
                <div class="col-md-10">
                    <input type="text" id="salesRecordSearchField" class="form-control" style="background:transparent">
                </div>
                <div class="col-md-2">
                <button type="button" class="btn btn-default btn-search" id="addSalesRecord">Add</button>
                </div>
            </div>
        <br>
        <table class="table table-striped" id="createSalesRecordTable">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Brand</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Total Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="addSalesRecordContent">
                        <td id="productPicture"></td>
                        <td id="productBrand"></td>
                        <td id="productName"></td>
                        <td id="productPrice"></td>
                        <td id="productQuantity"><input name='quantity' id='quantity' type='text' style='width:60px;' value='1'/></td>
                        <td id="productDiscount"><input name='discount' id='discount' type='text' style='width:60px;' value='1'/></td>
                        <td id="productTotalPrice"></td>
                        <td id="action"></td>
                </tbody>
        </table>
    </form>
</div>

<script>
    $(document).ready(function(){
        $.get("{{ URL::to('ajax/outlet')}}",function(data){
            $("#outlet").empty();
            $.each(data,function(i,value){
                var id = value.id;
                var outlet = value.outlet_name;
                var outlet_id = value.id;
                $("#outlet").append("<option value='" +
                outlet_id + "'>" +outlet + "</option>");
            });
            
        });

        $("#salesRecordSearchField").autocomplete({
            source: "{{URL::to('autocomplete-search')}}",
            minLength:1,
            select:function(key,value)
            {
                console.log(value);
            }
        });

        $("#addSalesRecord").click(function(){
            var productName = $("#salesRecordSearchField").val();
            console.log(productName);
            $.ajax({
                     type: "GET",
                     url: "{{URL::TO('/retrieve-add-inventory-by-product-name')}}/" + productName,
                     // data: "products.Name=" + productName,
                     cache: false,
                     dataType: "JSON",
                     success: function (response) {
                        //  {{ route('product.addToCart', ['id' => 1 ])}}
                        //  for (i = 0; i < response.length; i++) {
                        //      $("#addSalesRecordContent").append(
                        //          "<tr><td><img style='width:60px; height:60px' src='/storage/product_images/"+ response[i].image +"'/></td>"
                        //          + "<td>" + response[i].Brand + "</td>"
                        //          + "<td>" + response[i].Name + "</td>"
                        //          + "<td>" + response[i].UnitPrice + "</td>"
                        //          + "<td><input name='quantity' type='number' id='quantity' onChange='getPrice()' type='text' style='width:60px;' value='1'/></td>"
                        //          + "<td><input name='discount' id='discount' type='text' style='width:60px;' value=''/></td>" 
                        //          + "<td id='price'></td>"
                        //          + "<td></td></tr>"
                        //      );
                        //  }
                        
 
                     },
                     error: function (obj, textStatus, errorThrown) {
                 }
                 
            });
            // $.ajax({
            //         type: "GET",
            //         url: "{{URL::TO('/salesrecord/addSalesRecordList')}}/" +productName,
            //         // data: "products.Name=" + productName,
            //         cache: false,
            //         dataType: "JSON",
            //         success: function (response) {
            //             console.log(response);
            //             console.log('sales record added successful');

            //             //retrieve item by sales id 
            //             $.ajax({
            //                 type: "GET",
            //                 url: "{{URL::TO('/salesrecord/retrieveItemBySalesId')}}/" +response,
            //                 // data: "products.Name=" + productName,
            //                 cache: false,
            //                 dataType: "JSON",
            //                 success: function (response) {
            //                     console.log(response);
            //                     console.log("Item retrieve successful");
            //                     for (i = 0; i < response.length; i++) {
            //                         $("#productPicture").append("<td>"+ response[i].Name +"</td>");
            //                         // console.log($("#productPicture").append(response[0].productName));
            //                         // $("#productPicture").append(response[0].productName);
            //                     }

            //                 },
            //                 error: function (obj, textStatus, errorThrown) {
            //                     console.log("Error " + textStatus + ": " + errorThrown);
            //                 }
            //             });

            //         },
            //         error: function (obj, textStatus, errorThrown) {
            //             console.log("Error " + textStatus + ": " + errorThrown);
            //         }
            // });
           
        });
        
        
    });
</script>
<script>
    function getPrice(){
        var value  = $("#quantity").val();
        console.log(value);
        $("#price").html(value);

    }
</script>






@endsection