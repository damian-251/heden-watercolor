@extends('layouts.app')

@section('content')
    <h1>This is a test for the database</h1>
    <h2>Lista de productos</h2>
    @foreach ($products as $product)
        {{__('Product')}} {{$product->id}}
        <img src="{{ asset('assets/images/'. $product->id . '-watercolor.jpg') }}">
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