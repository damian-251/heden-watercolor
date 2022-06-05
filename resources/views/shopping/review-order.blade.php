<?php 
        
if (Auth::check()) {
    $userId = Auth::user()->id;
    $sessionId = "";
}else {
    $sessionId = session()->getId();
    $userId = "";
}
/* Comunicación con la pasarela de pago Stripe */
\Stripe\Stripe::setApiKey(config('services.stripe.secret'));
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
    'success_url' => route('payment-successful'), 
    'cancel_url' => route('payment-failed'),
    'payment_intent_data' => [
      'metadata' => ['user_id' => $userId,
                    'session_id' => $sessionId,
                     'address_id' => $addressId, 
                     'addressB_id' => $addressIdB,
                     'shipping_price' => $shippingPrice,
                     'subtotal' => $totalPrice,
                     'final_price' => $finalPrice,
                     'full_address' => $address,
                     'billing_address' => $addressB,
                     'cart' => $products] //Añadimos la iformación de los productos para que estén en stripe
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
      
          <div class="col-12 fs-2 text-center">
             {{$finalPrice . " " . $currency}} 
          </div>
      
          <div class="d-flex justify-content-center my-5">
            <button id="checkout-button" type="button" class="btn btn-primary btn-lg">{{__('Pay order')}}</button>
          </div>
          <div class="text-center">
            {{__('The payment will be processed through the secure payment platform Stripe. This website does not store any payment information')}}.

          </div>
      
        </div>
      </div>
  
      <script src="https://js.stripe.com/v3/"></script>
      <script>
        const stripe = Stripe("{{config('services.stripe.public')}}");
        const btn = document.getElementById('checkout-button');

        btn.addEventListener("click", function(event) {
            event.preventDefault();
            stripe.redirectToCheckout({
                sessionId: "<?php echo $session->id ?>"
            })
        })
    </script>

        
@endsection