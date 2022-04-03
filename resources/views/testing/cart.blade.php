@extends('layouts.app')

@section('content')
    <h1>Cesta de la compra test</h1>

    @foreach ($cart->products as $product)
        <div>
        <div>{{$product->id}}</div>
        <div>{{$product->price}}</div>
        </div>
        <hr>
    @endforeach
    <p>Subtotal: {{$totalPrice}}</p>
    <div>
        <form action="{{ route('test.checkout')}}" method="POST">
            @csrf
            <input type="submit" value="{{ __('Checkout') }}">
        </form>
    </div>
@endsection

