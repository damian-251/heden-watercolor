@extends('layouts.app')

@section('title')
    {{ __('Shopping cart') }}
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
                      <img src="{{ asset($product->img_path_jpg) }}" alt="Product image">
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
          </div>
      @endforeach
      <div class="row">
          <div class="col-lg-3 col-md-6">

          </div>

          <div class="col-lg-3 col-md-6">

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
          <div class="col-lg-3 col-md-6">

          </div>

          <div class="col-lg-3 col-md-6">

          </div>
          <div class="col-lg-3 col-md-6">

          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-center justify-content-center">
              <form action="{{ route('shipping-data-p') }}" method="POST">
                  @csrf
                  <button class="btn btn-primary" type="submit">{{ __('Checkout') }}</button>
              </form>
          </div>
      </div>
  </div>
    @else
    <div class="alert alert-warning m-3 text-center" role="alert">
      {{__('The cart is empty')}}
    </div>
    
    @endif

@endsection
