@extends('layouts.app')

@section('content')

@include('partials.messages') {{-- Aquí incluimos los mensajes de éxito y de error --}}

<select name="tag" id="selectTag">
    @foreach ($tags as $tag)
        @foreach ($tag->tag_translation as $tagTr)
            {{-- Mostramos solo el nombre en inglés que es el obligatorio--}}
            @if ($tagTr->language_code == 'en')
                <option value="{{$tag->id}}">{{$tagTr->name}}</option>
            @endif
        @endforeach
    @endforeach
</select>

{{-- Mostramos los datos de la opción que seleccionemos --}}

<form action="{{ route('edit-tag-p')}}" method="POST">
    @csrf
    <input type="text" name="tag_en" id="tag_en" value="" placeholder="English" required>
    <input type="text" name="tag_es" id="tag_es" value="" placeholder="Español">
    <input type="text" name="tag_no" id="tag_no" value="" placeholder="Norge">
    <input type="hidden" name="tag_id" id="input_tag" value="" required>
    <input type="submit" value="{{__('Update tag')}}">
</form>

<script>
    'use strict'
    function changeInputValues() {
        let selectedOption = select.value;
        let input = document.getElementById('input_tag');
        let valorEn = false;
        let valorNo = false;
        let valorEs = false;
        inputEs.value = "";
        inputEn.value = "";
        inputNo.value = "";
        input.value = selectedOption;
        console.log(window.location.origin + "/api/tag/" + selectedOption);

        fetch(window.location.origin + "/api/tag/" + selectedOption)
        .then(result=>result.json())
        .then(respuesta=> {
            //Aquí rellenamos el formulario
            respuesta.forEach(element => {
                console.log(element);
                if(element.language_code == "en") 
                    inputEn.value = element.name;
                if (element.language_code == "es") 
                    inputEs.value = element.name;
                if (element.language_code == "no") 
                    inputNo.value = element.name;
            });            
        }
        );
    }

    let select = document.getElementById('selectTag');
    let inputEn = document.getElementById('tag_en');
    let inputEs = document.getElementById('tag_es');
    let inputNo = document.getElementById('tag_no');

    changeInputValues();
   //Cambiamos los valores del input y del id enviado por formulario cada vez que seleccionamos una opción distinta
    select.addEventListener('change', function(e) {
        changeInputValues();
    });

</script>
@endsection

