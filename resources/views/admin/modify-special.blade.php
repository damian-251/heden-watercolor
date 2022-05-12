@extends('layouts.app')

@section('content')
@include('partials.admin-cp-menu')
    <h1 class="text-center my-4">{{__("Modify special section")}}</h1>

    @include('partials.messages')



    <select class="w-75 mx-auto mb-4 form-select" name="speciaTag" id="selectTag">
        @foreach ($specialTags as $specialTag)
            <option value="{{$specialTag->id}}">{{$specialTag['tag_translation'][0]['name']}}</option>
        @endforeach
    </select>

    <div class="form-check d-flex justify-content-center">
        <input class="form-check-input" type="checkbox" value="" id="disableSpecial" />
        <label class="form-check-label" for="disableSpecial">{{__('Disable temporary section')}}</label>
    </div>

    <div class="d-flex justify-content-center my-4">
        <button type="submit" class="btn btn-primary btn">{{__('Update')}}</button>
    </div>

@endsection