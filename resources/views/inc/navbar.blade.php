<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#46552c;" >
    <div class="container">
        <a class="nav navbar-left" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'Hebeloft') }} --}}
            
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <a href="/"><img src="storage/logo/hebeloft_logo.png" class="logo"/></a>
                <li><a class="nav-link" style="color:#e3b417;" href="/inventory">Inventory</a></li>
                <li><a class="nav-link" style="color:#e3b417;" href="/salesorder">Sales order</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                                                              <!-- Authentication Links -->
                @guest
                <li><a class="nav-link" style="color:#e3b417;" onclick="openTermsAndConditions()">Terms and Conditions</a></li>
                <li><a class="nav-link" style="color:#e3b417;" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="nav-link" style="color:#e3b417;" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}<span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest 
            </ul>
        </div>
    </div>
</nav>

<div id="termsAndConditions" class="termsAndConditions modal">
    <span class="close cursor" onclick="closeTermsAndConditions()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <h3 class="termsAndConditionsTitle">Terms and conditions</h3>
            <br>
            <div class="termsAndConditionsContent">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis, lectus ac consequat vehicula, nisl erat interdum nunc, eget pulvinar tortor lectus quis orci. Aenean eros leo, fermentum nec urna vitae, scelerisque consequat nibh. Phasellus sit amet iaculis nibh. Vestibulum blandit facilisis vulputate. Praesent quis eros ex. Cras ornare auctor lectus in feugiat. Praesent lacinia dolor et purus imperdiet, id laoreet est efficitur. In sodales ac nunc a tincidunt. Integer tempus neque ligula, id convallis turpis scelerisque at.

                    Sed ultrices dapibus volutpat. Proin accumsan, enim vel accumsan congue, purus odio porttitor urna, et feugiat diam eros vel dolor. Vivamus interdum id tortor sit amet vehicula. Ut vel enim porttitor, scelerisque nulla sit amet, sagittis tellus. Proin consequat at dui vitae suscipit. Pellentesque vel lacinia mauris. Donec at nulla et lorem elementum sodales. Proin eleifend molestie augue a tincidunt.
                    
                    Vivamus imperdiet ante quis justo ultricies, vitae rhoncus nibh euismod. Nunc id felis condimentum, ornare elit quis, scelerisque dui. Morbi fermentum nulla efficitur iaculis pulvinar. Nunc convallis purus sed elit ultrices mollis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In in sodales tellus. Donec egestas rutrum consequat. In consectetur ex sapien, a sodales ante dictum vel. Aliquam eget enim quis arcu sollicitudin ornare. Mauris sit amet gravida velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed eu consequat erat. Phasellus quis gravida turpis, eget tempus ex. Aenean eget dapibus nisl.
                    
                    Fusce tristique dignissim tempus. Sed ullamcorper et turpis vel tristique. Sed lacinia tempor justo, quis iaculis massa hendrerit id. Nulla in ipsum consequat, pharetra ante vitae, ultrices nibh. Morbi nec dolor et ligula sollicitudin finibus. Vivamus molestie ullamcorper arcu, eu tincidunt purus lacinia nec. Duis mollis mauris vitae nibh pulvinar, at tempus quam gravida. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus egestas nisi ut orci porttitor facilisis. Sed aliquet, tortor quis dictum iaculis, ipsum felis maximus enim, et porta tellus enim faucibus tellus. Donec nec erat lacus. Cras sodales feugiat lacus, sed euismod turpis congue et. Donec vel suscipit sem. Vestibulum vestibulum, dui quis ornare porttitor, lacus sem auctor felis, vel scelerisque dolor orci quis nunc. Nam faucibus lorem ac lacus sollicitudin finibus. Suspendisse neque sem, sollicitudin id sodales consectetur, scelerisque eu odio.
                    
                    Sed ac congue massa. Suspendisse sit amet enim suscipit, interdum ex eu, tincidunt purus. Quisque sit amet sodales tellus. Etiam pellentesque enim sit amet ipsum fermentum, sed aliquet libero aliquet. Vivamus sed nunc non augue egestas ullamcorper. Nullam auctor, quam sit amet consequat semper, quam ipsum semper turpis, sed lobortis justo magna non nulla. Etiam suscipit sed urna id tristique. Integer quis dui quis diam maximus facilisis.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function openTermsAndConditions() {
        document.getElementById('termsAndConditions').style.display = "block";
    }
    
    function closeTermsAndConditions() {
        document.getElementById('termsAndConditions').style.display = "none";
    }
</script>