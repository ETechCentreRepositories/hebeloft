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
@if ($users_id->roles_id == '1' or $users_id->roles_id == '2')
<div class="topMargin container">
    <div class="row">
        <div class="col-md-4">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>From Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="startDate" type="date" name="from" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>To Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4 fullWidthButtons">
            <div class="p-2 transfer-buttons" align="right">
                <a href="/transferrequest/create"><button type="button" class="btn btn-warning centered-buttons transferRequestButtons">Create or View New Transfer Request</button></a>
            </div>
        </div>
        <div class="col-md-10" style="padding-top:9px">
            {{-- <div class="input-group"> --}}
            <input type="text" id="transferRequestSearchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="d-flex flex-row transfer-buttons">
                <div class="p-2">
                    <button id="search" type="button" class="btn btn-sucess transferRequestButtons">Search</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-primary transferRequestButtons">Refresh</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Process</th>
                    <th>Status</th>
                    <th class="emptyHeader"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $transfer)
                <tr>
                    <td>{{$transfer->date}}</td>
                    {{-- <td>{{$transfer->orderId}}</td> --}}
                    {{-- <td>{{$transfer->from_location}}</td> --}}
                    <td>{{$transfer->status}}</td>
                    <td>{{$transfer->statuses['status_name']}}</td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/transferrequest/{{$transfer->id}}"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
                    @if ($users_id->roles_id == '1')
                                <div class="p-2">
                                    <a href="/hebeloft/transferrequest/{{$transfer->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
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
    <div class="pagination">
        {{$transfers->links()}}
    </div>
</div>
@endif

@if ($users_id->roles_id == '3')
<div class="topMargin container">
    <div class="row">
        <div class="col-md-4">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>From Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="startDate" type="date" name="from" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>To Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4 fullWidthButtons">
            <div class="p-2 transfer-buttons" align="right">
                <a href="/transferrequest/create"><button type="button" class="btn btn-warning centered-buttons transferRequestButtons">Create or View New Transfer Request</button></a>
            </div>
        </div>
        <div class="col-md-10" style="padding-top:9px">
            <input type="text" id="transferRequestSearchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="d-flex flex-row transfer-buttons">
                <div class="p-2">
                    <button id="search" type="button" class="btn btn-sucess transferRequestButtons">Search</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-primary transferRequestButtons">Refresh</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Date (YYYY-MM-DD)</th>
                    {{-- <th>Order Id#</th> --}}
                    {{-- <th>Outlet</th> --}}
                    <th>Process</th>
                    <th>Status</th>
                    <th class="emptyHeader"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($outletTransfers as $outletTransfer)
                <tr>
                    <td>{{$outletTransfer->date}}</td>
                    {{-- <td>{{$outletTransfer->orderId}}</td> --}}
                    {{-- <td>{{$outletTransfer->from_location}}</td> --}}
                    <td>{{$outletTransfer->status}}</td>
                    <td>{{$outletTransfer->statuses['status_name']}}</td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/transferrequest/{{$outletTransfer->id}}"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
                    @if ($users_id->roles_id == '1')
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
    <div class="pagination">
        {{$transfers->links()}}
    </div>
</div>
@endif

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
    
    .emptyHeader {
    	pointer-events: none;
    }
    
    #transferRequestSearchField{
        background-image:url(http://ehostingcentre.com/hebeloft/storage/icons/search.png); 
        background-repeat: no-repeat; 
        background-position: 2px 3px;
        background-size: 30px 30px;
    }
</style>