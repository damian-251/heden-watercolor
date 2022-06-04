@extends('layouts.app')

@section('title')
    Heden Watercolor - {{ __('Request Painting') }}
@endsection

@section('styles')
@endsection

@section('content')
    @include('partials.messages')

    <div class="container">
        <h1 class="text-center mb-3">{{__('Request painting')}}</h1>
        <div class="row ">
            
            <div class="col-md-6 p-4">
                
                <div class="mb-4">

                    {{__('You can request a painting from the autor by filling the following form. You can give indications like size or some specifications, you have yo upload a file in which the painting is going to be based.')}}
                </div>
                <picture>
                    <source srcset="{{ asset('assets/images/about/heden-4.webp') }}" type="image/webp">
                    <source srcset="{{ asset('assets/images/about/heden-4.jpg') }}" type="image/jpeg">
                    <img class="w-100" src="{{ asset('assets/images/about/heden-4.jpg') }}" alt="Image of a painting">
                </picture>
            </div>

            <div class="col-md-6 p-4">
                <form action="{{ route('request-email-p') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}*</label>
                        <input name="name" value="{{ old('name') }}" type=" text" class="form-control"
                            placeholder="{{ __('Write your name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Phone number') }}</label>
                        <input name="phone" value="{{ old('phone') }}" type=" text" class="form-control"
                            placeholder="eg +4799999999">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}*</label>
                        <input name="email" value="{{ old('email') }}" type=" email" class="form-control"
                            placeholder="name@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1"
                            class="form-label">{{ __('Write more details about your request') }}*</label>
                        <textarea name="details" class="form-control" rows="3" required>{{ old('details') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">{{ __('Upload an image') }} max. 900KB*</label>
                        <input name="file" class="form-control" type="file" id="formFile"
                            accept="image/png, image/jpeg, image/webp" required>
                    </div>
                    @include('partials.privacy-check')
                    * {{ __('Required fields') }}
                    @include('partials.recaptcha')
                    <div>
                        {{ __('Once sent the request, the author will contact you to settle on the details and set the final price') }}.
                    </div>

                    <div class="d-flex justify-content-center my-5">
                        <button class="btn btn-primary" type="submit">{{ __('Request painting') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
