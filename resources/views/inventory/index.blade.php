@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')
@endif

<br>
<div class="topMargin container">
    <div class="drop-down_brand row">
        <div class="col-md-3">
        <p>Search Item name/brand</p>
        </div>
        <div class="col-md-9">
            <select id="product_brand" class="form-control"></select>
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>Show Location</p>
        </div>
        <div class="col-md-9">
            <select id="outlet_location" class="form-control" ></select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-8">
            <input type="text" id="searchField" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-search" id="searchInventory">Search</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('export.file',['type'=>'csv']) }}"><button type="button" class="btn btn-inflow">Export</button></a>
        </div>
    </div>
    <br>
    <table class="table table-striped sortable" id="inventoryTable" >
        <thead>
            <tr>
                <th>Image</th>
                <th>Brand</th>
                <th>Item</th>
                <th>Normal Price</th>
                {{-- <th>BHG SKU</th>
                <th>OG SKU</th>
                <th>Metro SKU</th> --}}
                <th>SKU</th>
                <th>Quantity/Thresold</th>
            </tr>
        </thead>
        <tbody id="inventoryContent">
            @if(count($inventoryOutlets) > 0) 
            @foreach($inventoryOutlets as $inventoryOutlet)
            <tr>
                <td>
                    <img style="width:60px; height:60px" src="/storage/product_images/{{$inventoryOutlet->products['image']}}">    
                </td>
                <td>{{$inventoryOutlet->products['Brand']}}</td>
                <td>{{$inventoryOutlet->products['Name']}}</td>
                <td>S${{$inventoryOutlet->products['UnitPrice']}}</td>
                {{-- <td></td>
                <td></td>
                <td></td> --}}
                <td></td>
                <td>{{$inventoryOutlet->stock_level}}/{{$inventoryOutlet->threshold_level}}</td>
            </tr>
            @endforeach
            {{-- {{dd($inventoryOutlet->products['Brand'])}}  --}}
            @else
                <p>No Inventory found</p>
            @endif
        </tbody>
    </table>
</div>

<div class="pagination">
    {{$inventoryOutlets->links()}}
</div>
@endsection

<style>
    .inventoryNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>