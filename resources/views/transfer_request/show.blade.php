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
        <br>Date    : {{$transfers[0]->date}}
        <br>Status  : {{$transfers[0]->status}}
        <br>Contact : 9818 2584 (Helen)
        <br>
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
                    <td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/{{$transfer->image}}"></td>
                    <td>{{$transfer->Name}}</td>
                    <td align="right">{{$transfer->quantity}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br><br/>
        <table class="table headerTable">
            <tbody>
                <tr>
                    <td class="wrapContentTd noTopBorder">
                        Remarks
                    </td>
                    <td class="blackBorder">
                    {{$transfers[0]->remarks}}
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
        
    }
    
    .emptyHeader {
    	pointer-events: none;
    }
</style>