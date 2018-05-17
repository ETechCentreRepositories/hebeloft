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
                    <input id="startDate" type="date" name="from" class="form-control">
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
                    <input id="endDate" type="date" name="to" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-2 fullWidthButtons">
            <div class="p-2 no-side-paddings transfer-buttons">
                <a href="/transferrequest/create"><button type="button" class="btn btn-warning centered-buttons transferRequestButtons">Create New Request</button></a>
            </div>
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
    <div class="row">
        {{-- <div class="input-group"> --}}
            {{-- <span class="input-group-addon"><i class="fas fa-search"></i></span> --}}
        <input type="text" class="form-control searchField" style="background:transparent; height:0.8cm;">
        {{-- </div> --}}
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
                    @if ($users_id->roles_id == '1')
                    <th class="emptyHeader"></th>
                    @endif
                </tr>
            </thead>
            <tbody id="transferRequestContent">
                @foreach($transfers as $transfer)
                <tr>
                    <td>{{$transfer->date}}</td>
                    {{-- <td>{{$transfer->orderId}}</td> --}}
                    {{-- <td>{{$transfer->from_location}}</td> --}}
                    <td>{{$transfer->status}}</td>
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
    <div class="pagination">
        {{$transfers->links()}}
    </div>
</div>

<script>
    function openViewTransferModal() {
        document.getElementById('viewTransferModal').style.display = "block";
    }
    
    function closeViewTransferModal() {
        document.getElementById('viewTransferModal').style.display = "none";
    }
    $(document).ready(function(){
            $('#search').click(function(){
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                console.log(startDate + endDate);
                $("#transferRequestContent").empty();
            $.ajax({
                type: "GET",
                url: "{{URL::TO('/ajax/transferrequest/date')}}/" + startDate + "/" + endDate,
                // data: "products.Name=" + productName,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    // console.log(response);
                    for (i = 0; i < response.length; i++) {
                        console.log(response[i]);
                        $("#transferRequestContent").append(
                            "<tr><td>"+ response[i].date+"</td>"
                            + "<td>"+ response[i].status +"</td>"
                            + "<td>"+ response[i].status_name+"</td>"
                            @if ($users_id->roles_id == '1')
                            +"<td><a href='/transferrequest/"+response[i].id+"/edit'><button type='button' class='btn btn-primary action-buttons'>Edit</button></a></td></tr>"
                            @endif
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
</style>