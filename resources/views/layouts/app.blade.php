<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     
     <script src="{{asset('js/jquery-ui.min.js')}}" type="text/javascript"></script>
     <link href="{{asset('css/jquery-ui.min.css')}} rel="stylesheet" type="text/css"/> 
     {{-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> --}}
{{-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    {{-- <script type="text/javascript" rel="stylesheet" src="js/app.js" ></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
    @yield('script')
    {{-- <script>
        $(document).ready(function(){
            if($outlet->id == $userOutlet->outlets_id){
                $("#cbChecked").attr("checked","checked");
            // $(".idtext").css("color","lightgreen");
            }
            
        })
    </script> --}}
   
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
