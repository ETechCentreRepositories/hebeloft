@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="topMargin container">
    <div class="drop-down_brand row">
        <div class="col-md-3">
        <p>From Date:</p>
        </div>
        <div class="col-md-9">
            <select id="product_brand" class="form-control">
            </select>
        </div>
    </div>
    <br>
    <div class="drop-down_location row">
        <div class="col-md-3">
            <p>To Date:</p>
        </div>
        <div class="col-md-9">
            <select id="outlet_location" class="form-control" >
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">
            <input type="text" class="form-control" style="background:transparent; height:0.8cm;">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default" id="refreshInventory">Refresh</button>
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
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@endsection