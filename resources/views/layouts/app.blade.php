<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title")</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <!-- Aquí irán las hojas de estilo secundarias que se añadan -->
    @yield('styles')

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light shadow-sm hw-topmenu">
        <div class="navbar-collapse collpase">
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
            
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                                
                            <a class="dropdown-item" href="{{ route('user-control-panel') }}">  {{ __('User settings') }} </a>
            
                            @if (Auth::user()->is_admin) {{--Mostramos el panel de administración a los administradores --}}
                                <a class="dropdown-item" href="{{ route('admin-cp') }}">  {{ __('Administration Panel') }} </a>
                            @endif
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            </form>
                        </div>
                    </li>
                @endguest
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{__('Language') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @foreach(config('app.available_locales') as $locale_name => $available_locale)
                         <a class="dropdown-item" href="language/{{ $available_locale }}">{{ $locale_name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div id="app">
        <div class="hw-logo">
            HEDEN WATERCOLOR
        </div>
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <div class="hw-div-mainmenu" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto hw-ul-itemlist">
                        <li class="nav-item"> <a class="nav-link" href="#">{{ __('Home') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('portfolio') }}">{{ __('Portfolio') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('shop') }}">{{ __('Shop') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="#">{{ __('Exhibitions') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="#">{{ __('Contact') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('shopping-cart')}}">{{ __('Shopping Cart') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('request-painting')}}">{{ __('Request painting') }}</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
