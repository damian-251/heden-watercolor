@extends('layouts.app')

@section('title')
    Heden Watercolor - {{ __('Shopping cart') }}
@endsection

@section('styles')
    <link href="{{ asset('css/shopping-cart.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h1 class="text-center">{{ __('Shopping cart') }}</h1>

    @if ($cart->products->count() > 0)
        <div class="container ">
            @foreach ($cart->products as $product)
                <div class="row shadow">
                    <div class="col-lg-3 col-md-6">
                        <picture>
                            <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
                            <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg">
                            <img class="hw-cart-item" src="{{ asset($product->img_path_jpg) }}" alt="Product image">
                        </picture>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-center justify-content-center">
                        @foreach ($product->product_translation as $productTr)
                            @if ($productTr->language_code == $locale)
                                {{ $productTr->name }}
                            @endif
                        @endforeach
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-center justify-content-center hw-product-price">
                        @if ($locale == 'no')
                            <div>{{ $product->price_nok }} kr</div>
                        @else
                            <div>{{ $product->price_eur }} €</div>
                        @endif
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-center justify-content-center">
                        <form action="{{ route('delete-product-p') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="btn btn-danger hw-delete-button" type="submit">{{ __('Delete') }}</button>
                        </form>
                    </div>
                    <div class="text-end mr-3 my-2">
                        {{__('Reservation time')}}:
                        @if ($product->reserved != null && \Carbon\Carbon::parse($product->reserved)->gt($currentTime))

                            <span class="reservation-time">{{\Carbon\Carbon::parse($product->reserved)->diffInSeconds($currentTime)}}</span>
                        @else
                            <span class="no-reservation">{{__('Without reservation')}}</span>
                        @endif
                        
                    </div>
            
                    
                </div>
            @endforeach
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>{{__("If the product has no reservation and other user reserve it, the product will disappear from your cart.")}}
                        {{__("Resevation only affects products with only 1 unit available like paintings.")}}<p>
                    <p>{{__('If the reservation time has finished you can reserve it again by adding the product to your cart')}}</p>
                    
                </div>

                <div class="col-lg-3 col-md-6">

                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-center justify-content-center hw-total-price">
                    {{ __('Subtotal') }}: {{ $totalPrice }} @if ($locale == 'no')
                        kr
                    @else
                        €
                    @endif
                </div>

            </div>
            <div class="row">

                <div>
                    @include('partials.messages')
                    <form action="{{ route('shipping-data-p') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-center">
                            @include('partials.privacy-check')

                        </div>

                        @include('partials.recaptcha')

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit">{{ __('Checkout') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-warning m-3 text-center" role="alert">
                {{ __('The cart is empty') }}
            </div>
    @endif
    <script src={{ asset('js/cart.js')}}></script>
@endsection
