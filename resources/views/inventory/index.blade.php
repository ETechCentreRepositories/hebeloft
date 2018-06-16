@extends('layouts.app')
<script src="{{ asset('js/inventory.js') }}" defer></script>
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
    <div class="row">
        <div class="col-md-6">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>Search by Brand</p>
                </div>
                <div class="col-md-8">
                    <select id="product_brand" class="form-control"></select>
                </div>
            </div>
        </div>
        @if ($users_id->roles_id == '1' || $users_id->roles_id == '2' || $users_id->roles_id == '3')
        <div class="col-md-6">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p style="text-align:right">Show Location</p>
                </div>
                <div class="col-md-8">
                    <select id="outlet_location" class="form-control" ></select>
                </div>
            </div>
        </div>
        @endif
    </div>
    <br>
    @if ($users_id->roles_id == '1' || $users_id->roles_id == '2' || $users_id->roles_id == '3')
    <div class="row">
        <div class="col-md-2">
            <button type="button" class="btn btn-success btn-search" onclick="openImportCSVModal()">Import</button>
        </div>
    </div>
    <br>
    <h3>Generate Report</h3>
    <br>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('exportInventory.file',['type'=>'csv']) }}"><button type="button" class="btn btn-warning" style="width: 100%;">All</button></a>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-warning" onclick="openExportBrandModal()" style="width: 100%;">By Brand</button></a>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-warning" onclick="openExportCategoryModal()" style="width: 100%;">By Category</button></a>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-warning" onclick="openExportOutletModal()" style="width: 100%;">By Outlets</button></a>
        </div>
    </div>
    @endif
    
    <br>
    <table class="display nowrap" id="inventoryTable" width="100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Brand</th>
                <th>Item</th>
                <th>Normal Price</th>
                <th>Category</th>
                <th>Quantity/Threshold Level</th>
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
                <td>${{$inventoryOutlet->products['UnitPrice']}}</td>
                <td>{{$inventoryOutlet->products['Category']}}</td>
                <td align="right">{{$inventoryOutlet->stock_level}}/{{$inventoryOutlet->stock_level}}</td>
            </tr>
            @endforeach
            @else
                <p style="text-align-center">No Inventory found</p>
            @endif
        </tbody>
    </table>

    <div id="importCSVModal" class="modal">
        <span class="close cursor" onclick="closeImportCSVModal()">&times;</span>
        <div class="card modalCard">
            <div class="card-body">
                <h3>Import inventory file</h3>
                <br><br><br><br><br>
                {!! Form::open(['action' => ['InventoryController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div style="text-align:center">
                    {{Form::file('inventory_csv',array('id'=>'inventorycsv','style'=>'min-width: fit-content; width: fit-content;'))}}
                </div>
                <br>
                <div style="text-align:center">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
                {!! Form::close() !!}
            </div>
       </div>
    </div>
    {{-- <div id="exportBrandModal" class="modal">
        <span class="close cursor" onclick="closeExportBrandModal()">&times;</span>
        <div class="card modalCard">
            <div class="card-body">
                <h3>Select Brand</h3>
                <br><br><br><br><br>
                <div style="text-align:center">
                    <select id="brand" class="form-control"></select>
                </div>
                <br>
                <div style="text-align:center">
                <a href="{{ route('exportInventory_brand.file',['type'=>'csv'], ['brand'=>$brand]) }}"><button type="button" class="btn btn-primary">Export</button></a>
                </div>
            </div>
       </div>
    </div> --}}
    <div id="exportCategoryModal" class="modal">
        <span class="close cursor" onclick="closeExportCategoryModal()">&times;</span>
        <div class="card modalCard">
            <div class="card-body">
                <h3>Select Category</h3>
                <br><br><br><br><br>
                <div style="text-align:center">
                    <select id="category" class="form-control" ></select>
                </div>
                <br>
                <div style="text-align:center">
                    <button type="button" id="exportBrand" class="btn btn-primary">Export</button>
                </div>
            </div>
       </div>
    </div>
    {{-- <div id="exportOutletModal" class="modal">
        <span class="close cursor" onclick="closeExportOutletModal()">&times;</span>
        <div class="card modalCard">
            <div class="card-body">
                <h3>Select Outlet</h3>
                <br><br><br><br><br>
                <div style="text-align:center">
                    <select id="outlet" class="form-control" ></select>
                </div>
                <br>
                <div style="text-align:center">
                    <a href="{{ route('exportInventory_outlet.file',['type'=>'csv']) }}"><button type="button" class="btn btn-primary">Export</button></a>
                </div>
            </div>
       </div>
    </div> --}}
</div>

@endsection

<style>
    .inventoryNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    #searchField{
        background-image:url(http://localhost:8000/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>