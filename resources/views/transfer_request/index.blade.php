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
    <div class="row">
        <div class="col-md-5">
            <br>
            <br>
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>From Date:</p>
                </div>
                <div class="col-md-8">
                    <input type="date" name="from" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <br>
            <br>
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>To Date:</p>
                </div>
                <div class="col-md-8">
                    <input type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="p-2 no-side-paddings transfer-buttons">
                <a href="/transferrequest/create"><button type="button" class="btn btn-warning centered-buttons transferRequestButtons">Create New Request</button></a>
            </div>
            <div class="d-flex flex-row transfer-buttons">
                <div class="p-2">
                    <button type="button" class="btn btn-sucess transferRequestButtons">Search</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-primary transferRequestButtons">Refresh</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- <div class="input-group"> --}}
            {{-- <span class="input-group-addon"><i class="fas fa-search"></i></span> --}}
        <input type="text" class="form-control searchField" style="background:transparent; height:0.8cm;">
        {{-- </div> --}}
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
                    @if ($users_id->roles_id == '1')
                    <th>More Details</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $transfer)
                <tr>
                    <td>{{$transfer->id}}</td>
                    <td>{{$transfer->from_location}}</td>
                    <td>{{$transfer->recipient}}</td>
                    <td>{{$transfer->statuses['status_name']}}</td>
                    @if ($users_id->roles_id == '1')
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                            <div class="p-2">
                                <a href="/transferrequest/{{$transfer->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function openViewTransferModal() {
        document.getElementById('viewTransferModal').style.display = "block";
    }
    
    function closeViewTransferModal() {
        document.getElementById('viewTransferModal').style.display = "none";
    }
</script>
@endsection

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>