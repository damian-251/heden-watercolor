@extends('templates/template')

@section('main')
<h1>{{ __('Finishing...') }}</h1>
@foreach ($cart->products as $product)
    <div>
    <div>{{$product->id}}</div>
    <div>{{$product->price}}</div>
    </div>
    <hr>
@endforeach
<h2>{{ __('Subtotal') }}</h2>
{{$totalPrice}}
<h2>{{ __('Shipping Price') }}</h2>
{{$shippingEur}}
<h2>{{ __('Total') }}</h2>
{{$finalPrice}}€

<form action="{{ route('testing.paynow')}}" method="post">
     @csrf
    <input type="submit" value="{{ __('Pay now') }}"></form>
</form>

@endsection