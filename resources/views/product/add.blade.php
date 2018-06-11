@extends('layouts.app')

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
                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Category</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('category', '', ['class' => 'form-control', 'placeholder' => 'Category'])}}
                </div>
                   
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Remarks</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('remarks', '', ['class' => 'form-control', 'placeholder' => 'Remarks'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Brand</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Brand'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>UnitPrice</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('unitPrice', '', ['class' => 'form-control', 'placeholder' => '00.00'])}}
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
                    {{Form::text('unit', '', ['class' => 'form-control', 'placeholder' => 'Unit'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Size</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('size', '', ['class' => 'form-control', 'placeholder' => 'Size'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Stock Level</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('stock_level', '', ['class' => 'form-control', 'placeholder' => 'Stock Level'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Threshold level</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('threshold', '', ['class' => 'form-control', 'placeholder' => 'Threshold level'])}}
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
                    {{Form::text('length', '', ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Width</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('width', '', ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Weight</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('weight', '', ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Height</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('height', '', ['class' => 'form-control', 'placeholder' => '00.00'])}}
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
                    {{Form::text('cost', '', ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Last Vendor</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('lastVendor', '', ['class' => 'form-control', 'placeholder' => 'Last Vendor'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Vendor Price</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('vendorPrice', '', ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Barcode</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('barcode', '', ['class' => 'form-control', 'placeholder' => 'Barcode'])}}
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-8">
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
        <div class="col-md-4">
            <h4>Select image File</h4>
            {{Form::file('image_add',array('id'=>'image_add'))}}
            <br></br>
            <div class="centerImage col-md-3" >
               <img src="" id="addImage" width="150px" />
               <br>
            </div>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div style="text-align:left">
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
$(document).ready(function () {
    $("#image_add").change(function(){
        console.log("image_add");
        readURL(this);
    });
    $("#productSearchField").autocomplete({
        source: 'autocomplete-search',
        minLength:1,
        select:function(key,value)
        {
            console.log(value);
        }
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
</script>

@endsection

<style>
    .productNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>