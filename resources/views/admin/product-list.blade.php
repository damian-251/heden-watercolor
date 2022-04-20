@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/product-list.css') }}" rel="stylesheet">
@endsection

@section('content')

@include('partials.messages')

<div class="container">
    @foreach ($products as $product)
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <picture>
                <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
                <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg"> 
                <img src="{{ asset($product->img_path_jpg) }}" alt="Product image">
            </picture>
        </div>
    
        <div class="col-lg-4 col-md-6">
            @foreach ($product->product_translation as $productTr)
                @if ($productTr->language_code == app()->getLocale())
                    {{$productTr->name}}
                @endif
            @endforeach
        </div>

        <div class="col-lg-4 col-md-6">
            <form action={{ route('delete-product', ['id'=> $product->id]) }} method="POST" class="d-inline">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger btn-sm boton" type="submit">{{__('Delete')}}</button>
            </form>
            <a href={{ route('edit-product', ['id'=> $product->id]) }} class="btn btn-warning btn-sm boton">{{__('Edit')}}</a>
        </div>
      </div>
        
    @endforeach

  </div>
@endsection