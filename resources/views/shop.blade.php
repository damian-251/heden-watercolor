@extends('layouts.app')

@section('title')
    {{ __('Shop') }}
@endsection

@section('styles')
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pagination.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="text-center mb-3">{{__('Shop')}}</h1>
    @include('partials.messages')

    @if (config('services.shop.disabled') == false)
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
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
        
    @else

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
      </svg>
      
      <div class="hw-shop-closed alert alert-primary d-flex align-items-center d-flex justify-content-center col-md-6 mx-auto" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
              <div>
                  {{__('The shop will be available soon. Thank you. If you are interested in a painting please contact with heden.watercolor@gmail.com')}}
              </div>
      </div>
        
    @endif

    

    <script src={{ asset('js/portfolio.js') }}></script>
@endsection
