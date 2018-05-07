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

<br>

<div>
    <h3 class="card-title">Transfer Request</h3>
    <button class="btn btn-warning btn-add-item" onclick="openAddItemModal()">Add item</button>
    <br><br>
    <table class="table table-striped" id="inventoryTable" >
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="inventoryContent">
            <tr>
                <td></td>
                <td>{{$transferRequest->transfer_requests_list['quantity']}}</td>
            </tr>
        </tbody>
    </table>
</div>

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #566B30 !important;
        pointer-events: none;
        cursor: default;
    }
</style>