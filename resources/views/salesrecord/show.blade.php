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
    <h3>Sales Record #SR_{{$salesRecord->outlets->initial}}_{{$salesRecord->OrderDate}}_{{$salesRecord->id}}</h3>
        <br>Date    : {{$records[0]->OrderDate}}
        <br>Loaction  : {{$records[0]->Location}}
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
            @foreach($records as $record)
                <tr>
                    <td><img style="width:60px; height:60px" src="/hebeloft/storage/product_images/{{$record->image}}"></td>
                    <td>{{$record->Name}}</td>
                    <td>{{$record->UnitPrice}}</td>
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
        <table class="table headerTable">
            <tbody>
                <tr>
                    <td class="wrapContentTd noTopBorder">
                        Remarks
                    </td>
                    <td class="blackBorder">
                    {{$records[0]->OrderRemarks}}
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .salesRecordNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
        
    }
    
    .emptyHeader {
    	pointer-events: none;
    }
</style>