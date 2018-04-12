@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="container">
    <div class="row justify-content-end">
        <div>
            <a href="/staffsignup"><button type="button" class="btn btn-warning">Add new outlet</button></a>
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
                                    <a href="/"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
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
@endsection