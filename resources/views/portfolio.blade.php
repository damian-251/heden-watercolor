@extends('layouts.app')

@section('title')
    Heden Watercolor - {{ __('Portfolio') }}
@endsection

@section('styles')
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('partials.messages')
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
                <li><a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('Colours') }}</a>
                    <ul class="dropdown-menu">
                        @foreach ($colourNames as $colourName)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('portfolio', ['type' => 'colour', 'parameter' => $colourName->name]) }}">{{ $colourName->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <form class="d-flex" action="{{ route('portfolioP') }}" method="POST">
            @csrf
            <input class="form-control me-2 " id="hw-search-input" type="search" placeholder="{{ __('Search by title') }}" aria-label="Search"
                name="search">
            <button class="btn btn-outline-success" type="submit">{{ __('Search') }}</button>
        </form>

    </div>
    <div>
        <div class="d-flex justify-content-center" >
        <div id="hw-search-options" class="p-2 mx-2">
            <span id="hw-search-right">⮞</span><span id="hw-search-down" style="display:none">⮟</span>
            {{ __('Search options') }}
        </div>
        </div>
        <div id="hw-search-description" style="display: none">
            <div class="container">
                <div class="row text-center">

                    <div class="col-md-6  hw-search-word">
                        #title
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by title') }}
                    </div>

                </div>
                <div class="row text-center">

                    <div class="col-md-6 hw-search-word">
                        #description
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by description') }}
                    </div>

                </div>
                <div class="row text-center">

                    <div class="col-md-6  hw-search-word">
                        #color
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by color') }}
                    </div>
                </div>
                <div class="row text-center">

                    <div class="col-md-6  hw-search-word">
                        #width
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by width') }}
                    </div>
                </div>
                <div class="row text-center">

                    <div class="col-md-6  hw-search-word">
                        #height
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by height') }}
                    </div>
                </div>
                <div class="row text-center">

                    <div class="col-md-6  hw-search-word">
                        #tag
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by tag') }}
                    </div>
                </div>
                <div class="row text-center">

                    <div class="col-md-6  hw-search-word">
                        #location
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by location') }}
                    </div>
                </div>
                <div class="row text-center">

                    <div class="col-md-6  hw-search-word">
                        #range
                    </div>

                    <div class="col-md-6">
                        {{ __('Search by date of creation range eg.') }} 12-12-2020 01-01-2022
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($warning))
        <div class="d-flex justify-content-center">
            <div class="alert alert-warning text-center mx-4 w-50"> {{ $warning }}</div>
        </div>
        @endif
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
