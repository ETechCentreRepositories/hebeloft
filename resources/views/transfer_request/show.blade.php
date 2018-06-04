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
    	<h3>Transfer Request #{{$transferRequests->outlets->initial}}_{{$transferRequests->date}}_{{$transferRequests->id}}</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
            @foreach($transfers as $transfer)
                <tr>
                    <td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/{{$transfer->products['image']}}"></td>
                    <td>{{$transfer->products['Name']}}</td>
                    <td align="right">{{$transfer->quantity}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>