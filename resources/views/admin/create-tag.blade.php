@extends('layouts.app')

@section('content')
@include('partials.admin-cp-menu')

    <h1 class="my-4 text-center">{{__("Create new tag")}}</h1>

    @include('partials.messages')

    <form class="w-75 mx-auto" action="{{ route('create-tag-p') }}" method="POST">
        @csrf
        <input class="form-control mb-4" type="text" name="tag_en" placeholder="Tag name (required)" required/>
        <input class="form-control mb-4" type="text" name="tag_es" placeholder="Nombre de la etiqueta"/>
        <input class="form-control mb-4" type="text" name="tag_no" placeholder="Merkenavn"/>
        <label><input  type="checkbox" name="isSpecial" value="true">{{__('Special tag')}}</label>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn">{{__('Add tag')}}</button>
        </div>
    </form>

@endsection