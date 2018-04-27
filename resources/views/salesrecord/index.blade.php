@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="topMargin container">
    <div class="row justify-content-end">
            <button type="button" class="btn btn-warning" onclick="openCreateSalesRecordModal()">Add Sales Record</button>
    </div>
    <br>
    <div class="drop-down_brand row">
        <div class="col-md-3">
        <p>From Date:</p>
        </div>
        <div class="col-md-9">
            <input type="date" name="from" class="form-control">
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>To Date:</p>
        </div>
        <div class="col-md-9">
            <input type="date" name="to" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">
            <input type="text" class="form-control" style="background:transparent;">
            {{-- height:0.8cm; --}}
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default btn-refresh" id="refreshInventory">Refresh</button>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Outlet</th>
                    <th>Revenue</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div id="createSalesRecordModal" class="modal">
        <span class="close cursor" onclick="closeCreateSalesRecordModal()">&times;</span>
        <div class="card modalCard">
            <div class="card-body">
                    <br>
                    <h3 class="card-title">Create Sales Record</h3>
                    <br>
            </div>
        </div>
</div>

<script>
    function openCreateSalesRecordModal() {
        document.getElementById('createSalesRecordModal').style.display = "block";
    }

    function closeCreateSalesRecordModal() {
        document.getElementById('createSalesRecordModal').style.display = "none";
    }
</script>
@endsection

<style>
    .salesRecordNav {
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>