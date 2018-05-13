@extends('layouts.app')

@section('content')
@include('inc.navbar')
<div class="topMargin container">
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" align="center">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            {{-- <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-12">
                                <input id="identity" type="identity" class="form-control{{ $errors->has('identity') ? ' is-invalid' : '' }}" name="identity" value="{{ old('identity') }}" placeholder="{{ __('Email or Username') }}" required autofocus>

                                @if ($errors->has('identity'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('identity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div style="text-align:center">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div style="text-align:center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <br>
                            <div style="text-align:center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .loginNav {
        background-color: #e3b417 !important;
        color: #566B30 !important;
    }
</style>