@extends('layouts.app')

@section('content')
@include('inc.navbar')
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

<<<<<<< HEAD
                        <div class="form-group row">
                            
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Username" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                           

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number" required>

                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" placeholder="Company Name" required>

                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6">
                                <input id="billing_address" type="text" class="form-control{{ $errors->has('billing_address') ? ' is-invalid' : '' }}" name="billing_address" value="{{ old('billing_address') }}" placeholder="Billing Address" required>

                                @if ($errors->has('billing_address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('billing_address') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <input id="shipping_address" type="text" class="form-control{{ $errors->has('shipping_address') ? ' is-invalid' : '' }}" name="shipping_address" value="{{ old('shipping_address') }}" placeholder="Shipping Address" required>

                                @if ($errors->has('shipping_address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('shipping_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
=======
                        {{-- <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}"> --}}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
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

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input id="number" type="number" class="form-control" name="number" placeholder="Phone number" value="{{ old('number') }}" required>

                                    @if ($errors->has('number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input id="company" type="company" class="form-control" name="company" placeholder="Company Name" value="{{ old('company') }}" required>

                                    @if ($errors->has('company'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('company') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input id="billing" type="billing" class="form-control" name="billing" placeholder="Billing Address" value="{{ old('billing') }}" required>

                                    @if ($errors->has('billing'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('billing') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input id="shipping" type="shipping" class="form-control" name="shipping" placeholder="Shipping Address" value="{{ old('shipping') }}" required>

                                    @if ($errors->has('shipping'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('shipping') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="checkbox" name="address" value="same"> My billing address is the same as my shipping address.<br>
                            </div>
                        </div>

                        <div class="form-group">
                            <div style="text-align:center">
                                <button type="submit" class="btn btn-primary">Register</button>
>>>>>>> ad00cc0375478775c6c12be78fda0c9de67d9497
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

