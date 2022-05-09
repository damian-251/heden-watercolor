@extends('layouts.app')

@section('title')
    Heden Watercolor - {{__('Exhibitions')}}
@endsection

@section('styles')
@endsection

@section('content')
<h1 class="text-center mb-3">{{__('Exhibitions')}}</h1>
<div class="d-flex justify-content-center">
    <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=2&bgcolor=%23eae1f8&ctz=Europe%2FMadrid&showNav=1&title=Heden%20Watercolor%20-%20Exhibitions&mode=MONTH&src=cG9tY2E1cGU5cm5hM2llcmIwaXMzbWhoNGdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%23F09300" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
</div>
<h2 class="text-center m-5">{{__('Previous exhibitions')}}</h2>
<div class="container">
    <div class="row mb-5">
  
      <div class="col-md-6">
        <h3>{{__('Example exhibition 1')}}</h3>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora, rem nostrum cupiditate fuga consectetur ea exercitationem sed dicta recusandae et vitae tenetur commodi. Ad saepe, aspernatur totam modi voluptas sint?Iure nam possimus dolores illum quo accusantium qui mollitia voluptas, quis, voluptatem alias nemo reiciendis est sapiente voluptatum vero! Omnis vitae harum voluptatem deserunt. Ducimus maiores assumenda accusantium minima a!
      </div>
  
      <div class="col-md-6">
        <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=Bergen&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://putlocker-is.org"></a><br><style>.mapouter{position:relative;text-align:right;height:400px;width:600px;}</style><a href="https://www.embedgooglemap.net">make google maps responsive</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:600px;}</style></div></div>
      </div>
  
    </div>
    <div class="row mb-5">
  
        <div class="col-md-6">
            <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=Catania&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://putlocker-is.org"></a><br><style>.mapouter{position:relative;text-align:right;height:400px;width:600px;}</style><a href="https://www.embedgooglemap.net">make google maps responsive</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:600px;}</style></div></div>
        </div>
    
        <div class="col-md-6">
            <h3>{{__('Example exhibition 2')}}</h3>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti voluptates animi adipisci laboriosam dolorem, dicta aliquid? Eius omnis doloremque quos temporibus harum! Natus, dolorem. Neque minima inventore aperiam illo doloribus?Nobis, veniam doloribus quasi in quaerat adipisci ab, non quo debitis magni odio necessitatibus eos quibusdam exercitationem dolor saepe esse mollitia excepturi tempore perspiciatis. Ab, asperiores. Quas sequi quaerat ipsa?
        </div>
    
      </div>
  </div>
@endsection