@extends('layouts.app')

@section('title')
    Heden Watercolor - {{ __('Portfolio') }}
@endsection

@section('styles')
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="hw-filter-search">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle mx-3" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ __('Filter') }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('Tag') }}</a>
                    <ul class="dropdown-menu">
                        @foreach ($tagNames as $tagName)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('portfolio', ['type' => 'tag', 'parameter' => $tagName->name]) }}">{{ $tagName->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('Location') }}</a>
                    <ul class="dropdown-menu">
                        @foreach ($locationNames as $locationName)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('portfolio', ['type' => 'location', 'parameter' => $locationName->name]) }}">{{ $locationName->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <form class="d-flex" action="{{ route('portfolioP') }}" method="POST">
            @csrf
            <input class="form-control me-2 " type="search" placeholder="{{ __('Search by title') }}" aria-label="Search"
                name="search">
            <button class="btn btn-outline-success" type="submit">{{ __('Search') }}</button>
        </form>

    </div>
    <div>
        <div class="text-center" id="hw-search-options">
            {{ __('Search options') }}
        </div>
        <div id="hw-search-description" style="display: none">
            <div class="container">
                <div class="row text-center">

                    <div class="col-md-6">
                        #title
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by title') }}
                    </div>

                </div>
                <div class="row text-center">

                    <div class="col-md-6">
                        #description
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by description') }}
                    </div>

                </div>
                <div class="row text-center">

                    <div class="col-md-6">
                        #color
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by color') }}
                    </div>
                </div>
                <div class="row text-center">

                    <div class="col-md-6">
                        #length
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by length') }}
                    </div>
                </div>
                <div class="row text-center">

                    <div class="col-md-6">
                        #height
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by height') }}
                    </div>
                </div>
                <div class="row text-center">

                    <div class="col-md-6">
                        #tag
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by tag') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if ($searchQuery != null)
        <h2 class="text-center m-3">{{ $searchQuery }}</h2>
    @endif
    <div class="hw-product-container">
        @foreach ($products as $product)
            <a href="{{ route('product-details', ['id' => $product->id]) }}" class="hw-product-link">
                <div class="hw-div-product">
                    <picture>
                        <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
                        <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg">
                        <img src="{{ asset($product->img_path_jpg) }}" alt="Product image">
                    </picture>
                    {{-- Si hay stock del producto mostramos el mensaje de disponible al pasar el ratón --}}

                    <div class="hw-product-text fs-3 shadow-lg"
                        style="display: none;@if ($product->stock == 0) border-radius: 0px; padding: 0; @endif">
                        @if ($product->stock > 0)
                            {{ __('Available') }}
                        @endif
                    </div>

                </div>
            </a>
        @endforeach
    </div>

    <script src={{ asset('js/portfolio.js') }}></script>
@endsection
