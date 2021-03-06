@extends('layouts.app')
<script src="{{ asset('js/products.js') }}" defer></script>
@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')
@include('inc.unauthorized')
@endif

<br>
<div class="topMargin container">
    <h3>Add new product</h3>
    <br>
    {!! Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']) !!}
    <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Name</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name', 'id'=>'Name'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Category</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('category', '', ['class' => 'form-control', 'placeholder' => 'Category', 'id'=>'category'])}}
                </div>
                   
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Remarks</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('remarks', '', ['class' => 'form-control', 'placeholder' => 'Remarks', 'id'=>'remarks'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Brand</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Brand', 'id'=>'brand'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>UnitPrice</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('unitPrice', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'unitPrice'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">METRO</p>
                </div>
                <div class="col-md-4">
                    <input id="metro" type="number" class="form-control" name="metro" placeholder="METRO" min="0" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>OG PLU</p>
                </div>
                <div class="col-md-4">
                    <input id="og" type="number" class="form-control" name="og" placeholder="OG PLU" min="0" required>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">ROBINSON</p>
                </div>
                <div class="col-md-4">
                    <input id="robinson" type="number" class="form-control" name="robinson" placeholder="ROBINSON" min="0" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>BHG</p>
                </div>
                <div class="col-md-4">
                    <input id="bhg" type="number" class="form-control" name="bhg" placeholder="BHG" min="0" required>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">NTUC</p>
                </div>
                <div class="col-md-4">
                    <input id="ntuc" type="number" class="form-control" name="ntuc" placeholder="NTUC" min="0" required>
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
                    {{Form::text('unit', '', ['class' => 'form-control', 'placeholder' => 'Unit', 'id'=>'unit'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Size</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('size', '', ['class' => 'form-control', 'placeholder' => 'Size', 'id'=>'size'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Stock Level</p>
                </div>
                <div class="col-md-4">
                    {{Form::number('stock_level', '', ['class' => 'form-control', 'placeholder' => 'Stock Level', 'id'=>'stock_level', 'min' => 0])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Threshold level</p>
                </div>
                <div class="col-md-4">
                    {{Form::number('threshold', '', ['class' => 'form-control', 'placeholder' => 'Threshold level', 'id'=>'threshold', 'min' => 0])}}
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
                    {{Form::text('length', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'length'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Width</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('width', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'width'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Weight</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('weight', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'weight'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Height</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('height', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'height'])}}
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
                    {{Form::text('cost', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'cost'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Last Vendor</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('lastVendor', '', ['class' => 'form-control', 'placeholder' => 'Last Vendor', 'id'=>'lastVendor'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Vendor Price</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('vendorPrice', '', ['class' => 'form-control', 'placeholder' => '00.00', 'id'=>'vendorPrice'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Barcode</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('barcode', '', ['class' => 'form-control', 'placeholder' => 'Barcode', 'id'=>'Barcode'])}}
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-7">
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description', 'id' => 'desc'])}}
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
            {{Form::file('image',array('id'=>'image_add'))}}
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
    
    {!! Form::close() !!}
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

@endsection

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