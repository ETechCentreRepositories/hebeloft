<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#46552c;"  >
    <div class="container">
        <a class="nav navbar-left" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'Hebeloft') }} --}}
            <img src="http://localhost:8000/storage/logo/hebeloft_logo.png" class="mobileLogo" style="
    height: 100%;margin-left:10px;
">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="leftNavbar navbar-nav mr-auto">
                <a href="/"><img src="http://localhost:8000/storage/logo/hebeloft_logo.png" class="logo"/></a>
                <li class="navList"><a class="inventoryNav nav-link" style="color:#e3b417;" href="/"><div class="navLabels">Inventory</div></a></li>
                <li class="navList"><a class="salesOrderNav nav-link" style="color:#e3b417;" href="/salesorder"><div class="navLabels">Sales Order</div></a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="rightNavbar navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="navList"><a class="loginNav nav-link" style="color:#e3b417;" href="{{ route('login') }}"><div class="navLabels">{{ __('Login') }}</div></a></li>
                <li class="navList"><a class="registerNav nav-link" style="color:#e3b417;" href="{{ route('register') }}"><div class="navLabels">{{ __('Register') }}</div></a></li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle username" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu logoutDropdown" aria-labelledby="navbarDropdown">
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