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
            <select class="form-select mb-2" aria-label="Country selection">
              <option disabled selected value>{{__('Select an existing address')}}</option>
            </select>
            <input type="text" class="form-control mb-2" id="fullName" placeholder="Full name">
            <input type="tel" class="form-control mb-2" id="telephone" placeholder="Telephone number eg. +4722222222 ">
            <input type="text" class="form-control mb-2" id="firstLine" placeholder="First line">
            <input type="text" class="form-control mb-2" id="secondLine" placeholder="Second line">
            <input type="text" class="form-control mb-2" id="postalCode" placeholder="Postal Code">
            <input type="text" class="form-control mb-2" id="province" placeholder="Province">
            <input type="text" class="form-control mb-2" id="city" placeholder="City">
            <select class="form-select" aria-label="Country selection">
                <option disabled selected value>{{__('Select your country')}}</option>
            </select>
          </div>
      
          <div class="col-md-6">
            <h2>{{__('Order Summary')}}</h2>
          </div>
      
        </div>
        <div class="row ">
            <form action="" method="POST" class="d-flex justify-content-end">
                @csrf
                <button class="btn btn-primary " type="submit">{{__('Review data and pay')}}</button>
            </form>
        </div>
      </div>
    
        

@endsection