<!-- @extends('layouts.app')

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
@endif -->

<!-- <br>

<div class="topMargin container">
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
            @if(count($transfers) > 0)
                @foreach($transfers as $transfer)
                <tr>
                    <td>{{$transfer->products['Name']}}</td>
                    <td>{{$transfer->quantity}}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <br>
    {!!Form::open(['action' => ['TransferRequestController@update', $transferRequests->id], 'method' => 'POST']) !!}
                    {{ csrf_field() }}
                    <select name="status">
                        <option value="reject">Reject</option>
                        <option value="accept">Accept</option>
                    </select>
                <br><br>
                    {{Form::hidden('_method','PUT')}}
                    {{Form::submit('Edit transfer request', ['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
    <div>
        <button class="btn btn-danger" name="thing" value="reject">Reject</button>
        <button class="btn btn-success btn-accept" name="thing" value="accept">Accept</button>
    </div>
</div> -->

<!-- <style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #566B30 !important;
        pointer-events: none;
        cursor: default;
    }
</style> -->