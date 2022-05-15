'use strict'

let dropdowns = document.querySelectorAll('.dropdown-toggle')
let imageText = document.getElementsByClassName('hw-product-text');
let linkImage = document.getElementsByClassName('hw-product-link');

let index = 0;


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


