@extends('layouts.app')

@section('title')
    Heden Watercolor - {{ __('Homepage') }}
@endsection


@section('styles')
@endsection

@section('content')
    @include('partials.messages')
    <div id="carouselExampleControls" class="carousel slide px-5 mx-auto" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
              <picture>
                <source srcset="{{ asset('assets/images/carousel/carousel-1.webp') }}" type="image/webp">
                <source srcset="{{ asset('assets/images/carousel/carousel-1.jpg') }}" type="image/jpeg">
                  <img src="{{ asset('assets/images/carousel/carousel-1.jpg') }}" class="d-block w-100" alt="Carousel image 1">
              </picture>
               
            </div>
            <div class="carousel-item">
              <picture>
                <source srcset="{{ asset('assets/images/carousel/carousel-2.webp') }}" type="image/webp">
                <source srcset="{{ asset('assets/images/carousel/carousel-2.jpg') }}" type="image/jpeg">
                  <img src="{{ asset('assets/images/carousel/carousel-2.jpg') }}" class="d-block w-100" alt="Carousel image 2">
              </picture>
            </div>
            <div class="carousel-item">
              <picture>
                <source srcset="{{ asset('assets/images/carousel/carousel-3.webp') }}" type="image/webp">
                <source srcset="{{ asset('assets/images/carousel/carousel-3.jpg') }}" type="image/jpeg">
                  <img src="{{ asset('assets/images/carousel/carousel-3.jpg') }}" class="d-block w-100" alt="Carousel image 3">
              </picture>
            </div>
            <div class="carousel-item">
              <picture>
                <source srcset="{{ asset('assets/images/carousel/carousel-4.webp') }}" type="image/webp">
                <source srcset="{{ asset('assets/images/carousel/carousel-4.jpg') }}" type="image/jpeg">
                  <img src="{{ asset('assets/images/carousel/carousel-4.jpg') }}" class="d-block w-100" alt="Carousel image 4">
              </picture>
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
        <p>
            {{ __('I like unexpected results; something that surprise you and force you to rethink your work. That is why I chose watercolor as a form of my artistic expression. Any other technique allows to control the pigment in the work process. In watercolor, you never control what happens when color meets water. You just have to be a witness and enter the game.') }}
        </p>
        <p>
            {{ __('My themes are recurrent. Forest, sea, loneliness, restlessness.. My watercolors have a mysterious atmosphere') }}

        </p>
        <p>
            {{ __('My sources of inspiration are the land of my childhood, the harsh and hot South, with its stories of violence and its fascinating beauty, and the orderly North, with the anguish that is superimposed on the almost tragic beauty of its landscapes.') }}
        </p>
        <p>

            {{ __('I love the South, the South is me. I don\'t love the North. Its not me. But both are part of my work. My watercolors cannot be understood without the presence of both.') }}
        </p>
    </div>
@endsection
