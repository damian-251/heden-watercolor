@extends('templates/template')

@section('main')
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

            </div>
                
            @endif
            
            
        @endforeach
    @endforeach

    
@endsection