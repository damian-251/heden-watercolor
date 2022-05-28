'use strict'

let dropdowns = document.querySelectorAll('.dropdown-toggle')
let imageText = document.getElementsByClassName('hw-product-text');
let linkImage = document.getElementsByClassName('hw-product-link');

let index = 0;

let opcionesBusqueda = document.getElementById("hw-search-options");
let divOpcionesBusqueda = document.getElementById("hw-search-description");

//Flechasa de arriba y abajo
let rightArrow = document.getElementById("hw-search-right");
let downArrow = document.getElementById("hw-search-down");


//Códigos de búsqueda
let codigosBusqueda = document.getElementsByClassName("hw-search-word");

//Cuadro de búsqueda
let searchBar = document.getElementById("hw-search-input");

//Menú desplegable para los filtros de búsqueda
dropdowns.forEach((dd)=>{
    dd.addEventListener('click', function (e) {
        var el = this.nextElementSibling
        el.style.display = el.style.display==='block'?'none':'block'
    })
});

//Evento para que apareza el mensaje de disponible al pasar el ratón sobre el producto

for (let index = 0; index < linkImage.length; index++) {

    linkImage[index].addEventListener('mouseover', function(e){
        imageText[index].style.display = "block";
    });
    
    linkImage[index].addEventListener('mouseout', function(e){
        imageText[index].style.display = "none";
    });   
    
}

//Mostrar ocultar opciones de búsqueda

opcionesBusqueda.addEventListener("click", function(event) {
    if (divOpcionesBusqueda.style.display == "block") {
        divOpcionesBusqueda.style.display = "none";
        rightArrow.style.display = "inline";
        downArrow.style.display = "none";

    }
    else {
        divOpcionesBusqueda.style.display = "block";
        rightArrow.style.display = "none";
        downArrow.style.display = "inline";
    }
    
});

//Al hacer click en el código de búsqueda lo ponmos en la barra y establecemos el foco en ella
for (const element of codigosBusqueda) {
    element.addEventListener("click", function(event) {
        searchBar.value = element.innerText + " ";
        searchBar.focus();
    })
}

