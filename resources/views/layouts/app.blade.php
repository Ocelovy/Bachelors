<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MedBridge</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('.images/meds.png') }}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA76F8DVVojuWMWiiBdGg5STY6tPn3RlAw&callback=initMap"></script> -->
</head>
<body>
@yield('background')
<canvas id="particle-canvas"></canvas>
    <div id="app">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">

                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('.images/LOGO.png') }}" alt="logo_medbridge" class="logo-img me-2">
                    <span class="d-none d-md-inline">{{ config('MedBridge', 'MedBridge') }}</span>
                </a>
                <div class="navbar-icons">
                    <a id="toggle-particles" class="navbar-icon" title="Vypnutie/Zapnutie animácie">
                        <i class="fas fa-power-off"></i>
                    </a>
                    <div class="navbar-support-phone" title="Telefónne číslo podpory">
                         <i class="fas fa-phone"></i>
                        <span class="phone-number-tooltip">+421 948 001 556</span>
                    </div>
                    <a href="mailto:peter.hromada@example.com" class="navbar-support-link" title="Kontakt na podporu">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <a class="nav-link" href="{{ route('user.index') }}">{{__('Používatelia')}}</a>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('comment') }}">Nástenka</a>
                        </li>
                        @endauth
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user.profile') }}">Profil</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Odhlásiť sa') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                        @endguest

                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Systém
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('fotogaleria') }}">Fotogaléria</a></li>
                                    @if(auth()->check() && auth()->user()->isAdmin() || auth()->user()->isDoktor())
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                        <li><a class="dropdown-item" href="{{ route('ambulances.index') }}">Ambulancie</a></li>
                                        <li><a class="dropdown-item" href="{{ route('pacient') }}">Pacienti</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('success'))
                <div id="flash-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>

        <div class="bottom-panel">
            <span id="current-time"></span>
            <a>Copyright © 2024 MedBridge</a>
            <a href={{ route('kontakt') }}>Kontakt</a>
        </div>
    </div>
</body>
</html>
