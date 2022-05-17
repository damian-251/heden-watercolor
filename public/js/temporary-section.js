'use strict'

//Deshabilitaremos el menú de selección de sección especial 
//cuando marquemos la opción de deshabilitar y viceversa

let disableCheck = document.getElementById('disableSpecial');
let select = document.getElementById('selectTag');

//Aregamos una opción para que se muestre cuando esté deshabilitado
let option = document.createElement('option');
option.innerText = "Disabled";

disableCheck.addEventListener('change', function(e) {

    if (this.checked) {
        select.setAttribute('disabled', 'true'); 
        select.appendChild(option);
        option.setAttribute('selected', 'true');
    }else {
        select.removeAttribute('disabled');
        select.removeChild(option);
    }

});

