'use strict'

let inputAddress = document.getElementsByClassName('input_address');
let selectAddress = document.getElementById('address');
let inputAddressB = document.getElementsByClassName('input_addressB');

console.log(inputAddressB);

let subtotal = document.getElementById('subtotal');
let shipping = document.getElementById('shipping_price');
let total = document.getElementById('total_price');

let country = document.getElementById('country');

let billingform = document.getElementById('billing-address');
let checkBill = document.getElementById('billingCheck');

function updatePrice(idCountry) {
    fetch(window.location.origin + "/api/shipping/" + idCountry)
        .then(result=>result.json())
        .then(respuesta=> {
            //Aquí rellenamos el formulario
            if (document.documentElement.lang == "no") {
                shipping.innerText = respuesta.nok;
            }else {
                shipping.innerText = respuesta.eur;
            }
            return shipping.innerText;
        })
        .then((shipping_price) => {
            total.innerText =  parseFloat(subtotal.innerText) + parseFloat(shipping_price)
        }
        
    );
}


/**
 * Cuando seleccionamos una dirección de la lista se deshabilita la
 * introducción de datos en el formulario y viceversa
 */
if (selectAddress != null) {
    //Este elemento del dom será nulo cuando no hemos iniciado sesión
    selectAddress.addEventListener("change", function(event) {
       if (selectAddress.value != "") {
           for (let element of inputAddress) {
               element.setAttribute('disabled', 'true');
               element.removeAttribute('required');
               country.value="";
           }
       }else {
           
           for (let element of inputAddress) {
               element.removeAttribute('disabled');
               element.setAttribute('required', 'true');   
           }
       }
    });

}



//Al cambiar el país se actualizan los gastos de envío
country.addEventListener("change", function(event) {
    updatePrice(this.value);
});

//Al cambiar la dirección se extrae su país y se actualizan los gastos de envío
selectAddress.addEventListener("change", function(event) {
    updatePrice(this.options[this.selectedIndex].getAttribute("data-country"));
});

//Al marcar el checkbox mostramos como visible que el usuario introduzca la dirección de facturación


checkBill.addEventListener('change', function(e) {

    if (this.checked) {
        billingform.style.display = "block";
        for (let element of inputAddressB) {
            element.setAttribute('required', 'true');   
            console.log(element);
        }
    }else {
        billingform.style.display = "none";
        for (let element of inputAddressB) {
            element.removeAttribute('required');
            
        }
    }

});
