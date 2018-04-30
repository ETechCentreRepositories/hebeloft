@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@else
@include('inc.unauthorized')
<script>
    document.getElementById('unauthorizedModal').style.display = "block";
</script>
@endif

<br>
<div class="topMargin container">
    <div class="row">
        <div class="col-md-10">
            <br>
            <br>
            <div class="drop-down_brand row">
                <div class="col-md-2">
                    <p>From Date:</p>
                </div>
                <div class="col-md-4">
                    <input type="date" name="from" class="form-control">
                </div>
                <div class="col-md-2">
                    <p>To Date:</p>
                </div>
                <div class="col-md-4">
                    <input type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="p-2 no-side-paddings transfer-buttons">
                <button type="button" class="btn btn-warning centered-buttons threshold-button">Create New Request</button>
            </div>
            <div class="d-flex flex-row transfer-buttons">
                <div class="p-2">
                    <button type="button" class="btn btn-sucess action-buttons">Search</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-primary action-buttons">Refresh</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <input type="text" class="form-control" style="background:transparent; height:0.8cm;">
    </div>
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order Id#</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Status</th>
                    <th>More Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $transfer)
                <tr>
                    <td>{{$transfer->id}}</td>
                    <td>{{$transfer->from_location}}</td>
                    <td>{{$transfer->recipient}}</td>
                    <td>{{$transfer->status}}</td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <button type="button" class="btn btn-primary action-buttons btn-view-more" onclick="openUpdateTransferModal()">View Order</button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function openCreateTransferModal() {
        document.getElementById('createTransferModal').style.display = "block";
    }
    
    function closeCreateTransferModal() {
        document.getElementById('createTransferModal').style.display = "none";
    }

    function openUpdateTransferModal() {
        document.getElementById('updateTransferModal').style.display = "block";
    }
    
    function closeUpdateTransferModal() {
        document.getElementById('updateTransferModal').style.display = "none";
    }
</script>
@endsection

<style>
    .transferRequestNav {
        
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>