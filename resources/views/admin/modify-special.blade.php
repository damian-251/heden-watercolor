@extends('layouts.app')

@section('content')
@include('partials.admin-cp-menu')
    <h1 class="text-center my-4">{{__("Modify special section")}}</h1>

    @include('partials.messages')


    <form action="{{ route('modify-special-p') }}" method="post">
        @csrf
        <select class="w-75 mx-auto mb-4 form-select" name="specialTag" id="selectTag">
            @foreach ($specialTags as $specialTag)
                @foreach ($specialTag->tag_translation as $translation)
                    @if ($translation->language_code == config('app.default_locale'))
                        <option value="{{$specialTag->id}}">{{$translation->name}}</option>
                    @endif
                @endforeach  
            @endforeach
        </select>
    
        <div class="form-check d-flex justify-content-center">
            <input class="form-check-input" type="checkbox" name="disableSpecial" id="disableSpecial" />
            <label class="form-check-label" for="disableSpecial">{{__('Disable temporary section')}}</label>
        </div>
    
        <div class="d-flex justify-content-center my-4">
            <button type="submit" class="btn btn-primary btn">{{__('Update')}}</button>
        </div>

    </form>


<script src={{ asset('js/temporary-section.js')}}></script>

@endsection