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
@endif

<br>
@if ($users_id->roles_id == '1')
<div class="topMargin container">
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
            <input type="text" class="form-control" style="background:transparent;">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Order Date</th>
                    <th>Process</th>
                    <th>Status</th>
                    @if ($users_id->roles_id == '1')
                    <th>More details</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                    @foreach($salesOrders as $salesOrder)
                    <tr>
                        <td>{{$salesOrder->id}}</td>
                        <td></td>
                        <td>{{$salesOrder->status}}</td>
                        <td>{{$salesOrder->statuses['status_name']}}</td>
                        @if ($users_id->roles_id == '1')
                        <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                            <div class="p-2">
                                <a href="/salesorder/{{$salesOrder->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif
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
            <a href="/salesorder/create"><button type="button" class="btn btn-warning">Create New Sales Order</button></a>
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
            <input type="text" class="form-control" style="background:transparent;">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Order Date</th>
                    <th>Process</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($wholesalerSalesOrders as $wholesalerSalesOrder)
                    <tr>
                        <td>{{$wholesalerSalesOrder->id}}</td>
                        <td></td>
                        <td>{{$wholesalerSalesOrder->status}}</td>
                        <td>{{$wholesalerSalesOrder->statuses['status_name']}}</td>
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
</style>