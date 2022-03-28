@extends('templates/template')

@section('main')
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
        <form action="" method="POST">
            @csrf
            <input type="hidden" name="cart_id" value="{{$cart->id}}">
            <input type="submit" value="{{ __('Checkout') }}">
        </form>
    </div>
@endsection

