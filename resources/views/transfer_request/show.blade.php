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

<div>
    <h3 class="card-title">Transfer Request</h3>
    <button class="btn btn-warning btn-add-item" onclick="openAddItemModal()">Add item</button>
    <br><br>
    <table class="table table-striped" id="inventoryTable" >
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="inventoryContent">
            <tr>
                <td>{{$transferRequest->products['Name']}}</td>
                <td>{{$transferRequest->transferRequestList['quantity']}}</td>
            </tr>
        </tbody>
    </table>
</div>

<div id="addItemModal" class="modal">
    <span class="close cursor" onclick="closeAddItemModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Add item</h3>
            <br>
                <select id="product_name" class="form-control"></select>
                <input id="quantity" class="form-control" type="text"></input>
                <button class="btn btn-success" onclick="closeAddItemModal()">Add item</button>
            {{ Form::close() }}
            </form>
        </div>
    </div>
</div>

<script>
function openAddItemModal() {
    document.getElementById('addItemModal').style.display = "block";
}

function closeAddItemModal() {
    document.getElementById('addItemModal').style.display = "none";
}

$(document).ready(function(){
    $.get("{{ URL::to('ajax/inventory')}}",function(data){
        $("#product_name").empty();
        $.each(data,function(i,value){
            var name = value.Name;
            $("#product_name").append("<option value='" +
            value.id + "'>" +name + "</option>");
        });
    });
});
</script>

<style>
    .transferRequestNav {
        background-color: #f5f8fa !important;
        color: #566B30 !important;
        pointer-events: none;
        cursor: default;
    }
</style>