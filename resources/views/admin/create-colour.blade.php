@extends('layouts.app')

@section('content')
    <h1>{{__("Create new colour")}}</h1>

    @include('partials.messages')

    <form action="{{ route('create-colour-p') }}" method="POST">
        @csrf
        <input type="text" name="colour_en" placeholder="Colour (English)" required/>
        <input type="text" name="colour_es" placeholder="Color (Español)"/>
        <input type="text" name="colour_no" placeholder="Farge (Norsk)"/>
        <input type="submit" value="{{__('Add colour')}}" />
    </form>

@endsection