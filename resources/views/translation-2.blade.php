@extends('templates/template')

@section('main')
    <div class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                @include('partials/language_switcher')
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <h1>{{ __('Welcome to our website') }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

