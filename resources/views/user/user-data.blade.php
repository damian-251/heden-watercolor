@extends('layouts.app')

@section('content')
@include('partials.user-menu')

<div class="container w-50 d-flex justify-content-center">
    <div class="row my-3">
  
      <div class="col-md-6">
        {{__('Name')}}
      </div>
  
      <div class="col-md-6">
        {{$user->name}}
      </div>
      <div class="col-md-6">
  
    </div>

    <div class="row my-3">

        <div class="col-md-6">
            {{__('Email Address')}}
        </div>
    
        <div class="col-md-6">
            {{$user->email}}
        </div>
    
      </div>

  
</div>

@endsection