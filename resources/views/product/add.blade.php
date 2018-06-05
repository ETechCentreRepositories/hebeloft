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
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Product name'])}}
            </div>
            <div class="form-group">
                {{Form::text('category', '', ['class' => 'form-control', 'placeholder' => 'Category'])}}
            </div>
            <div class="form-group">
                {{Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Brand'])}}
            </div>
            <div class="form-group">
                {{Form::text('unitPrice', '', ['class' => 'form-control', 'placeholder' => 'UnitPrice'])}}
            </div>
            <div class="form-group">
                {{Form::text('remarks', '', ['class' => 'form-control', 'placeholder' => 'Remarks'])}}
            </div>
            <div class="form-group">
                {{Form::text('size', '', ['class' => 'form-control', 'placeholder' => 'Size'])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input id="ogplu" type="number" class="form-control" name="ogPLU" placeholder="OG PLU"  required>
            </div>
            <div class="form-group">
                <input id="bhg" type="number" class="form-control" name="bhg" placeholder="BHG"  required>
            </div>
            <div class="form-group">
                <input id="metro" type="number" class="form-control" name="metro" placeholder="METRO"  required>
            </div>
            <div class="form-group">
                <input id="robinson" type="number" class="form-control" name="robinson" placeholder="ROBINSON"  required>
            </div>
            <div class="form-group">
                <input id="ntuc" type="number" class="form-control" name="ntuc" placeholder="NTUC"  required>
            </div>
            <div class="form-group">
                {{Form::text('threshold', '', ['class' => 'form-control', 'placeholder' => 'Threshold level'])}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
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
@endsection

<style>
    .productNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>