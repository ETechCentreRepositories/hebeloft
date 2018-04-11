@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                                <div class="row">
                            <div class="col-md-6">
                                <input type="radio" name="gender" value="warehouse"> Warehouse staff<br>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" name="gender" value="outlet"> Outlet staff<br>
                            </div>
                                </div>
                        </div>

                        {{-- <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}"> --}}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="row">
                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="email" type="text" class="form-control" name="email" value="enquiry@hebeloft.com" value="{{ old('email') }}" required autofocus>
    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="number" type="number" class="form-control" name="number" placeholder="Phone number" value="{{ old('number') }}" required>
    
                                    @if ($errors->has('number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                                </div>
                            </div>
                        </div>

                        <br><hr><br>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="ogal"> OG ALBERT<br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="ogop"> OG ORCHARD POINT<br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="ogct"> OG PEOPLE'S PARK (CHINATOWN)<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="bhgbj"> BHG BISHAN JUNCTION 8<br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="bhgcck"> BHG CHOA CHU KANG<br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="bhgjp"> BHG JURONG POINT<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="metc"> METRO CENTREPOINT<br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="metp"> METRO PARAGON<br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="nfbt"> NTUC FINEST BUKIT TIMAH<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="nfmp"> NTUC FINEST MARINE PARADE<br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="nxjp"> NTUC JURONG POINT XTRA<br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="role" value="nxnc"> NTUC NORTHPOINT CITY<br>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div style="text-align:center">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
