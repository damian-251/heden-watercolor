<?php 
        
if (Auth::check()) {
    $userId = Auth::user()->id;
    $sessionId = "";
}else {
    $sessionId = session()->getId();
    $userId = "";
}
/* Comunicación con la pasarela de pago Stripe */
\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
$session = \Stripe\Checkout\Session::create([
    'line_items' => [[
      'price_data' => [
        'currency' => $currencyStripe,
        'product_data' => [
          'name' => 'Total amount of the order',
        ],
        'unit_amount' => $finalPrice*100,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://example.com/success', /* TODO Hay que poner URL propias de la página */
    'cancel_url' => 'https://example.com/cancel',
    'payment_intent_data' => [
      'metadata' => ['user_id' => $userId,
                    'session_id' => $sessionId,
                     'address_id' => $addressId, 
                     'shipping_price' => $shippingPrice,
                     'subtotal' => $totalPrice,
                     'final_price' => $finalPrice ,
                     'full_address' => $address]
    ]
  ]);

?>
@extends('layouts.app')

@section('title')
    {{__('Order review and payment')}}
@endsection

@section('styles')
<link href="{{ asset('css/shopping-cart.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h1 class="text-center">{{__('Order confirmation')}}</h1>
    @include('partials.messages')
    <div class="container">
        <div class="row ">
      
          <div class="col-md-6">
             {{$finalPrice}}
          </div>
      
          <div class="col-md-6">
            <button id="checkout-button" type="button" class="btn btn-primary btn-lg">{{__('Pay order')}}</button>
          </div>
      
        </div>
      </div>
  
      <script src="https://js.stripe.com/v3/"></script>
      <script>
        const stripe = Stripe('pk_test_51Ks3ZJFw94udS3GmAgau8Ds8KAmp0gukBBwLW5fBxsDzOmYsFe1kDLQtmn1hQvREdNGIO0rNcOGtYLS0jqt44Qad00ruYySCaE');
        const btn = document.getElementById('checkout-button');

        btn.addEventListener("click", function(event) {
            event.preventDefault();
            stripe.redirectToCheckout({
                sessionId: "<?php echo $session->id ?>"
            })
        })
    </script>

        
@endsection