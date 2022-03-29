@extends('templates/template')

@section('main')
    {{-- //TODO: Cuando haya un usuario registrado habrá que rellenar los campos automáticamente con su nombre --}}
    <h1>{{ __('Checkout') }}</h1>
    @foreach ($cart->products as $product)
        <div>
        <div>{{$product->id}}</div>
        <div>{{$product->price}}</div>
        </div>
        <hr>
    @endforeach
    <p>Subtotal: {{$totalPrice}}</p>
    <form action="" method="POST">
        @csrf 
        <input type="text" name="fullName" placeholder="{{ __('Write your full name') }}" required>
        <input type="text" name="address_line1" placeholder="{{ __('Write your address (first line)') }}" required>
        <input type="text" name="address_line2" placeholder="{{ __('Write your address (second line) (optional)') }}">
        <input type="text" name="phone" placeholder="{{ __('Phone number with international code') }}" required>
        <input type="text" name="postal_code" placeholder={{ __('Postal code') }} required>
        <input type="text" name="postal_code" placeholder={{ __('City') }} required>
        <input type="text" name="postal_code" placeholder={{ __('Province') }} required>
        <input type="text" name="postal_code" placeholder={{ __('Country') }} required>
        <p>{{ __('In the next screen will appear the shipping cost and the final price') }}</p>
        <input type="submit" value="{{ __('Select payment method') }}">
    </form>
 {{-- //TODO: Poner lista de paises, precio del envio --}}
@endsection