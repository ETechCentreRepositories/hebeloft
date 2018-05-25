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
                    <th>Remarks</th>
                    <th>Transfer Request Number</th>
                    <th>Date</th>
                    <th>Process</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$transferRequest->outlets['outlet_name']}}</td>
                    <td>{{$transferRequest->remarks}}</td>
                    <td>{{$transferRequest->transfer_request_number}}</td>
                    <td>{{$transferRequest->date}}</td>
                    <td>{{$transferRequest->status}}</td>
                    <td>{{$transferRequest->statuses['status_name']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>