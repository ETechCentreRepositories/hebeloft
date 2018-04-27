@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="topMargin container">
    <div class="row">
        <div class="col-md-9"> 
            <h1>Transfer Request</h1>
            <div class="drop-down_brand row">
                <div class="col-md-2">
                    <p>From Date:</p>
                </div>
                <div class="col-md-4">
                <input type="date" name="from" class="form-control">
                </div>
                <div class="col-md-2">
                    <p>To Date:</p>
                </div>
                <div class="col-md-4">
                    <input type="date" name="to" class="form-control">
            </div>
            </div>
    <br>
        </div>
        <div class="col-md-3">
                <div class="p-2 no-side-paddings outlet-buttons">
                    <button type="button" class="btn btn-warning centered-buttons threshold-button" >Create New Request</button>
                </div>
                <div class="d-flex flex-row outlet-buttons">
                    <div class="p-2">
                        <button type="button" class="btn btn-sucess action-buttons">Search</button>
                    </div>
                    <div class="p-2">
                        <button type="button" class="btn btn-primary action-buttons">Edit</button>
                    </div>
                </div>
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
                    <th>Order Id#</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date of Request</th>
                    <th>More Details</th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach($outlets as $outlet)
                <tr>
                    <td>{{$outlet->id}}</td>
                    <td>{{$outlet->outlet_name}}</td>
                    <td>{{$outlet->address}}</td>
                    <td>{{$outlet->email}}</td>
                    <td>{{$outlet->telephone_number}}</td>
                    <td>{{$outlet->fax}}</td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row outlet-buttons">
                                <div class="p-2">
                                <button type="button" class="btn btn-primary action-buttons" onclick="openUpdateOutletModal()">Edit</button>
                                </div>
                                <div class="p-2">
                                    {!!Form::open(['action' => ['OutletsController@destroy', $outlet->id], 'method' => 'POST'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])}}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                            <div class="p-2 no-side-paddings outlet-buttons">
                                <a href="/"><button type="button" class="btn btn-secondary centered-buttons threshold-button" >Threshold</button></a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
               
            </tbody> --}}
        </table>
    </div>
</div>

<script>
    function openCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "block";
    }
    
    function closeCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "none";
    }

    function openUpdateOutletModal() {
        document.getElementById('updateOutletModal').style.display = "block";
    }
    
    function closeUpdateOutletModal() {
        document.getElementById('updateOutletModal').style.display = "none";
    }
</script>
@endsection

<style>
    .transferRequestNav {
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>