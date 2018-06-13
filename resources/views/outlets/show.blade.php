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
        @if(count($userOutlets) > 0)
        <p>The following staffs are tied to this outlet:</p>
            <table class="table table-striped" id="outletTable">
                <thead>
                    <tr>
                        <th>Users</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($userOutlets as $userOutlet)
                    <tr>
                        <td>{{$userOutlet->name}}</td>
                        <td>{!!Form::open(['action' => ['OutletsController@destroy', $userOutlet->users_id], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])}}
                            {!!Form::close()!!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if(count($userOutlets) < 1)
            {!!Form::open(['action' => ['OutletsController@deleteThis', $outlet->id], 'method' => 'POST'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])}}
            {!!Form::close()!!}
        @endif
</div>