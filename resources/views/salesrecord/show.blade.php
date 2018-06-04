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
    <h3>Sales Record #{{$salesRecord->outlets->initial}}_{{$salesRecord->OrderDate}}_{{$salesRecord->id}}</h3>
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
            @foreach($records as $record)
                <tr>
                    <td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/{{$record->products['image']}}"></td>
                    <td>{{$record->products['Name']}}</td>
                    <td>{{$record->products['UnitPrice']}}</td>
                    <td align="right">{{$record->quantity}}</td>
                    <td>{{$record->subtotal}}</td>
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
    </div>
</div>