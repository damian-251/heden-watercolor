@extends('layouts.app')

@section('title')
    {{__('Request Painting')}}
@endsection

@section('styles')
@endsection

@section('content')


<div class="container">
    <div class="row ">
  
      <div class="col-md-6 p-4">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum posuere laoreet dapibus. Praesent malesuada augue turpis, sed porttitor neque porttitor ac. Aenean mollis hendrerit lectus, nec faucibus sem pretium ultrices. Suspendisse egestas lacus in est faucibus viverra. Nullam dapibus sapien eu est suscipit tincidunt. Mauris elementum condimentum augue vel mattis. Phasellus eu laoreet massa. Ut fringilla tellus id placerat suscipit. Sed cursus mi et ultrices porta. Mauris ut malesuada eros. In hac habitasse platea dictumst. Maecenas et nibh vitae neque tincidunt pharetra.

        Quisque id neque eros. Nulla luctus venenatis tellus vel fermentum. Quisque eleifend lobortis ante, quis consectetur ligula sodales ac. Curabitur ac viverra nisi. Etiam et massa at libero dapibus molestie. Curabitur accumsan id risus ac tempor. Aliquam erat volutpat. Donec semper nunc vitae diam molestie, at ornare lacus egestas. Sed massa ante, sagittis ac mauris quis, malesuada tristique dui.
        
        Nulla euismod magna magna, ut elementum elit auctor nec. Vivamus mattis nisi sem, sed hendrerit est venenatis vel. Etiam sit amet auctor tortor. Maecenas posuere laoreet risus vel facilisis. Integer eu quam metus. Praesent massa lectus, commodo id libero sit amet, pulvinar egestas arcu. Nullam varius, nisi non ultrices vestibulum, turpis tortor lacinia justo, ac tincidunt dolor ex vel tellus. Sed id lectus in tellus tempus efficitur. Vivamus a iaculis tortor, sit amet iaculis lacus. Nunc accumsan luctus elit. 
      </div>
  
      <div class="col-md-6 p-4">
        <form action="" method="PUT">
            <div class="mb-3">
                <label for="email" class="form-label">{{__('Email')}}</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">{{__('Write more details about your request')}}</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">{{__('Upload an image')}} max 900KB</label>
                <input class="form-control" type="file" id="formFile"  accept="image/png, image/jpeg, image/webp">
            </div>
        </form>
        <div class="d-flex justify-content-center my-5">
    
            <button class="btn btn-primary" type="submit">{{__('Request painting')}}</button>
        </div>
      </div>
  
    </div>
  </div>

    
@endsection


