@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">Staff Sign Up</div>

                <div class="card-body">
                    {!!Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) !!}
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <div class="row">
                            <div class="col-md-12">
                                {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Username'])}}

                                {{-- @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif --}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="row">
                            <div class="col-md-12">
                                {{Form::text('password', "", ['class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password'])}}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <div class="row">
                            <div class="col-md-12">
                                {{Form::text('status', $user->status, ['class' => 'form-control', 'placeholder' => 'Status'])}}
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                        <div class="row">
                            <div class="col-md-12">
                                {{Form::select('role', $roleList, $user->roles_id)}}
                            </div>
                        </div>
                    </div>

                    <br><hr><br>

                    <label >Outlet:</label>
                    <div class="form-group row"> 
                        @foreach($outlets as $outlet) 
                        <div class="col-md-5">
                            @foreach($userOutlets as $userOutlet)
                                @if($outlet->id == $userOutlet->outlets_id)
                                    <label class="checkbox-inline"><input id="cbChecked" name="outlet[]" type="checkbox" value="{{$outlet->id}}" checked> {{$outlet->outlet_name}} </label>
                                    {{-- @section('script')
                                        $(document).ready(function(){
                                            $("#cbChecked").attr("checked","checked");
                                        });
                                    @endsection --}}
                            {{-- @else
                                <label class="checkbox-inline"><input  name="outlet[]" type="checkbox" value="{{$outlet->id}}"> {{$outlet->outlet_name}} </label> --}}
                                    
                                @endif
                                
                            @endforeach
                                <label class="checkbox-inline"><input id="cbChecked" name="outlet[]" type="checkbox" value="{{$outlet->id}}"> {{$outlet->outlet_name}} </label>
                        </div>
                        @endforeach
                    </div>

                    {{Form::hidden('_method','PUT')}}
                    <div class="form-group">
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary">
                                Edit User
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>