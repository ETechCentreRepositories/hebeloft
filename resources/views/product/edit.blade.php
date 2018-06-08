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
    <h3>Edit product</h3>
    <br>
        {!! Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
        <div class="row">
                <div class="col-md-1">
                    <p>Name</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('name', $product->Name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Category</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('category', $product->Category, ['class' => 'form-control', 'placeholder' => 'Category'])}}
                </div>
                   
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Remarks</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('remarks', $product->Remarks, ['class' => 'form-control', 'placeholder' => 'Remarks'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Brand</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('brand', $product->Brand, ['class' => 'form-control', 'placeholder' => 'Brand'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>UnitPrice</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('unitPrice', $product->UnitPrice, ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">METRO</p>
                </div>
                <div class="col-md-4">
                    <input id="metro" type="number" class="form-control" name="metro" placeholder="METRO" value="{{$product->Metro}}" required>
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
                    {{Form::text('unit', $product->Unit, ['class' => 'form-control', 'placeholder' => 'Unit'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Size</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('size', $product->Size, ['class' => 'form-control', 'placeholder' => 'Size'])}}
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
                    {{Form::text('length', $product->ProductLength, ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Width</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('width', $product->ProductWidth, ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Weight</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('weight', $product->ProductWeight, ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Height</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('height', $product->ProductHeight, ['class' => 'form-control', 'placeholder' => '00.00'])}}
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
                    {{Form::text('cost', $product->Cost, ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Last Vendor</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('lastVendor', $product->LastVendor, ['class' => 'form-control', 'placeholder' => 'Last Vendor'])}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Vendor Price</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('vendorPrice', $product->VendorPrice, ['class' => 'form-control', 'placeholder' => '00.00'])}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <p style="text-align:right">Barcode</p>
                </div>
                <div class="col-md-4">
                    {{Form::text('barcode', $product->Barcode, ['class' => 'form-control', 'placeholder' => 'Barcode'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                {{Form::textarea('description', $product->Description, ['class' => 'form-control', 'placeholder' => 'Description'])}}
            </div>
            <div class="col-md-4">
                <h4>Product</h4>
                {{Form::file('image_add',array('id'=>'image_add'))}}
                <br></br>
                <div class="centerImage col-md-3" >
                <img src = "/storage/product_images/{{$product->image}}" id="addImage" width="150px" />
                <br>
                </div>
            </div>
        </div>
        {{Form::hidden('_method', 'PUT')}}
    <br>
    <div class="form-group">
        <div style="text-align:left">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection

<style>
    .productNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>