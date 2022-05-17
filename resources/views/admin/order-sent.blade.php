@extends('layouts.app')

@section('styles')
    {{-- <link href="{{ asset('css/shopping-cart.css') }}" rel="stylesheet"> --}}

    <style>
        img {
            width: 100%;
        }

    </style>
@endsection

@section('content')
    @include('partials.admin-cp-menu')
    @include('partials.messages')

    <h1 class="text-center my-4">{{ __('Mark orders as sent') }}</h1>

    <div class="container">
        @foreach ($orders as $order)
            <div class="row my-3 mx-3 shadow p-3">
                <div class="col-lg-4 col-md-12">
                    <div>
                        {{ $order->created_at }}
                    </div>
                    <div>
                        <div>{{ $order->address->full_name }}</div>
                        <div>{{ $order->address->identification }}</div>
                        <div> {{ $order->address->line1 }}</div>
                        <div> {{ $order->address->line2 }}</div>
                        <div> {{ $order->address->postal_code }}</div>
                        <div> {{ $order->address->city }}</div>
                        <div>{{ $order->address->province }}</div>
                        <div>{{ $order->address->email }}</div>
                        <div>{{ $order->address->phone }}</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="container">
                        @foreach ($order->products as $product)
                            <div class="row my-2">
                                <div class="col-lg-4 col-md-12">
                                    <picture>
                                        <source srcset="{{ asset($product->img_path_webp) }}" type="image/webp">
                                        <source srcset="{{ asset($product->img_path_jpg) }}" type="image/jpeg">
                                        <img src="{{ asset($product->img_path_jpg) }}" alt="Product image">
                                    </picture>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    {{ $product->sku }}

                                </div>

                                <div class="col-lg-4 col-md-6">
                                    {{ $product->product_translation[0]->name }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <form action="{{ route('order-sent-p')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="comment">{{ __('Comment') }}:</label>
                            <textarea name="comment" class="form-control" rows="5" id="comment"></textarea>
                        </div>
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary my-3" type="submit">{{ __('Mark as sent') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

    </div>
@endsection
