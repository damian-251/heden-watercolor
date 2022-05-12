@extends('layouts.app')

@section('content')

@include('partials.admin-cp-menu')
    <h1 class="text-center my-4">{{__("Create new location")}}</h1>

    @include('partials.messages')

    <form class="w-75 mx-auto" action="{{ route('create-location-p') }}" method="POST">
        @csrf
        <input class="form-control mb-4" type="text" name="location_en" placeholder="Location (English)" required/>
        <input class="form-control mb-4" type="text" name="location_es" placeholder="Localización (Español)"/>
        <input class="form-control mb-4" type="text" name="location_no" placeholder="Beliggenheten (Norsk)"/>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn">{{__('Add location')}}</button>
        </div>
        
    </form>

@endsection