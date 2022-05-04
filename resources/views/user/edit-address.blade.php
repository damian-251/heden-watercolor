@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/user-cp.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('partials.user-menu')
@include('partials.messages')

<h2 class="text-center">{{__('Edit address')}}</h2>
<div class="d-flex justify-content-center">

    <form action="{{ route('user-address-edit-p') }}" method="POST" class="w-50">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="fullName" class="form-label">{{__('Full name')}}</label>
            <input name="fullName" type="text" class="form-control" id="fullName" placeholder="{{__('Write your full name')}}" value="{{$address->full_name}}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">{{__('Phone number')}}</label>
            <input name="phone" type="text" class="form-control" id="phone" placeholder="{{__('Phone number with international prfix')}}" value="{{$address->phone}}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{__('Email')}}</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="{{__('email@example.com')}}" value="{{$address->email}}" required>
        </div>
        <div class="mb-3">
            <label for="line1" class="form-label">{{__('Address line1')}}</label>
            <input name="line1" type="text" class="form-control" id="line1" placeholder="{{__('First line of your address')}}" value="{{$address->line1}}" required>
        </div>
        <div class="mb-3">
            <label for="line2" class="form-label">{{__('Address line2')}}</label>
            <input name="line2"  type="text" class="form-control" id="line2" placeholder="{{__('Second line of your address')}}" value="{{$address->line2}}">
        </div>
        <div class="mb-3">
            <label for="postalCode" class="form-label">{{__('Postal Code')}}</label>
            <input name="postalCode" type="text" class="form-control" id="postalCode" placeholder="{{__('Postal code')}}" value="{{$address->postal_code}}" required>
        </div>
        <div class="mb-3">
            <label for="province" class="form-label">{{__('Province')}}</label>
            <input name="province" type="text" class="form-control" id="province" placeholder="{{__('Province')}}" value="{{$address->province}}" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">{{__('City')}}</label>
            <input name="city" type="text" class="form-control" id="city" placeholder="{{__('City')}}" value="{{$address->city}}" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">{{__('Country')}}</label>
            <select class="form-select input_address" id="country" aria-label="Country selection" name="country" required>
                <option disabled selected value="">{{__('Select your country')}}</option>
                @foreach ($countries as $country)
                <option value="{{$country->id}}">{{$country->country}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="address_id" value="{{$address->id}}">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">{{__('Update address')}}</button>
        </div>
    </form>
</div>

@endsection