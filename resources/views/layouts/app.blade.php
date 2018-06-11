<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="shortcut icon" href="http://localhost:8000/storage/logo/butterfly_logo.png">
    <script src="http://localhost:8000/js/sorttable.js"></script>
    <script src="http://localhost:8000/js/jquery.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery-ui.min.js')}}" type="text/javascript"></script>
    <link href="{{asset('css/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/> 
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.js"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">

    @yield('script')
    @yield('styles')

<style>
@media (min-width: 768px) {
    .mobileLogo {
        visibility: hidden;
    }
}
</style>
   
</head>
<body>
    <div id="app">
        <main class="pb-5">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
</body>
</html>
