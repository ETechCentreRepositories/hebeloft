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
        {!! Form::open(['action' => ['ProductsController@update', $products->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Name</p>
                </div>
                <div class="col-md-5">
                    {{Form::text('name', $products->Name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                </div>
                <div class="col-md-2">
                    <p style="text-align:right">OG PLU</p>
                </div>
                <div class="col-md-4">
                    <input id="ogplu" type="number" class="form-control" name="ogPLU" placeholder="OG PLU" value="{{$products->OG_PLU}}" required>
                </div>   
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Category</p>
                </div>
                <div class="col-md-5">
                    {{Form::text('category', $products->Category, ['class' => 'form-control', 'placeholder' => 'Category'])}}
                </div>
                <div class="col-md-2">
                    <p style="text-align:right">BHG</p>
                </div>
                <div class="col-md-4">
                    <input id="bhg" type="number" class="form-control" name="bhg" placeholder="BHG" value="{{$products->BHG}}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Brand</p>
                </div>
                <div class="col-md-5">
                    {{Form::text('brand', $products->Brand, ['class' => 'form-control', 'placeholder' => 'Brand'])}}
                </div>
                <div class="col-md-2">
                    <p style="text-align:right">METRO</p>
                </div>
                <div class="col-md-4">
                    <input id="metro" type="number" class="form-control" name="metro" placeholder="METRO" value="{{$products->Metro}}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>UnitPrice</p>
                </div>
                <div class="col-md-5">
                    {{Form::text('unitPrice', $products->UnitPrice, ['class' => 'form-control', 'placeholder' => 'UnitPrice'])}}
                </div>
                <div class="col-md-2">
                    <p style="text-align:right">ROBINSON</p>
                </div>
                <div class="col-md-4">
                    <input id="robinson" type="number" class="form-control" name="robinson" placeholder="ROBINSON" value="{{$products->Robinsons}}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Remarks</p>
                </div>
                <div class="col-md-5">
                    {{Form::text('remarks', $products->Remarks, ['class' => 'form-control', 'placeholder' => 'Remarks'])}}
                </div>
                <div class="col-md-2">
                    <p style="text-align:right">NTUC</p>
                </div>
                <div class="col-md-4">
                    <input id="ntuc" type="number" class="form-control" name="ntuc" placeholder="NTUC" value="{{$products->NTUC}}" required>
                </div> 
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <p>Size</p>
                </div>
                <div class="col-md-5">
                    {{Form::text('size', $products->Size, ['class' => 'form-control', 'placeholder' => 'Size'])}}
                </div>
                <div class="col-md-2">
                    <p style="text-align:right"><p style="text-align:right">Threshold level</p></p>
                </div>
                <div class="col-md-4">
                    {{Form::text('threshold', '', ['class' => 'form-control', 'placeholder' => 'Threshold level'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                {{Form::textarea('description', $products->Description, ['class' => 'form-control', 'placeholder' => 'Description'])}}
            </div>
            <div class="col-md-4">
                <h4>Product</h4>
                {{Form::file('image_add',array('id'=>'image_add'))}}
                <br></br>
                <div class="centerImage col-md-3" >
                <img src = "" id="addImage" width="150px" />
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