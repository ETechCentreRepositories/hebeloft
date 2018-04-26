@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="topMargin container">
    <div class="row justify-content-end">
        <div>
            <button type="button" class="btn btn-warning" onclick="openCreateOutletModal()">Add new outlet</button>
        </div>
    </div>
    <br>
    {{-- {!!dd(count($outlets));!!} --}}
    @if(count($outlets) > 0)
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
                    <th class="emptyHeader"></th>
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
                            <div class="d-flex flex-row outlet-buttons">
                                <div class="p-2">
                                <a href="/outlet/{{$outlet->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
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
               
            </tbody>
        </table>
    </div>
    @else
    <p>No outlets found</p> 
    @endif
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
                {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
            </div>
            <div class="form-group modal-fields">
                {{Form::text('telephone_number', '', ['class' => 'form-control', 'placeholder' => 'Telephone number'])}}
            </div>
            <div class="form-group modal-fields">
                {{Form::text('fax', '', ['class' => 'form-control', 'placeholder' => 'Fax'])}}
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
<div class="pagination">
    {{$outlets->links()}}
</div>
<script>
    function openCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "block";
    }
    
    function closeCreateOutletModal() {
        document.getElementById('createOutletModal').style.display = "none";
    }
</script>
@endsection

<style>
    .outletNav {
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>