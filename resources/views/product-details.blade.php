@extends('layouts.app')

@section('title')
    {{__('Product details')}}
@endsection

@section('styles')
<link href="{{ asset('css/product-details.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
  
      <div class="col-md-6">
        <picture>
            <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
            <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg"> 
            <img src="{{ asset($product->img_path_jpg) }}" alt="Product image">
        </picture>
        <div class="hw-product-tags">
            @foreach ($product->tags as $tag)
                @foreach ($tag->tag_translation as $tag_tr)
                    @if ($tag_tr->language_code = app()->getLocale())
                        {{$tag_tr->name}}
                    @endif
                @endforeach
            @endforeach
        </div>
        <div class="hw-product-location">
            @if ($product->location != null)
                @foreach ($product->location->location_translation as $location_tr)
                    @if ($location_tr->language_code == app()->getLocale())
                    {{$location_tr->name}}
                    @endif
                @endforeach
            @endif
        </div>
        <div class="hw-colours">
          @foreach ($product->colours as $colour)
              @foreach ($colour->colour_translation as $colour_tr)
                  @if ($colour_tr->language_code = app()->getLocale())
                      {{$colour_tr->name}}
                  @endif
              @endforeach
          @endforeach
        </div>
      </div>
  
      <div class="col-md-6">
        <h2>{{$productTr->name}}</h2>
        <p>{{$productTr->description}}</p>

        @if ($product->available == true)
            {{-- Si está disponible mostramos las opciones de compra --}}

            {{-- Si está en idioma noruego mostramos el precio en coronas, si no en € --}}
            <span class="hw-price">
            @if (app()->getLocale() == "no")
                {{$product->price_nok}} NOK
            @else
                {{$product->price_eur}} €
            @endif
            </span>

            <form action="">
                <button class="btn btn-primary" type="submit">{{__('Add to cart')}}</button>
            </form>


        @endif
      </div>
  
    </div>
  </div>
@endsection