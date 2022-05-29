@extends('layouts.app')

@section('title')
    {{ __('Product details') }}
@endsection

@section('styles')
    <link href="{{ asset('css/product-details.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container p-md-5">
        <div class="row justify-content-center shadow p-4 hw-product-container">

            <div class="col-md-6 hw-product-info">
                <picture class="mb-3">
                    <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
                    <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg">
                    <img class="mb-5" src="{{ asset($product->img_path_jpg) }}" alt="Product image">
                </picture>
                <div class="hw-product-tags my-2">
                    @foreach ($product->tags as $tag)
                        @foreach ($tag->tag_translation as $tag_tr)
                            @if ($tag_tr->language_code == app()->getLocale())
                                <span class="hw-tag-details">{{ $tag_tr->name }}</span>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <div class="hw-product-location my-2">
                    @if ($product->location != null)
                        @foreach ($product->location->location_translation as $location_tr)
                            @if ($location_tr->language_code == app()->getLocale())
                                <span class="hw-location-details">{{ $location_tr->name }}</span>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="hw-colours my-2">
                    @foreach ($product->colours as $colour)
                        @foreach ($colour->colour_translation as $colour_tr)
                            @if ($colour_tr->language_code == app()->getLocale())
                                <span class="hw-colour-details">{{ $colour_tr->name }}</span>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>

            <div class="col-md-6 hw-product-title-info">
                <h2 class="mb-3">{{ $productTr->name }}</h2>
                <p class="h-50">{{ $productTr->description }}</p>
                <p class="hw-product-date"></p>
                <div class="hw-details-date">
                    {{ __('Creation date') }}: {{ $productDate }}
                </div>
                @if ($product->stock > 0)
                    {{-- Si está disponible mostramos las opciones de compra --}}

                    {{-- Si está en idioma noruego mostramos el precio en coronas, si no en € --}}
                    <div class="hw-price d-flex justify-content-center mb-3 fs-3">
                        @if (app()->getLocale() == 'no')
                            {{ $product->price_nok }} NOK
                        @else
                            {{ $product->price_eur }} €
                        @endif
                    </div>

                    <form action="{{ route('add-to-cart') }}" method="POST"
                        class="d-flex justify-content-center align-items-end">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if ($product->reserved != null && \Carbon\Carbon::parse($product->reserved)->gt($currentTime))
                            <button type="button"
                                class="btn btn-danger disabled not-allowed">{{ __('Reserved') }}</button>
                        @else
                            <button class="btn btn-primary" type="submit">{{ __('Add to cart') }}</button>
                        @endif
                    </form>
                @endif
                {{-- Si eres administrador puedes editar y borrar el mismo producto --}}
                @if (auth()->check() && auth()->user()->is_admin)
                    <div class="d-flex justify-content-center">
                        <form action={{ route('delete-product', ['id'=> $product->id]) }} method="POST" class="d-inline m-4">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm boton" type="submit">{{__('Delete')}}</button>
                        </form>
                        <a href={{ route('edit-product', ['id'=> $product->id]) }} class="btn btn-warning btn-sm boton m-4">{{__('Edit')}}</a>
                    </div>
                    
                @endif
            </div>

        </div>
    </div>
@endsection
