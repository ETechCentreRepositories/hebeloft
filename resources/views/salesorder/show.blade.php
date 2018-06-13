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
    <h3>Sales Order #SO_{{$salesOrder->date}}_{{$salesOrder->id}}</h3>
        <br>Date    : {{$salesOrderLists[0]->date}}
        <br>Status  : {{$salesOrderLists[0]->status_name}}
        <br>Contact : {{$salesOrderLists[0]->phone_number}} ({{$salesOrderLists[0]->name}})
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach($salesOrderLists as $salesOrderList)
                <tr>
                    <td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/{{$salesOrderList->image}}"></td>
                    <td>{{$salesOrderList->Name}}</td>
                    <td>{{$salesOrderList->UnitPrice}}</td>
                    <td align="right">{{$salesOrderList->quantity}}</td>
                    <td>{{$salesOrderList->subtotal}}</td>
                </tr>
                @endforeach
                <tr>
                    <td><b>Total</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$totalPrice}}</td>
                </tr>
            </tbody>
        </table>
        <table class="table headerTable">
            <tbody>
                <tr>
                    <td class="wrapContentTd noTopBorder">
                        Remarks
                    </td>
                    <td class="blackBorder">
                    {{$salesOrderLists[0]->remarks}}
                </tr>
            </tbody>
        </table>
    </div>
</div>

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
</style>