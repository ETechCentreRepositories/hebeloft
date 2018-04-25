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