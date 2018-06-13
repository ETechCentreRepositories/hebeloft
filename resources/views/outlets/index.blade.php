@extends('layouts.app')

@section('content')

@if ($users_id->roles_id == '1')
@include('inc.navbar_superadmin')
@elseif ($users_id->roles_id == '2')
@include('inc.navbar_admin')
@elseif ($users_id->roles_id == '3')
@include('inc.navbar_outletstaff')
@include('inc.unauthorized')
@elseif ($users_id->roles_id == '4')
@include('inc.navbar_wholesaler')
@include('inc.unauthorized')
@endif

<br>
<div class="topMargin container">
    <a href="{{ route('exportOutlet.file',['type'=>'csv']) }}"><button type="button" class="btn btn-warning" style="width: auto; float: left;">Export</button></a>
    <div class="row justify-content-end">
        <div class="col-d-2">
            <button type="button" class="btn btn-warning" onclick="openCreateOutletModal()">Add new outlet</button>
        </div>
    </div>
    <br>
    <div>
        <table class="display" id="outletTable">
            <thead>
                <tr>
                    <th>Branch name</th>
                    <th>Address</th>
                    <th>Telephone Number</th>
                    @if ($users_id->roles_id == '1')
                    <th class="emptyHeader"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($outlets as $outlet)
                <tr id="{{$outlet->id}}">
                    <td>{{$outlet->outlet_name}}</td>
                    <td>{{$outlet->address}}</td>
                    <td>{{$outlet->telephone_number}}</td>
                    @if ($users_id->roles_id == '1')
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row outlet-buttons">
                                <div class="p-2">
                                <a href="/outlet/{{$outlet->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                </div>
                                <div class="p-2">
                                <a href="/outlet/{{$outlet->id}}"><button type="button" class="btn btn-danger" id="delete">Delete</button>
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
</div>

@if(count($outlets) > 0)
<div id="createOutletModal" class="modal">
    <span class="close cursor" onclick="closeCreateOutletModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Create outlet</h3>
            <br>
            {!! Form::open(['action' => 'OutletsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'style' => 'margin-bottom: 0']) !!}
            <div class="form-group modal-fields">
                {{Form::text('outlet_name', '', ['class' => 'form-control', 'placeholder' => 'Branch name'])}}
            </div>
            <div class="form-group modal-fields">
                {{Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Address'])}}
            </div>
            <div class="form-group modal-fields">
                {{Form::text('telephone_number', '', ['class' => 'form-control', 'placeholder' => 'Telephone number'])}}
            </div>
            <br>
            <div class="form-group modal-button">
                {{Form::submit('Create outlet', ['class'=>'btn btn-primary btn-lg'])}}
            </div>
            <br>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endif

<div id="deleteOutletModal" class="modal">
    <span class="close cursor" onclick="closeDeleteOutletModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            
            <h3 class="card-title">Delete Confirmation</h3>
            <br>
            <h3>Are you sure you want to delete this outlet?</h3>
            <p>The following staffs are tied to this outlet:</p>
            @foreach($userOutlets->where('outlets_id','==',$outlet->id) as $userOutlet)
            <p>{{$userOutlet->users['name']}}</p>
            @endforeach
            {!!Form::open(['action' => ['OutletsController@destroy', $outlet->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])}}
            {!!Form::close()!!}
    </div>
</div>

<script>
$(document).ready(function () {
    $("#outletTable").DataTable();
});
    function openCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "block";
    }
    
    function closeCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "none";
    }
    function openDeleteOutletModal() {
        document.getElementById('deleteOutletModal').style.display = "block";
    }
    function closeDeleteOutletModal() {
        document.getElementById('deleteOutletModal').style.display = "none";
    }
</script>
@endsection

<style>
    .outletNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>