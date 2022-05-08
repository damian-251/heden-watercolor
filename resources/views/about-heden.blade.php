@extends('layouts.app')

@section('title')
    Heden Watercolor - {{__('About')}}
@endsection

@section('styles')
@endsection

@section('content')
<div class="container my-3">
    <div class="row">
  
      <div class="col-md-6" >
          <div class="d-flex justify-content-center mb-3">

              <iframe width="400" height="711" src="https://www.youtube.com/embed/ofP9ZtEDZR0?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
      </div>
  
      <div class="col-md-6 my-auto">
          <div>

              Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur necessitatibus ullam aliquam. Illo explicabo molestias ipsum aliquid veritatis. Quibusdam saepe cumque voluptatem quod temporibus asperiores soluta inventore ipsam corporis dignissimos!
              Amet animi magni dolorem rerum, voluptas ipsa officia deleniti nemo quasi numquam velit quisquam, ab quibusdam consectetur explicabo qui reprehenderit ex ipsum beatae optio. Eos, consectetur? Illum, sequi? Repellendus, cum.
              Tenetur tempora ipsum minima voluptatem qui vero atque iste incidunt iure aliquam eaque voluptatum sunt delectus officiis aut, ex quod perferendis expedita porro voluptas deleniti deserunt eos ratione. Corrupti, sunt.
              Commodi nesciunt sint laborum. Ab libero nihil autem sint magnam, vel quae facere vero velit iste provident rem labore inventore, placeat fugit laudantium excepturi, beatae earum culpa porro asperiores ipsa.
          </div>
      </div>
  
    </div>
    <div class="row ">
  
        <div class="col-md-6 my-auto">
            <div>

                Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur necessitatibus ullam aliquam. Illo explicabo molestias ipsum aliquid veritatis. Quibusdam saepe cumque voluptatem quod temporibus asperiores soluta inventore ipsam corporis dignissimos!
                Amet animi magni dolorem rerum, voluptas ipsa officia deleniti nemo quasi numquam velit quisquam, ab quibusdam consectetur explicabo qui reprehenderit ex ipsum beatae optio. Eos, consectetur? Illum, sequi? Repellendus, cum.
                Tenetur tempora ipsum minima voluptatem qui vero atque iste incidunt iure aliquam eaque voluptatum sunt delectus officiis aut, ex quod perferendis expedita porro voluptas deleniti deserunt eos ratione. Corrupti, sunt.
                Commodi nesciunt sint laborum. Ab libero nihil autem sint magnam, vel quae facere vero velit iste provident rem labore inventore, placeat fugit laudantium excepturi, beatae earum culpa porro asperiores ipsa.
            </div>
        </div>
    
        <div class="col-md-6 mx-auto">
            <img src="{{ asset('assets/images/about/heden-2.jpg') }}" class="d-block w-75 p-3 m-auto" alt="...">
        </div>
    
      </div>
      <div class="row ">
  
        <div class="col-md-6 mx-auto">
            <img src="{{ asset('assets/images/about/heden-1.jpg') }}" class="d-block w-75 p-3 m-auto" alt="...">
        </div>
    
        <div class="col-md-6 my-auto">
            <div>

                Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur necessitatibus ullam aliquam. Illo explicabo molestias ipsum aliquid veritatis. Quibusdam saepe cumque voluptatem quod temporibus asperiores soluta inventore ipsam corporis dignissimos!
                Amet animi magni dolorem rerum, voluptas ipsa officia deleniti nemo quasi numquam velit quisquam, ab quibusdam consectetur explicabo qui reprehenderit ex ipsum beatae optio. Eos, consectetur? Illum, sequi? Repellendus, cum.
                Tenetur tempora ipsum minima voluptatem qui vero atque iste incidunt iure aliquam eaque voluptatum sunt delectus officiis aut, ex quod perferendis expedita porro voluptas deleniti deserunt eos ratione. Corrupti, sunt.
                Commodi nesciunt sint laborum. Ab libero nihil autem sint magnam, vel quae facere vero velit iste provident rem labore inventore, placeat fugit laudantium excepturi, beatae earum culpa porro asperiores ipsa.
            </div>
        </div>
    
      </div>
  </div>
@endsection