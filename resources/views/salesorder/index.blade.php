@extends('layouts.app')
<script src="{{ asset('js/sales_order.js') }}" defer></script>
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
@endif

<br>
@if ($users_id->roles_id == '1' or $users_id->roles_id == '2')
<div class="topMargin container">
    <div class="drop-down_brand row">
        <div class="col-md-3">
            <p>From Date:</p>
        </div>
        <div class="col-md-9">
            <input id="startDate" type="date" name="from" class="form-control">
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>To Date:</p>
        </div>
        <div class="col-md-9">
            <input id="endDate" type="date" name="to" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-9">
            <input type="text" id="salesOrderSearchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <div class="d-flex flex-row ">
                <div class="p-2">
                    <button id="search" type="button" class="btn btn-sucess">Search</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('exportSalesOrder.file',['type'=>'csv']) }}"><button type="button" class="btn btn-warning">Export</button></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Date (YYYY-MM-DD)</th>
                    <th>Process</th>
                    <th>Status</th>
                    @if ($users_id->roles_id == '1')
                    <th class="emptyHeader"></th>
                    @endif
                </tr>
            </thead>
            <tbody id="salesOrderContent">
                    @foreach($salesOrders as $salesOrder)
                    <tr>
                        <td>{{$salesOrder->date}}</td>
                        <td>{{$salesOrder->status}}</td>
                        <td>{{$salesOrder->statuses['status_name']}}</td>
                        <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/salesorder/{{$salesOrder->id}}"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
                                <div class="p-2">
                                    <a href="/salesorder/{{$salesOrder->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{$salesOrders->links()}}
    </div>
</div>
@endif

@if ($users_id->roles_id == '4')
<div class="topMargin container">
    <div class="row justify-content-end">
        <div>
            <a href="/salesorder/create"><button type="button" class="btn btn-warning">Create or View New Sales Order</button></a>
        </div>
    </div>
    <br>
    <div class="drop-down_brand row">
        <div class="col-md-3">
            <p>From Date:</p>
        </div>
        <div class="col-md-9">
            <input type="date" name="from" class="form-control">
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>To Date:</p>
        </div>
        <div class="col-md-9">
            <input type="date" name="to" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">
            <input type="text" id="salesOrderSearchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Process</th>
                    <th>Status</th>
                    <th>View more</th>
                </tr>
            </thead>
            <tbody id="salesOrderContent">
                    @foreach($wholesalerSalesOrders as $wholesalerSalesOrder)
                    <tr>
                        <td>{{$wholesalerSalesOrder->date}}</td>
                        <td>{{$wholesalerSalesOrder->status}}</td>
                        <td>{{$wholesalerSalesOrder->statuses['status_name']}}</td>
                        <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/hebeloft/salesorder/{{$wholesalerSalesOrder->id}}"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
                            </div>
                        </div>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection

<style>
    .salesOrderNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    .emptyHeader {
    	pointer-events: none;
    }
    
    #salesOrderSearchField{
        background-image:url(http://localhost:8000/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>