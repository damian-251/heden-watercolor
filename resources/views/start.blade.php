@extends('layouts.app')

@section('title')
    Heden Watercolor - {{__('Homepage')}}
@endsection

@section('styles')
@endsection

@section('content')
<div id="carouselExampleControls" class="carousel slide px-5 mx-auto" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('assets/images/carousel/carousel-1.jpg') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/carousel/carousel-2.jpg') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/carousel/carousel-3.jpg') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/carousel/carousel-4.jpg') }}" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="hw-hometext w-75 mx-auto my-5">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vehicula nibh vitae ante consequat, quis bibendum tortor molestie. Quisque aliquet risus ac vestibulum varius. Donec eu augue sagittis, interdum risus sed, aliquam dolor. Integer pharetra elit neque, vel vehicula arcu interdum sed. Phasellus venenatis fermentum pulvinar. Sed vestibulum purus et leo sagittis mattis. Nunc quis leo arcu. Curabitur sed elementum nisl. Cras sit amet volutpat massa, id gravida nulla. Cras condimentum placerat neque eu placerat. Quisque sed enim eget lacus elementum facilisis. Sed posuere feugiat risus nec faucibus. Phasellus ornare metus augue, nec vehicula quam suscipit sed. Nam rutrum pretium ante vel dapibus. Phasellus blandit, risus nec rhoncus euismod, libero tortor fringilla massa, nec accumsan nisl arcu vel nibh. Aliquam sollicitudin mattis lorem vel dapibus. 
</div>
@endsection