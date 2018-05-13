@extends('layouts.app')

@section('content')
@include('inc.navbar')
<br><br>
<div class="container">
    <div class="topMargin row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

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
                                <input id="phone_number" type="number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number" required>

                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
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
                                <label><input id="cbSameAddress" type="checkbox" name="sameAddress[]" value=""> Same as Billing Address</label>
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
                                <input id="roles_id" type="hidden" name="roles_id" value="4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#cbSameAddress").click(function(){
            $status = $(this).is(":checked");
            if($status){
                $billing_address = $("#billing_address").val();
                if($billing_address == ""){
                    alert("Billing Address is empty");
                    $("#cbSameAddress").prop("checked", false);
                }else{
                    // alert($billing_address);
                    $("#shipping_address").val($billing_address);
                }
            }else{
                $("#shipping_address").val(""); 
            }
            
        });
    });
</script>
@endsection

<style>
    .registerNav {
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>