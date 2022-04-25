<?php 
\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
$session = \Stripe\Checkout\Session::create([
    'line_items' => [[
      'price_data' => [
        'currency' => 'nok',
        'product_data' => [
          'name' => 'Total amount of the order',
        ],
        'unit_amount' => 20000,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://example.com/success',
    'cancel_url' => 'https://example.com/cancel',
  ]);

?>
@extends('layouts.app')

@section('content')
    <button id="checkout-button" type="button" class="btn btn-primary btn-lg">Checkout Test</button>
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