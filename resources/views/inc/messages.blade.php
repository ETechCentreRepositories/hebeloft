@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger laravelAlert">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success laravelAlert">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger laravelAlert">
        {{session('error')}}
    </div>
@endif