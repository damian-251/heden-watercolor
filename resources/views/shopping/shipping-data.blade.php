@extends('layouts.app')

@section('title')
    {{__('Shipping data')}}
@endsection

@section('styles')
<link href="{{ asset('css/shopping-cart.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h1 class="text-center">{{__('Shipping data')}}</h1>
    @include('partials.messages')

    <div class="container">
        <div class="row ">
          <div class="col-md-6">
            <h2>{{__('Address')}}</h2>
            <form action="{{ route('order-review-p') }}" method="POST" >
              @csrf
              @if ($adresses != null)
              <select class="form-select mb-2" id="address" aria-label="Country selection" name="existing_address">
                <option disabled selected value>{{__('Select an existing address')}}</option>
                <option value>{{__('Write a new address')}}</option>
                @foreach ($adresses as $address)
                <option class="existing_address" value="{{$address->id}}" data-country={{$address->shipping->id}}>{{$address->line1 . " " . $address->line2 . " " . $address->postal_code . " " . 
                $address->city . " " . $address->province . " " . $address->city . " "}}</option>
                @endforeach
              </select>
              @endif
            
            <input type="text" name="fullName" class="form-control mb-2 input_address" id="fullName" placeholder="Full name" required>
            <input type="tel" name="telephone" class="form-control mb-2 input_address" id="telephone" placeholder="Telephone number eg. +4722222222 " required>
            <input type="text" name="address1"class="form-control mb-2 input_address" id="firstLine" placeholder="First line" required>
            <input type="text" name="address2" class="form-control mb-2 input_address" id="secondLine" placeholder="Second line" required>
            <input type="text" name="postalCode" class="form-control mb-2 input_address" id="postalCode" placeholder="Postal Code" required>
            <input type="text" name="province" class="form-control mb-2 input_address" id="province" placeholder="Province" required>
            <input type="text" name="city" class="form-control mb-2 input_address" id="city" placeholder="City" required>
            <select class="form-select input_address" id="country" aria-label="Country selection" name="country" required>
                <option disabled selected value="">{{__('Select your country')}}</option>
                @foreach ($countries as $country)
                <option value="{{$country->id}}">{{$country->country}}</option>
                @endforeach
            </select>
          </div>
      
          <div class="col-md-6">
            <h2>{{__('Order Summary')}}</h2>
            <div>
              Subtotal: <span id="subtotal">{{$totalPrice }}</span> {{$currency}}
            </div>
            <div>
              Shipping: <span id="shipping_price"></span> {{$currency}}
            </div>
            <div>
              Total: <span id="total_price">{{$totalPrice}}</span> {{$currency}}
            </div>
          </div>
          <div class="d-flex justify-content-end">
               <button class="btn btn-primary me-3" type="submit">{{__('Review data and pay')}}</button>
       </div>
          </div>
      
  
      </form>
      </div>
    
        
      <script src={{ asset('js/shipping-data.js')}}></script>
@endsection