@extends('layouts.app')

@section('content')
@include('inc.navbar_superadmin')
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- <p>{{$users->roles_id}}</p> --}}
                    {{-- @foreach($users as $user)
                        {{$user->roles_id}}
                    @endforeach --}}
                    This is the homepage.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
