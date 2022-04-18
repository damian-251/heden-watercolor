@extends('layouts.app')

@section('content')
    <h1>This is a test for the database</h1>
    <h2>Lista de productos</h2>
    @foreach ($products as $product)
        {{__('Product')}} {{$product->id}}

        <picture>
        <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
        <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg"> 
        <img src="{{ asset($product->img_path_jpg) }}" alt="Product image">
        </picture>
          
        @foreach ($product->product_translation as $translation)

            @if ($translation->language_code == $language)
            <div>

                {{ __('Title') }}: {{$translation->name}} 
                {{ __('Description') }}: {{$translation->description}}
                <form action="{{ route('cart.add')}}" method="POST" >
                    @csrf {{--Token que generamos --}}
                    {{-- Enviamos como request el id del producto como campo oculto --}}
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="submit" value="Add product">
                </form>

            </div>
                
            @endif
            
            
        @endforeach
    @endforeach

    
@endsection