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
                <div class="card-header">Update Purchase Order</div>
                <div class="card-body">
                    {{ csrf_field() }}
                    <table class="table table-striped" id="inventoryTable" >
                        <thead>
                            <tr>
                                <th>Total Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryContent">
                           
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br>
<style>
    .salesOrderNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    .rejected {
	  float: left;
	}
	
	.accepted {
	  float: right;
	}
</style>