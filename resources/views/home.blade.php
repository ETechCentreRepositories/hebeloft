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

<div class="container-fluid">
    <div class="topMargin salesOrder">
        <div class="dashboardCards d-flex flex-column">
            <h3 class="dashboardLabels">Sales Order</h3>
            <div class="cardContent d-flex flex-row">
                <div class="p-2 card salesCards card1">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber1">
                            {{$salesPacks}}
                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE PACKED
                        </div>
                    </div>
                </div>
                <br>
                <div class="p-2 card salesCards card2">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber2">
                            {{$salesShips}}
                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE SHIPPED
                        </div>
                    </div>
                </div>
                <div class="p-2 card salesCards card3">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber3">
                            {{$salesDelivers}}
                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE DELIVERED
                        </div>
                    </div>
                </div>
                <div class="p-2 card salesCards card4">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber4">
                            {{$salesInvoices}}
                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE INVOICED
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="transferRequest">
        <div class="dashboardCards d-flex flex-column">
            <h3 class="dashboardLabels">Transfer Request</h3>
            <div class="cardContent d-flex flex-row">
                <div class="p-2 card salesCards card1">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber1">
                            {{$transferPacks}}
                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE PACKED
                        </div>
                    </div>
                </div>
                <br>
                <div class="p-2 card salesCards card2">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber2">
                            {{$transferShips}}
                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE SHIPPED
                        </div>
                    </div>
                </div>
                <div class="p-2 card salesCards card3">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber3">
                            {{$transferDelivers}}
                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE DELIVERED
                        </div>
                    </div>
                </div>
                <div class="p-2 card salesCards card4">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber4">
                            {{$transferInvoices}}
                        </div>
                        Qty
                        <br><br>
                        <div class="salesProcess">
                            TO BE INVOICED
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gray row">
        <div class="col-md-6">
            <div class="dashboardTables">
                <h3 class="dashboardLabels">Audit Trails</h3>
                <table class="table table-striped">
                    <thead>
                        <tr><th class="col-md-4">Done By</th></tr>
                        <tr><th class="col-md-4">Action</th></tr>
                        <tr><th class="col-md-4">Date/Time</th></tr>
                    </thead>
                    <tbody>
                        @foreach($auditTrails as $auditTrail)
                        <tr>
                            <td class="col-md-4">{{$auditTrail->action_by}}</td>
                            <td class="col-md-4">{{$auditTrail->action}}</td>
                            <td class="col-md-4">{{$auditTrail->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{$auditTrails->links()}}
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="dashboardTables">
                <h3 class="dashboardLabels">Sales Record</h3>
                <table class="table table-striped">
                    <thead>
                        <tr><th class="col-md-4">Date</th></tr>
                        <tr><th class="col-md-4">Receipt Number</th></tr>
                        <tr><th class="col-md-4">Outlet</th></tr>
                    </thead>
                    <tbody>
                        @foreach($salesRecords as $salesRecord)
                        <tr>
                            <td class="col-md-4">{{$salesRecord->date}}</td>
                            <td class="col-md-4">{{$salesRecord->receiptNumber}}</td>
                            <td class="col-md-4">{{$salesRecord->outlets['outlet_name']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{$salesRecords->links()}}
            </div>
        </div>
    </div>
</div>


@endsection

<style>
    .homeNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }

    table {
        border: 2px solid #ddd;
        width: 800px;
    }

    th {
        border: none !important;
    }

    thead, tbody, tr, th, td {
        display: block;
    }

    thead{
        width: 97%;
    }

    tbody {
        width: 100%;
        overflow-y: auto;
        height: 176px;
        background-color: #f5f5f5;
    }

    td, thead > tr > th {
        float: left;
        border-bottom-width: 0;
    }
    
    th:hover{
        background-color: #f5f8fa !important;
        text-decoration: none !important;
        cursor: auto !important;
    }
</style>