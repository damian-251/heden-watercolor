@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/user-cp.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('partials.user-menu')
@include('partials.messages')
@include('partials.session-messages')

<h2 class="text-center">{{__('Addresses')}}</h2>
    <div class="row d-flex justify-content-evenly hw-address-container my-5">

    @foreach ($addresses as $address)
    <div class="shadow">
        <div>
            {{__('Name')}}: {{$address->full_name}}
        </div>
        <div>
            {{__('Line')}} 1: {{$address->line1}}
        </div>
        <div>
            {{__('Line')}} 2: {{$address->line2}}
        </div>
        <div>
            {{__('Postal Code')}}: {{$address->postal_code}}
        </div>
        <div>
            {{__('Province')}}: {{$address->province}}
        </div>
        <div>
            {{__('City')}}: {{$address->city}}
        </div>
        <div>
            {{__('Country')}}: {{$address->shipping->country}}
        </div>
        <div>
            {{__('Email')}}: {{$address->email}}
        </div>
        <div>
            {{__('Phone number')}}: {{$address->phone}}
        </div>
        <div class="hw-button-container m-2 d-flex justify-content-center">
            <form method="POST" action="{{ route('user-address-edit') }}">
                @csrf
                <input type="hidden" name="address_id" value="{{$address->id}}">
            <button class="btn btn btn-warning m-2" type="submit">{{__('Edit')}}</button>
            </form>
            <form method="POST" action="{{ route('user-address-delete') }}">
                @method("DELETE")
                @csrf
                <input type="hidden" name="address_id" value="{{$address->id}}">
            <button class="btn btn-danger m-2" type="submit">{{__('Delete')}}</button>
            </form>
        </div>
    </div>
    
        
    @endforeach
    </div>

@endsection