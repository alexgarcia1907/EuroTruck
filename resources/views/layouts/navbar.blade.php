<nav class="navbar navbar-expand-md text-white shadow-sm" style="background-color:#263238 !important;">
    <div class="container">
        <a class="navbar-brand py-3" href="{{ url('/') }}" style="color:white;">
            <img src="/img/logo.svg" alt="Web Logo" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto" style="color:white;">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('login') }}" style="color:white;">{{ __('Inicar sesión') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color:white;">{{ __('Registrarse') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a style="color:white;" class="nav-link" aria-haspopup="true" aria-expanded="false" v-pre>
                            Usuario: {{ Auth::user()->name }}
                            <br>
                            Rol: {{Auth::user()->role->desc}}
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>