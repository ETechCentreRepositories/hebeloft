@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')
@endif

<br><br><br>

<br>
<div class="container">
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Wholesaler Name</th>
                    <th>Remarks</th>
                    <th>Sales Order Number</th>
                    <th>Date</th>
                    <th>Process</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$salesOrder->users['name']}}</td>
                    <td>{{$salesOrder->remarks}}</td>
                    <td>{{$salesOrder->sales_order_number}}</td>
                    <td>{{$salesOrder->date}}</td>
                    <td>{{$salesOrder->status}}</td>
                    <td>{{$salesOrder->statuses['status_name']}}</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$salesOrder->products['Name']}}</td>
                    <td>{{$salesOrder->quantity}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>