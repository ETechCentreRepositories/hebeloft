@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="container">
    <div class="row justify-content-end">
        <div>
            <button type="button" class="btn btn-warning" onclick="openCreateOutletModal()">Add new outlet</button>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Branch name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Telephone Number</th>
                    <th>Fax</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
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
                            <div class="d-flex flex-row centered-buttons">
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
                            <div class="p-2 no-side-paddings">
                                <a href="/"><button type="button" class="btn btn-secondary centered-buttons threshold-button" >Threshold</button></a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="createOutletModal" class="modal">
    <span class="close cursor" onclick="closeCreateOutletModal()">&times;</span>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create outlet</h5>
            {!! Form::open(['action' => 'OutletsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::text('outlet_name', '', ['class' => 'form-control', 'placeholder' => 'Branch name'])}}
            </div>
            <div class="form-group">
                {{Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Address'])}}
            </div>
            <div class="form-group">
                {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
            </div>
            <div class="form-group">
                {{Form::text('telephone_number', '', ['class' => 'form-control', 'placeholder' => 'Telephone number'])}}
            </div>
            <div class="form-group">
                {{Form::text('fax', '', ['class' => 'form-control', 'placeholder' => 'Fax'])}}
            </div>
            <div class="form-group">
                {{Form::submit('Create outlet', ['class'=>'btn btn-primary'])}}
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>

<div id="updateOutletModal" class="modal">
        <span class="close cursor" onclick="closeCreateOutletModal()">&times;</span>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create outlet</h5>
                {!! Form::open(['action' => ['OutletsController@update', $outlet->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::text('outlet_name', $outlet->outlet_name, ['class' => 'form-control', 'placeholder' => 'Branch name'])}}
                </div>
                <div class="form-group">
                    {{Form::text('address', $outlet->address, ['class' => 'form-control', 'placeholder' => 'Address'])}}
                </div>
                <div class="form-group">
                    {{Form::text('email', $outlet->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
                </div>
                <div class="form-group">
                    {{Form::text('telephone_number', $outlet->telephone_number, ['class' => 'form-control', 'placeholder' => 'Telephone number'])}}
                </div>
                <div class="form-group">
                    {{Form::text('fax', $outlet->fax, ['class' => 'form-control', 'placeholder' => 'Fax'])}}
                </div>
                {{Form::hidden('_method', 'PUT')}}
                <div class="form-group">
                    {{Form::submit('Create outlet', ['class'=>'btn btn-primary'])}}
                </div>
            {!! Form::close() !!}
            </div>
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