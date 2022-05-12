@extends('layouts.app')

@section('content')
@include('partials.admin-cp-menu')
@include('partials.messages') {{-- Aquí incluimos los mensajes de éxito y de error --}}

<h1 class="text-center my-4">{{__("Edit location")}}</h1>


<select class="w-75 mx-auto mb-4 form-select" name="location" id="selectLocation">
    @foreach ($locations as $location)
        @foreach ($location->location_translation as $LocationTr)
            {{-- Mostramos solo el nombre en inglés que es el obligatorio--}}
            @if ($LocationTr->language_code == 'en')
                <option value="{{$location->id}}">{{$LocationTr->name}}</option>
            @endif
        @endforeach
    @endforeach
</select>

{{-- Mostramos los datos de la opción que seleccionemos --}}

<form class="w-75 mx-auto" action="{{ route('edit-location-p')}}" method="POST">
    @method('PUT')
    @csrf
    <input class="form-control  mb-4" type="text" name="location_en" id="location_en" value="" placeholder="English" required>
    <input class="form-control  mb-4" type="text" name="location_es" id="location_es" value="" placeholder="Español">
    <input class="form-control  mb-4" type="text" name="location_no" id="location_no" value="" placeholder="Norge">
    <input class="form-control  mb-4" type="hidden" name="location_id" id="input_location" value="" required>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary btn">{{__('Update location')}}</button>
    </div>
</form>

<script>
    'use strict'
    function changeInputValues() {
        let selectedOption = select.value;
        let input = document.getElementById('input_location');
        inputEs.value = "";
        inputEn.value = "";
        inputNo.value = "";
        input.value = selectedOption;
        console.log(window.location.origin + "/api/location/" + selectedOption);

        fetch(window.location.origin + "/api/location/" + selectedOption)
        .then(result=>result.json())
        .then(respuesta=> {
            //Aquí rellenamos el formulario
            respuesta.forEach(element => {
                //console.log(element);
                if(element.language_code == "en") {
                    inputEn.value = element.name;
                }
                    
                if (element.language_code == "es") 
                    inputEs.value = element.name;
                if (element.language_code == "no") 
                    inputNo.value = element.name;
            });            
        }
        );
    }
    
    let select = document.getElementById('selectLocation');
    let inputEn = document.getElementById('location_en');
    let inputEs = document.getElementById('location_es');
    let inputNo = document.getElementById('location_no');

    changeInputValues();
   //Cambiamos los valores del input y del id enviado por formulario cada vez que seleccionamos una opción distinta
    select.addEventListener('change', function(e) {
        changeInputValues();
    });

</script>
@endsection
