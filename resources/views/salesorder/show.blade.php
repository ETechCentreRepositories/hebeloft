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
    <h3>Sales Order #{{$salesOrder->date}}_{{$salesOrder->id}}</h3>
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
                    <td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/{{$salesOrderList->products['image']}}"></td>
                    <td>{{$salesOrderList->products['Name']}}</td>
                    <td>{{$salesOrderList->products['UnitPrice']}}</td>
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
        {{-- <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
            @foreach($salesOrderLists as $salesOrderList)
                <tr>
                    <td>{{$salesOrderList->products['Name']}}</td>
                    <td>{{$salesOrderList->quantity}}</td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}
    </div>
</div>