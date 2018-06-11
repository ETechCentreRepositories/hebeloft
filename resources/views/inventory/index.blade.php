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
        <div class="col-md-5">
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
        <div class="col-md-5">
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
        <div class="col-md-2 p-2">
            <button type="button" class="btn btn-default btn-search" id="searchInventory">Search</button>
        </div>
    </div>
    <br>
    <div class="row">
        @if ($users_id->roles_id == '1' || $users_id->roles_id == '2' || $users_id->roles_id == '3')
        <div class="col-md-2">
            <button type="button" class="btn btn-success btn-search" onclick="openImportCSVModal()">Import</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('exportInventory.file',['type'=>'csv']) }}"><button type="button" class="btn btn-warning" style="width: 100%;">Export</button></a>
        </div>
        @endif
    </div>
    <br>
    <table class="display nowrap" id="inventoryTable" >
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
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>

    <script type="text/javascript">
        $("#inventoryTable").DataTable({
            dom: 'Bfrtip', 
            buttons: [
                'copy'
            ]
    });
    </script>

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