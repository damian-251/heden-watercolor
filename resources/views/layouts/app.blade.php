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
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-6NRZLW8R3G"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-6NRZLW8R3G');
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
    @include('partials.login-menu')
    <div id="app">
        {{-- @if (env('APP_ENV') != 'production')
        <div class="alert alert-warning fs-3 text-center" role="alert">
            {{__('This site is deployed only for testing purposes and is under construction, the site is not functional')}}
          </div>
            
        @endif --}}
        <div class="hw-logo d-none d-lg-block">
            HEDEN WATERCOLOR
        </div>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top hw-main-menu">

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
            <div class="container-fluid p-3 d-lg-flex justify-content-between">
                <div class="col-lg-4 col-md-12">
                    {{-- Lorem ipsum --}}
                </div>
                <div class="col-lg-4 col-md-12">
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
                <div class="col-lg-4 col-md-12">
                    {{-- <div class="text-end mr-3">
                        <a class="d-block"
                            href="{{ route('privacy-view', ['lang' => app()->getLocale()]) }}">{{ __('Privacy policy') }}</a>
                        <a class="d-block" href="#"> {{ __('Shipping') }}</a>
                        <a class="d-block" href="#"> {{ __('Support') }}</a>
                    </div> --}}
                </div>

            </div>
            <div class="d-flex justify-content-center pb-3">
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('privacy-view', ['lang' => app()->getLocale()]) }}">{{ __('Privacy policy') }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('shipping-policy-view') }}">
                            {{ __('Shipping') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('support') }}">
                            {{ __('Support') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cookies') }}">
                            {{ __('Cookies policy') }}</a></li>
                </ul>
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
