<!DOCTYPE html>
<html lang={{app()->getLocale()}}> <!-- Obtenemos el idioma que se ha establecido -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        @include('partials/language_switcher')
        <nav class="navbar navbar-expand-sm bg-light">
            <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Home') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Portfolio') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('test.shop') }}">{{ __('Shop') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Exhibitions') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Contact') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{route('cart.shop')}}">{{ __('Shopping Cart') }}</a> </li>
            </ul>
            </div>
        </nav>
    </header>
    <main>@yield('main')</main>
    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>