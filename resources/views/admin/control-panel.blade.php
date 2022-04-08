@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{__('Administration Control Panel')}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Home') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Portfolio') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('test.shop') }}">{{ __('Shop') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Exhibitions') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Contact') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{route('cart.shop')}}">{{ __('Shopping Cart') }}</a> </li>
            </ul>
        </div>
    </div>
</nav>


    <h1>{{__('Administration Control Panel')}}</h1>
@endsection