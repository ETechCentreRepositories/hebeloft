@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')
@include('inc.unauthorized')
@endif

<br><br><br>

<br>
<div class="container">
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Outlet</th>
                    <th>Total Price</th>
                    <th>Total Discount</th>
                    <th>Remarks</th>
                    <th>Date</th>
                    <th>Receipt Number</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$salesRecord->outlets['outlet_name']}}</td>
                    <td>{{$salesRecord->total_price}}</td>
                    <td>{{$salesRecord->total_discount}}</td>
                    <td>{{$salesRecord->remarks}}</td>
                    <td>{{$salesRecord->date}}</td>
                    <td>{{$salesRecord->receiptNumber}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>