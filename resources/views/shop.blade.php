@extends('layouts.app')

@section('title')
    {{ __('Shop') }}
@endsection

@section('styles')
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('partials.messages')

    <div class="hw-product-container">
        @foreach ($products as $product)
            <div class="hw-product-box">
                <a href="{{ route('product-details', ['id' => $product->id]) }}">
                    <div class="hw-div-product">
                        <picture>
                            <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
                            <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg">
                            <img src="{{ asset($product->img_path_jpg) }}" alt="Product image">
                        </picture>
                    </div>
                </a>
                <div class="hw-data-container">
                    <span class="hw-price fs-3 d-flex justify-content-center">
                        @if (app()->getLocale() == 'no')
                            {{ $product->price_nok }} NOK
                        @else
                            {{ $product->price_eur }} €
                        @endif
                    </span>
                    <form class="my-3 d-flex justify-content-center" action="{{ route('add-to-cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @if ($product->reserved != null && \Carbon\Carbon::parse($product->reserved)->gt($currentTime))
                            <button type="button" class="btn btn-danger disabled not-allowed">{{ __('Reserved') }}</button>
                        @else
                            <button class="btn btn-primary" type="submit">{{ __('Add to cart') }}</button>
                        @endif
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <script src={{ asset('js/portfolio.js') }}></script>
@endsection
