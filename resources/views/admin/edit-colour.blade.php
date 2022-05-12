@extends('layouts.app')

@section('content')
@include('partials.admin-cp-menu')
@include('partials.messages') {{-- Aquí incluimos los mensajes de éxito y de error --}}


<h1 class="text-center my-4">{{__("Edit colour")}}</h1>
<select class="w-75 mx-auto mb-4 form-select" name="colour" id="selectColour">
    @foreach ($colours as $colour)
        @foreach ($colour->colour_translation as $ColourTr)
            {{-- Mostramos solo el nombre en inglés que es el obligatorio--}}
            @if ($ColourTr->language_code == 'en')
                <option value="{{$colour->id}}">{{$ColourTr->name}}</option>
            @endif
        @endforeach
    @endforeach
</select>

{{-- Mostramos los datos de la opción que seleccionemos --}}

<form class="w-75 mx-auto" action="{{ route('edit-colour-p')}}" method="POST">
    @csrf
    <input class="form-control  mb-4" type="text" name="colour_en" id="colour_en" value="" placeholder="English" required>
    <input class="form-control  mb-4" type="text" name="colour_es" id="colour_es" value="" placeholder="Español">
    <input class="form-control  mb-4" type="text" name="colour_no" id="colour_no" value="" placeholder="Norge">
    <input class="form-control  mb-4" type="hidden" name="colour_id" id="input_colour" value="" required>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary btn">{{__('Update colour')}}</button>
    </div></form>

<script>
    'use strict'
    function changeInputValues() {
        let selectedOption = select.value;
        let input = document.getElementById('input_colour');
        inputEs.value = "";
        inputEn.value = "";
        inputNo.value = "";
        input.value = selectedOption;
        console.log(window.location.origin + "/api/colour/" + selectedOption);

        fetch(window.location.origin + "/api/colour/" + selectedOption)
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
    
    let select = document.getElementById('selectColour');
    let inputEn = document.getElementById('colour_en');
    let inputEs = document.getElementById('colour_es');
    let inputNo = document.getElementById('colour_no');

    changeInputValues();
   //Cambiamos los valores del input y del id enviado por formulario cada vez que seleccionamos una opción distinta
    select.addEventListener('change', function(e) {
        changeInputValues();
    });

</script>
@endsection
