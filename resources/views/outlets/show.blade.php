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
    <br>
    <h3>Delete Confirmation</h3>
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