@extends('layouts.app')

@section('content')
@include('partials.user-menu')

<div class="container m-5">
    @foreach ($addresses as $address)
    <div class="row d-flex justify-content-center">
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
        
        
    </div>
    @endforeach

</div>

@endsection