@extends('layouts.app')

@section('content')
    @include('partials.admin-cp-menu')

    <h1 class="text-center m-4">{{ __('Edit product') }}</h1>

    {{-- Mensajes de error o de éxito que puedan haber en el proceso --}}
    @include('partials.messages')

    <form class="w-75 mx-auto" action="{{ route('edit-product-p', ['id' => $product->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">English</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Spanish</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">Norwegian</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="english-tab">
                {{-- Título de la obra --}}
                <h2 class="text-center m-4">{{ __('Title') }}</h2>
                <input class="form-control" type="text" name="title_en" id="title_en" placeholder="English title"
                    value="{{ $productEn->name }}" required>

                {{-- Descripción de la obra --}}
                <h2 class="text-center m-4">{{ __('Description') }}</h2>
                <textarea class="form-control" name="description_en" id="description_en" cols="30" rows="10"
                    placeholder="English description" required>{{ $productEn->description }}</textarea>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="spanish-tab">
                {{-- Título de la obra --}}
                <h2 class="text-center m-4">{{ __('Title') }}</h2>
                <input class="form-control" type="text" name="title_es" id="title_es" placeholder="Spanish title"
                    value="{{ $productEs->name }}">

                {{-- Descripción de la obra --}}
                <h2 class="text-center m-4">{{ __('Description') }}</h2>

                <textarea class="form-control" name="description_es" id="description_es" cols="30" rows="10"
                    placeholder="Spanish description">{{ $productEs->description }}</textarea>

            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="norwegian-tab">
                {{-- Título de la obra --}}
                <h2 class="text-center m-4">{{ __('Title') }}</h2>
                <input value="{{ $productNo->name }}" class=" form-control" type="text" name="title_no" id="title_no"
                    placeholder="Norwegian title">

                {{-- Descripción de la obra --}}
                <h2 class="text-center m-4">{{ __('Description') }}</h2>

                <textarea class="form-control" name="description_no" id="description_no" cols="30" rows="10"
                    placeholder="Norwegian description">{{ $productNo->description }}</textarea>

            </div>
        </div>


        {{-- Etiquetas de la obra --}}

        <h2 class="text-center m-4">{{ __('Colours') }}</h2>
        <div class="hw-product-colours d-flex justify-content-between form-check">

            @foreach ($colours as $colour)
                @foreach ($colour->colour_translation as $colourTr)
                    @if ($colourTr->language_code == 'en')
                        <label class="m-2 form-check-label">
                            <input type="checkbox" name="colours[]" id="{{ $colour->id }}" value="{{ $colour->id }}"
                                class="form-check-input"
                                @foreach ($product->colours as $productColour) @if ($productColour->id == $colour->id)
                                checked @endif
                                @endforeach
                            >
                            {{ $colourTr->name }}</label>
                    @endif
                @endforeach
            @endforeach
        </div>

        <h2 class="text-center m-4">{{ __('Tags') }}</h2>
        <div class="hw-product-tags d-flex justify-content-between form-check">
            @foreach ($tags as $tag)
                @foreach ($tag->tag_translation as $tagTr)
                    @if ($tagTr->language_code == 'en')
                        <label class="form-check-label"><input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                id="{{ $tag->id }}" class="form-check-input"
                                @foreach ($product->tags as $productTag) @if ($productTag->id == $tag->id)
                                checked @endif
                                @endforeach
                            >
                            {{ $tagTr->name }}</label>
                    @endif
                @endforeach
            @endforeach

        </div>

        <h2 class="text-center m-4">{{ __('Special tags') }}</h2>
        <div class="hw-product-tags d-flex justify-content-between form-check">
            @foreach ($specialTags as $tag)
                @foreach ($tag->tag_translation as $tagTr)
                    @if ($tagTr->language_code == 'en')
                        <label class="form-check-label"><input class="form-check-input" type="checkbox" name="specialTags[]"
                                value="{{ $tag->id }}" id="{{ $tag->id }}">
                            {{ $tagTr->name }}</label>
                    @endif
                @endforeach
            @endforeach
        </div>

        <h2 class="text-center m-4">{{ __('Location') }}</h2>
        <div class="hw-product-location d-flex justify-content-between form-check-inline">
            @foreach ($locations as $location)
                @foreach ($location->location_translation as $locationTr)
                    @if ($locationTr->language_code == 'en')
                        <label class="form-label" for="{{ $location->id }}">
                            <input type="radio" id="{{ $location->id }}" name="location" class="form-input"
                                value="{{ $location->id }}" @if ($product->location_id == $location->id) checked @endif>
                            {{ $locationTr->name }}</label>
                    @endif
                @endforeach
            @endforeach
            <label class="form-label" for="no_location">
                <input type="radio" id="no_location" name="location" value="no_location"
                    class="form-input">{{ __('Unspecified') }}</label>

        </div>

        <h2 class="text-center m-4">{{ __('Price') }}</h2>
        <p class="text-center">{{ __('0 or blank if the product is not for sale') }}</p>
        <input type="number" class="form-control  mb-4" name="price_eur" value="{{ $product->price_eur }}" id="price_eur"
            step=".01" placeholder="Price in €" min="0" required>
        <input type="number" class="form-control mb-4" name="price_nok" value="{{ $product->price_nok }}" id="price_nok"
            placeholder="Price en NOK" min="0" required>


        <h2 class="text-center m-4">{{ __('Stock') }}</h2>
        <input type="number" class="form-control mb-4" name="stock" value="{{ $product->stock }}" id="stock"
            placeholder="{{ __('Units in stock') }}" min="0" required>

        <h2 class="text-center m-4">{{ __('Dimensions') }}</h2>
        <input value="{{ $product->width }}" class="form-control mb-4" type="number" name="width" id="width"
            placeholder="Width in cm" required>
        <input value="{{ $product->height }}" class="form-control mb-4" type="number" name="height" id="height"
            placeholder="Height in cm" required>

        <h2 class="text-center m-4">{{ __('Creation date') }}</h2>
        <input class="form-control" type="date" name="creation_date" id="creation_date"
            value="{{ $product->creation_date }}">

        <h2 class="text-center m-4">{{ __('Upload images') }}</h2>
        <p class="text-center">{{ __('Don\'t upload any image if you want to keep de current image') }}</p>
        <div class="d-flex justify-content-around">
            <label><input class="form-control" type="file" name="image_jpg" placeholder="Image in JPG" accept=".jpg"
                    > Image in JPG (max 200KB)</label>
            {{-- Por defecto la imagen se mostrará en webp y si no es compatible o no está disponible será en jpg --}}
            <label><input class="form-control" type="file" name="image_webp" placeholder="Image in WEBP" accept=".webp">
                Image in WEBP (max 100KB)</label>

        </div>

        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="d-flex justify-content-center my-5">
            <button class="btn btn-primary" type="submit">{{ __('Update product') }}</button>
        </div>
    </form>
@endsection
