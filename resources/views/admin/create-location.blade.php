@extends('layouts.app')

@section('content')
    <h1>{{__("Create new location")}}</h1>

    @include('partials.messages')

    <form action="{{ route('create-location-p') }}" method="POST">
        @csrf
        <input type="text" name="location_en" placeholder="Location (English)" required/>
        <input type="text" name="location_es" placeholder="Localización (Español)"/>
        <input type="text" name="location_no" placeholder="Beliggenheten (Norsk)"/>
        <input type="submit" value="{{__('Add location')}}" />
    </form>

@endsection