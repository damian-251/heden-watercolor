<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ __('Site about the watercolour artist Heden') }}" />
    <meta name="keywords" content="watercolour, watercolor, heden, hedenwatercolor, artist, shop">
    <meta name="author" content="Heden Watercolor">
    @yield('metainfo')



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Favicon -->

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- Recaptcha script --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    @if (env('APP_ENV') != 'local')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-NRP9S1XZBH"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-NRP9S1XZBH');
        </script>
    @endif


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome --->
    <script src="https://kit.fontawesome.com/a065a99a3f.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">
    <!-- Aquí irán las hojas de estilo secundarias que se añadan -->
    @yield('styles')

</head>

<body>
    @include('cookie-consent::index')
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('user-control-panel') }}">
                                {{ __('User settings') }} </a>

                            @if (Auth::user()->is_admin)
                                {{-- Mostramos el panel de administración a los administradores --}}
                                <a class="dropdown-item" href="{{ route('admin-cp') }}">
                                    {{ __('Administration Panel') }} </a>
                            @endif
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ __('Language') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @foreach (config('app.available_locales') as $locale_name => $available_locale)
                            <a class="dropdown-item"
                                href="language/{{ $available_locale }}">{{ $locale_name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div id="app">
        {{-- @if (env('APP_ENV') != 'production')
        <div class="alert alert-warning fs-3 text-center" role="alert">
            {{__('This site is deployed only for testing purposes and is under construction, the site is not functional')}}
          </div>
            
        @endif --}}
        <div class="hw-logo d-none d-lg-block">
            HEDEN WATERCOLOR
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">

            <div class="container d-flex justify-content-between">
                <div class="d-block d-lg-none fs-3 mx-4 my-3 hw-mobile-logo">
                    {{ __('HEDEN WATERCOLOR') }}
                </div>
                <button class="navbar-toggler mx-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="hw-div-mainmenu collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto hw-ul-itemlist text-center">
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('start') }}">{{ __('Home') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('portfolio') }}">{{ __('Portfolio') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('shop') }}">{{ __('Shop') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('exhibitions') }}">{{ __('Exhibitions') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('request-painting') }}">{{ __('Request painting') }}</a> </li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('shopping-cart') }}">{{ __('Shopping Cart') }} </a> </li>
                        @if ($specialTagStart != null)
                            @foreach ($specialTagStart->tag_translation as $translation)
                                @if ($translation->language_code == app()->getLocale())
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('special-section') }}">{{ $translation->name }} </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('about-heden') }}">{{ __('About Heden') }}</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
        <footer class="bg-light">
            <div class="container-fluid p-3">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        Lorem ipsum
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div>
                            <div class="text-center">
                                Heden Watercolor
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="https://www.instagram.com/heden.watercolor/" target="_blank"><img
                                        src="{{ asset('assets/images/icons/instagram.png') }}"
                                        alt="{{ __('Link to Instagram account') }}"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="my-auto">
                            <a
                                href="{{ route('privacy-view', ['lang' => app()->getLocale()]) }}">{{ __('Privacy policy') }}</a>
                            Shipping
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script>
        //Modificamos el botón de cookies por uno tipo bootstrap
        let botonCookies = document.getElementsByClassName("js-cookie-consent-agree")[0];
        //Aumentamos el tamaño del texto
        let textoCookies = document.getElementsByClassName("cookie-consent__message")[0];

        if (botonCookies != null && textoCookies != null) {

            botonCookies.classList.add("btn");
            botonCookies.classList.add("btn-dark");
            textoCookies.classList.add("fs-4");
            textoCookies.classList.add("text-center");
        }
    </script>
</body>

</html>
