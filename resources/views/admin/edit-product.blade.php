@extends('layouts.app')
{{-- Usamos un formulario similar al que usamos para crear un producto --}}
@section('content')
<h1>{{__("Edit product")}}</h1>

{{-- Mensajes de error o de éxito que puedan haber en el proceso --}}
@include('partials.messages')

<picture>
    <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
    <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg"> 
    <img src="{{ asset($product->img_path_jpg) }}" alt="Product image">
</picture>

<form action="{{ route('edit-product-p', ['id'=> $product->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    {{--Título de la obra --}}
    <h2>{{__('Title')}}</h2>
    <input type="text" name="title_en" id="title_en" required value="{{$productEn->name}}">
    <input type="text" name="title_es" id="title_es" value="{{$productEs->name}}">
    <input type="text" name="title_no" id="title_no" value="{{$productNo->name}}">

    {{-- Descripción de la obra --}}
    <h2>{{__('Description')}}</h2>
    <textarea name="description_en" id="description_en" cols="30" rows="10" required>{{$productEn->description}}</textarea>
    <textarea name="description_es" id="description_es" cols="30" rows="10">{{$productEs->description}}</textarea>
    <textarea name="description_no" id="description_no" cols="30" rows="10">{{$productNo->description}}</textarea>

    {{-- Etiquetas de la obra --}}

    <h2>{{__('Colours')}}</h2>
    @foreach ($colours as $colour)
        @foreach ($colour->colour_translation as $colourTr)
            @if ($colourTr->language_code == 'en')
                <label>
                    <input 
                    type="checkbox" 
                    name="colours[]" 
                    id="{{$colour->id}}"
                    value="{{$colour->id}}" 
                    @foreach ($product->colours as $productColour)
                        @if ($productColour->id == $colour->id)
                            checked
                        @endif
                    @endforeach
                    >
            @endif
        @endforeach
        {{$colourTr->name}}</label>
    @endforeach

    <h2>{{__('Tags')}}</h2>
    @foreach ($tags as $tag)
        @foreach ($tag->tag_translation as $tagTr)
            @if ($tagTr->language_code == 'en')
                <label><input 
                    type="checkbox" 
                    name="tags[]" value="{{$tag->id}}" 
                    id="{{$tag->id}}"
                    @foreach ($product->tags as $productTag)
                        @if ($productTag->id ==  $tag->id)
                            checked
                        @endif
                    @endforeach
                    >
                    {{$tagTr->name}}</label>
            @endif
        @endforeach
    @endforeach

    <h2>{{__('Special tags')}}</h2>
    @foreach ($specialTags as $tag)
        @foreach ($tag->tag_translation as $tagTr)
            @if ($tagTr->language_code == 'en')
                <label><input 
                    type="checkbox" 
                    name="specialTags[]" 
                    value="{{$tag->id}}" 
                    id="{{$tag->id}}">
                    {{$tagTr->name}}</label>
            @endif
        @endforeach
    @endforeach

    <h2>{{__('Location')}}</h2>
    @foreach ($locations as $location)
        @foreach ($location->location_translation as $locationTr)
            @if ($locationTr->language_code == "en")
            <label for="{{$location->id}}">
                <input 
                type="radio" 
                id="{{$location->id}}" 
                name="location" 
                value="{{$location->id}}"
                    @if ($product->location_id == $location->id)
                        checked
                    @endif
                >
                {{$locationTr->name}}</label>          
            @endif
        @endforeach
    @endforeach
    <label for="no_location">
        <input 
        type="radio" 
        id="no_location" 
        name="location" 
        value="no_location" 
        >{{__('Unspecified')}}</label>

    <h2>{{__('Price')}}</h2>
    <p>{{__('0 or blank in both fields if the product is not for sale')}}</p>
    <input type="number" name="price_eur" id="price_eur" step=".01" placeholder="Price in €" min="0" value="{{$product->price_eur}}"required>
    <input type="number" name="price_nok" id="price_nok" placeholder="Price en NOK" min="0" value="{{$product->price_nok}}" required> 

    <h2>{{__('Dimensions')}}</h2>
    <input type="number" name="width" id="width" placeholder="Width in cm" value="{{$product->width}}" required>
    <input type="number" name="height" id="height"  placeholder="Height in cm" value="{{$product->height}}" required>

    <h2>{{__('Creation date')}}</h2>
    <input type="date" name="creation_date" id="creation_date" value="{{$product->creation_date}}">

    <h2>{{__('Upload images')}}</h2>
    <p>{{__('Don\'t upload any image if you want to keep de current image')}}</p>
    <label><input type="file"  name="image_jpg"  placeholder="Image in JPG" accept=".jpg" > Image in JPG (max 200KB)</label>
    {{-- Por defecto la imagen se mostrará en webp y si no es compatible o no está disponible será en jpg --}}
    <label><input type="file"  name="image_webp"  placeholder="Image in WEBP" accept=".webp" > Image in WEBP (max 100KB)</label>

    <br>
    <input type="hidden" name="id" value="{{$product->id}}">
    <input type="submit" value="{{__("Update product")}}" />
</form>
@endsection