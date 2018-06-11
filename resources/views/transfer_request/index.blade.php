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
        <div class="col-md-9"></div>
        <div class="col-md-3 fullWidthButtons">
            <div class="p-2">
                <a href="/transferrequest/create"><button type="button" class="btn btn-warning centered-buttons">Create or View New Transfer Request</button></a>
            </div>
        </div>
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
        <div class="col-md-5">
            <div class="drop-down_brand row">
                <div class="col-md-4">
                    <p>To Date:</p>
                </div>
                <div class="col-md-8">
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-3 fullWidthButtons">
            <div class="p-2">
                <button id="search" type="button" class="btn btn-sucess btn-search">Search</button>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="display" id="transferRequestTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Process</th>
                    <th>Status</th>
                    <th class="emptyHeader"></th>
                </tr>
            </thead>
            <tbody id="transferRequestContent">
                @foreach($transfers as $transfer)
                <tr>
                    <td>{{$transfer->date}}</td>
                    <td>{{$transfer->status}}</td>
                    <td>{{$transfer->statuses['status_name']}}</td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row">
                                <div class="p-2">
                                    <a href="/transferrequest/{{$transfer->id}}"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                </div>
                                @if ($users_id->roles_id == '1')
                                <div class="p-2">
                                    <a href="/transferrequest/{{$transfer->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                                @endif 
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
            <div class="p-2" align="right">
                <a href="/transferrequest/create"><button type="button" class="btn btn-warning centered-buttons">Create or View New Transfer Request</button></a>
            </div>
        </div>
        <div class="col-md-10" style="padding-top:9px">
            <input type="text" id="transferRequestSearchField" style="text-indent:20px;" class="form-control" style="background:transparent">
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="d-flex flex-row">
                <div class="p-2">
                    <button id="search" type="button" class="btn btn-sucess">Search</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-primary">Refresh</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="display" id="transferRequestTable">
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
                                <div class="p-2">
                                    <a href="/transferrequest/{{$outletTransfer->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
<script>
$(document).ready(function(){
    $("#transferRequestTable").DataTable({
        searching: false
    });
    $('#search').click(function(){
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        console.log(startDate + endDate);
        $("#transferRequestContent").empty();
        $.ajax({
            type: "GET",
            url: "/ajax/transferrequest/date/" + startDate + "/" + endDate,
            cache: false,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                for (i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    $("#transferRequestContent").append(
                        "<tr><td>"+ response[i].date+"</td>"
                        + "<td>"+ response[i].status +"</td>"
                        + "<td>"+ response[i].status_name+"</td>"
                        + "@if ($users_id->roles_id == '1')"
                        + "<td><a href='/transferrequest/"+response[i].id+"/edit'><button type='button' class='btn btn-primary action-buttons'>Edit</button></a></td></tr>"
                        + "@endif"
                    );
                }
            },

            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    });
});
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
</style>