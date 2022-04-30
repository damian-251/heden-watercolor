@extends('layouts.app')

@section('content')
@include('partials.user-menu')
<h2 class="text-center">{{__('Order summary')}}</h2>
<div class="container m-5 w-auto">
    @foreach ($orders as $order)
    <div class="row shadow m-3 p-3 w-75 mx-auto d-flex justify-content-center">

        <div class="col-lg-2 col-md-12">

            {{__('Date') , ' '}}<br> {{date('d-m-Y', strtotime($order->created_at));}}
        </div>
    
        <div class="col-lg-2 col-md-12">
            {{__('Subtotal') . " "}} <br> {{$order->subtotal_price}}
        </div>
    
        <div class="col-lg-2 col-md-12">
            {{__('Shipping price') . " "}} <br> {{$order->shipping_price}}
        </div>
    
        <div class="col-lg-2 col-md-12">
            {{__('Total price') . " "}} <br> {{$order->payment->amount/100}}
        </div>

        <div class="col-lg-2 col-md-12">
            {{__('Sent') . " "}} <br> @if ($order->sent)
                {{__('Yes')}}
            @else 
            {{__('No')}}
            @endif
        </div>
    
      </div>

    @endforeach

</div>

@endsection