@extends('layouts.app')

@section('content')
    <h1>{{__("Create new tag")}}</h1>

    @include('partials.messages')

    <form action="{{ route('create-tag-p') }}" method="POST">
        @csrf
        <input type="text" name="tag_en" placeholder="Tag name (required)" required/>
        <input type="text" name="tag_es" placeholder="Nombre de la etiqueta"/>
        <input type="text" name="tag_no" placeholder="Merkenavn"/>
        <input type="submit" value="{{__("Send")}}" />
    </form>

@endsection