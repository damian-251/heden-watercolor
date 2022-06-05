@extends('layouts.app')

@section('title')
    Heden Watercolor - {{__('Payment failed')}}
@endsection

@section('content')
<div class="alert alert-danger m-4 text-center" role="alert">
  <p>{{__('There was a problem with the payment')}}.</p>
  <p>{{__('Plese contact with') . ' ' . config('services.email.admin') . " if the problem continues"}}.</p>
</div>
@endsection