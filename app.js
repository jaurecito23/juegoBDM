const btnNext = document.querySelectorAll(".siguiente");
const formPreg = document.querySelectorAll(".contenido__form");
const inputResp = document.querySelectorAll(".respuesta");
const form = document.querySelector(".form");
let id = 1;
const cantDePreg = form.dataset.total;



document.addEventListener('DOMContentLoaded',function(){


    eventosListos();



});





function eventosListos(){

    mostrarSegunId(id);

    eventoSiguiente();

    validarResp();
}



//Validando las respuesta

function validarResp(){

    inputResp.forEach((input)=>{

        input.addEventListener("click",function(){


            mostrarBtnSiguiente();


        })

    })


}

// Mostrando el boton siguiente

function mostrarBtnSiguiente(){

    if(id < cantDePreg){
        let btnSiguienteActual = document.querySelector(`.btn${id}`);
        btnSiguienteActual.classList.remove("oculto");
    }else{

        let btnEnviar = document.querySelector(".btn-enviar");
        btnEnviar.classList.remove("oculto");


    }

}



// Mostrar la pregunta segun su id o numero

function mostrarSegunId(id){

    formPreg.forEach((form)=>{

        if( form.id == id){

            form.classList.remove("oculto");

        }
    })



}

//Ocultar la pregunta anterior

function ocultarSegunId(id){
    formPreg.forEach((form)=>{

        if( form.id == id){

            form.classList.add("oculto");

        }
    })
}



// Evento al apretar boton siguiente
function eventoSiguiente() {
    btnNext.forEach(function(btn){
        btn.addEventListener("click",function(e){
            e.preventDefault();
                id = id+1;
                console.log(id);
                cambiarPregunta(id);
        });
    })
}


function cambiarPregunta(id){

    idAnterior = id - 1;
    mostrarSegunId(id);
    ocultarSegunId(idAnterior);


}