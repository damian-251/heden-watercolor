@extends('layouts.app')

@section('content')
@include('partials.admin-cp-menu')
    <h1 class="text-center my-4">{{__("Create new colour")}}</h1>

    @include('partials.messages')

    <form class="w-75 mx-auto" action="{{ route('create-colour-p') }}" method="POST">
        @csrf
        <input class="form-control  mb-4" type="text" name="colour_en" placeholder="Colour (English)" required/>
        <input class="form-control  mb-4" type="text" name="colour_es" placeholder="Color (Español)"/>
        <input class="form-control  mb-4" type="text" name="colour_no" placeholder="Farge (Norsk)"/>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn">{{__('Add colour')}}</button>
        </div>
    </form>

@endsection