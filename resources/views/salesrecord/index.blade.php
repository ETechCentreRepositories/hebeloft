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
    <div class="row justify-content-end">
        <a href="/salesrecord/create"><button type="button" class="btn btn-warning">Add Sales Record</button></a>
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
            <input type="text" class="form-control" style="background:transparent;">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Date (YYYY-MM-DD)</th>
                    <th>Receipt Number</th>
                    <th>Outlet</th>
                    <th>Total Price</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody id="salesRecordContent">
                    @foreach($salesRecords as $salesRecord)
                    <tr>
                        <td>{{$salesRecord->date}}</td>
                        <td>{{$salesRecord->receiptNumber}}</td>
                        <td>{{$salesRecord->outlets['outlet_name']}}</td>
                        <td>{{$salesRecord->total_price}}</td>
                        <td>{{$salesRecord->remarks}}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{$salesRecords->links()}}
    </div>
    <script>
        $(document).ready(function(){
            $('#refreshInventory').click(function(){
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                console.log(startDate + endDate);
                $("#salesRecordContent").empty();
            $.ajax({
                type: "GET",
                url: "{{URL::TO('/ajax/salesrecord/date')}}/" + startDate + "/" + endDate,
                // data: "products.Name=" + productName,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    // console.log(response);
                    for (i = 0; i < response.length; i++) {
                        console.log(response[i]);
                        $("#salesRecordContent").append(
                            "<tr><td>"+ response[i].date+"</td>"
                            + "<td> </td>"
                            + "<td>" + response[i].outlet_name + "</td>"
                            + "<td>" + response[i].total_price + "</td>"
                            + "<td></td></tr>"
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
</div>

@endsection

<style>
    .salesRecordNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>