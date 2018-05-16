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

<div class="topMargin container">
<br>
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">Update Transfer Request</div>

                <div class="card-body">
                {!!Form::open(['action' => ['TransferRequestController@update', $transferRequests->id], 'method' => 'POST']) !!}
                    {{ csrf_field() }}
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
    <select name="status" class="form-control">
                        <option value="rejected">Rejected</option>
                        <option value="accepted">Accepted</option>
                    </select>
                <br>
                    {{Form::hidden('_method','PUT')}}
                    <div class="modal-button">
                    {{Form::submit('Update transfer request', ['class'=>'btn btn-primary'])}}
</div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>