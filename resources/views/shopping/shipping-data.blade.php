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
            {{-- Si no está registrado pedimos algún documento de identificación --}}
            @if (!auth()->check())
            <input type="text" name="identificationNumber" class="form-control mb-2 input_address" id="identificationNumber" placeholder="Identification number">                
            @endif
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
            <h2 class="text-center mb-5">{{__('Order Summary')}}</h2>
            <div class="container shadow w-75 p-4 mx-auto">
              <div class="row">
                <div class="col-md-6 fs-2">
                  {{__('Subtotal')}}
                </div>
                <div class="col-md-6 fs-2">
                  <span id="subtotal" class="fs-2">{{$totalPrice }}</span> {{$currency}}
                </div>
              </div>
              <div class="row ">
            
                <div class="col-md-6 fs-2">
                  {{__('Shipping')}}
                </div>
            
                <div class="col-md-6 fs-2">
                  <span id="shipping_price" class="fs-2"></span> {{$currency}}
                </div>
          
              </div>
              <div class="row ">
            
                <div class="col-md-6 fs-2">
                  {{__('Total')}}
                </div>
            
                <div class="col-md-6 fs-2">
                  <span id="total_price" class="fs-2">{{$totalPrice}}</span> {{$currency}}
                </div>
      
              </div>
            </div>
          </div>
          <div class="form-check  m-3">
            <input class="form-check-input" type="checkbox" id="billingCheck"  name="billingCheck">
            <label class="form-check-label" for="billingCheck">{{__('Use a different billing address')}}</label>
          </div>

          <div class="col-md-6 " style="display:none;" id="billing-address">
            <input type="text" name="fullNameB" class="form-control mb-2 input_addressB" id="fullNameB" placeholder="Full name">
            <input type="tel" name="telephoneB" class="form-control mb-2 input_addressB" id="telephoneB" placeholder="Telephone number eg. +4722222222 ">
            @if (!auth()->check())
            <input type="text" name="identificationNumberB" class="form-control mb-2 input_address" id="identificationNumberB" placeholder="Identification number">
                
            @endif
            <input type="text" name="address1B"class="form-control mb-2 input_addressB" id="firstLineB" placeholder="First line">
            <input type="text" name="address2B" class="form-control mb-2 input_addressB" id="secondLineB" placeholder="Second line">
            <input type="text" name="postalCodeB" class="form-control mb-2 input_addressB" id="postalCodeB" placeholder="Postal Code">
            <input type="text" name="provinceB" class="form-control mb-2 input_addressB" id="provinceB" placeholder="Province">
            <input type="text" name="cityB" class="form-control mb-2 input_addressB" id="cityB" placeholder="City">
            <select class="form-select input_addressB" id="country" aria-label="Country selection" name="countryB">
                <option disabled selected value="">{{__('Select your country')}}</option>
                @foreach ($countries as $country)
                <option value="{{$country->id}}">{{$country->country}}</option>
                @endforeach
            </select>
          </div>
          

          <div class="d-flex justify-content-center">
               <button class="btn btn-primary me-3 mt-4" type="submit">{{__('Review data and pay')}}</button>
          </div>
          </div>

          
      
  
      </form>
      </div>
    
        
      <script src={{ asset('js/shipping-data.js')}}></script>
@endsection