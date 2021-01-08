//jshint esversion: 6


let ultima_posicion = 0;
let cargando = false;
window.addEventListener("scroll", function() {
    let posicion = pageYOffset;

    if (posicion >= document.documentElement.offsetHeight - 650 && cargando == false) {
        if (posicion > ultima_posicion) {
            ultima_posicion = posicion;

            if (posicion >= pageYOffset - 10) {
                cargando = true;
                //recuperar buscar, limite,ultimo,id
                //llamada a procesar.php usando ajax con post
                //imprimir mas audios en explorar.php
                //cargando=false;
            }
        }

    }

});