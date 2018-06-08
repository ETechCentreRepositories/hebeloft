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

<br>
<div class="topMargin container">
    <a href="{{ route('exportSalesRecord.file',['type'=>'csv']) }}"><button type="button" class="btn btn-warning" style="width: auto; float: left;">Export</button></a>
    <div class="row justify-content-end">
        <a href="/salesrecord/create"><button type="button" class="btn btn-warning">Create or View New Sales Record</button></a>
    </div>
    <br>
    <div class="drop-down_brand row">
        <div class="col-md-3">
            <p>From Date:</p>
        </div>
        <div class="col-md-9">
            <input id="startDate" type="date" name="from" class="form-control">
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>To Date:</p>
        </div>
        <div class="col-md-9">
            <input id="endDate" type="date" name="to" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2">
            <div class="d-flex flex-row">
            <button id="search" type="button" class="btn btn-sucess btn-search">Search</button>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Date (YYYY-MM-DD)</th>
                    <th>Outlet</th>
                    <th>Total Price</th>
                    <th>Remarks</th>
                    <th class="emptyHeader"></th>
                </tr>
            </thead>
            <tbody id="salesRecordContent">
                    @foreach($salesRecords as $salesRecord)
                    <tr>
                        <td>{{$salesRecord->OrderDate}}</td>
                        <td>{{$salesRecord->outlets['outlet_name']}}</td>
                        <td>{{$salesRecord->total_price}}</td>
                        <td>{{$salesRecord->OrderRemarks}}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row transfer-buttons">
                                    <div class="p-2">
                                        <a href="/salesrecord/{{$salesRecord->id}}"><button type="button" class="btn btn-primary action-buttons">View More</button></a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{$salesRecords->links()}}
    </div>
</div>
<script>
$(document).ready(function(){
    $('#search').click(function(){
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        console.log(startDate + endDate);
        $("#salesRecordContent").empty();
        $.ajax({
            type: "GET",
            url: "/ajax/salesOrder/date/" + startDate + "/" + endDate,
            cache: false,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                for (i = 0; i < response.length; i++) {
                    console.log(response[i]);
                    $("#salesRecordContent").append(
                        "<tr><td>"+ response[i].date+"</td>"
                        + "<td>"+ response[i].status +"</td>"
                        + "<td>"+ response[i].status_name+"</td>"
                        + "@if ($users_id->roles_id == '1')"
                        + "<td><a href='/salesorder/"+response[i].id+"/edit'><button type='button' class='btn btn-primary action-buttons'>Edit</button></a></td></tr>"
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
    .salesRecordNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>