@extends('layouts.app')

@section('title')
    {{__('Shop')}}
@endsection

@section('styles')
<link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
@endsection

@section('content')

@include('partials.messages')

<div class="hw-product-container">
    @foreach ($products as $product)
    <div class="hw-product-box">
        <a href="{{ route('product-details', ['id'=>$product->id]) }}">
            <div class="hw-div-product">
                <picture>
                <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
                <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg"> 
                <img src="{{ asset($product->img_path_jpg) }}" alt="Product image">
                </picture>
            </div>
        </a>
        <div class="hw-data-container">
            <span class="hw-price">
                @if (app()->getLocale() == "no")
                    {{$product->price_nok}} NOK
                @else
                    {{$product->price_eur}} €
                @endif
                </span>
            <form action="{{ route('add-to-cart')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <button class="btn btn-primary" type="submit">{{__('Add to cart')}}</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<script src={{ asset('js/portfolio.js')}}></script>
@endsection