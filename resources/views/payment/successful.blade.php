@extends('layouts.app')

@section('title')
    Heden Watercolor - {{__('Payment successful')}}
@endsection

@section('content')
<div class="alert alert-success m-4 text-center" role="alert">
  <p>{{__('The order has been completed. You will recieve an email with
  the order details in the email provided in Stripe, once the order is sent you will also recieve a 
  confirmation email')}}.</p>
  <p>{{__('If you have any problem or you want more information please
  contact with') . ' ' . config('services.email.admin')}}.</p>
</div>
@endsection