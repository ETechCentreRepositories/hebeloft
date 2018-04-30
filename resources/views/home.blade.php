@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@endif

<div class="container-fluid">
    <div class="topMargin salesOrder">
        <div class="dashboardCards d-flex flex-column">
            <h3 class="dashboardLabels">Sales Order</h3>
            <div class="cardContent d-flex flex-row">
                <div class="p-2 card salesCards card1">
                    <div class="salesCardsBody card-body">
                        <div class="salesNumber salesNumber1">
                            0
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
                            0
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
                            0
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
                            0
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
                            0
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
                            0
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
                            0
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
                            0
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
                        <tr>
                            <th>#</th>
                            <th>Date/Time</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dashboardTables">
                <h3 class="dashboardLabels">Sales Record</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Outlet</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .homeNav {
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>