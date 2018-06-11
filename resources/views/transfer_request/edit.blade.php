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
                                <td align="right">{{$transfer->quantity}}</td>
                                {{Form::hidden('qtyField', $transfer->quantity, ['class' => 'form-control','id'=>'qtyField'])}}
                            </tr>
                            @endforeach
                                {{Form::hidden('getStatus', $transferRequests->status, ['class' => 'form-control','id'=>'getStatus'])}}
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <br>
        @if ($users_id->roles_id == '3')
            @if ($transferRequests->status != "received")
        {!! Form::open(['action' => ['TransferRequestController@update', $transferRequests->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'received']) !!}
            {{Form::hidden('status', '', ['class' => 'form-control','id'=>'status'])}}
            {{Form::hidden('qty', '', ['class' => 'form-control','id'=>'qty'])}}
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Received', ['class'=>'btn btn-lg btn-success','id'=>'received','name'=>'received'])}}
        {!! Form::close() !!}
            @endif
        @endif
        @if ($users_id->roles_id == '1')
            {!! Form::open(['action' => ['TransferRequestController@update', $transferRequests->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {{Form::hidden('status', 'rejected', ['class' => 'form-control'])}}
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Follow Up', ['class'=>'btn btn-lg btn-danger btn-rejected'])}}
        {!! Form::close() !!}
        {!! Form::open(['action' => ['TransferRequestController@update', $transferRequests->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {{Form::hidden('status', 'accepted', ['class' => 'form-control'])}}
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Accepted', ['class'=>'btn btn-lg btn-success btn-accepted'])}}
        {!! Form::close() !!}
        @endif
    </div>
</div>

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    .received {
        text-align: center;
    }

    .btn-rejected {
        float: left;
    }

    .btn-accepted {
        float: right;
    }
</style>

<script>
    var qtyField = document.getElementById('qtyField').value;
    console.log(qtyField);
    document.getElementById("qty").value = qtyField;

    var getStatus = document.getElementById('getStatus').value;
    console.log(getStatus);
    document.getElementById("status").value = getStatus;
</script>