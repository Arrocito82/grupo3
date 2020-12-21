<!-- title es el titulo de la pagina -->

<?php
$title="Inicio";
// este es el navbar
require "Components/header.php";
require "Components/clases.php";

?>

    <!-- contenido -->

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active cropped ">
                <img id="img3" src="public/imagenes/pexels-stas-knop-5939401.jpg" class="d-block w-100 " alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>3 slide label</h2>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>


            <div class="carousel-item cropped ">
                <img id="img2" src="public/imagenes/pexels-brett-sayles-2479312.jpg" class="d-block w-100 " alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>2 slide label</h2>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item cropped ">

                <img id="img1" src="public/imagenes/pexels-budgeron-bach-5157178.jpg" class="d-block w-100 " alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>First slide label</h2>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>



    <div class="mt-5 container" id="contenido">
        <div class="categoria"></div>
        <div class="genero"></div>
        <div class="autor"></div>

    </div>
    <script>
        //jshint esversion: 6


        let ultima_posicion = 0;
        let destino = "";
        let cantidad = 12;

        let json_resultado = ;
        let buscar = "<?php echo $target;?>",
            limite = cantidad,
            ultimo = 0,
            ultimo_target = 0;
        let cargando = false;

        function recuperar_json() {
            var http = new XMLHttpRequest();

            //acciones cuando llegue el resultado
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {}
                http.open("POST", "Components/json_target.php", true);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send("buscar=" + buscar);

            }

            function cargar() {

                if (ultimo_target < json_resultado.length) {
                    //ultimo
                    //id
                    var http = new XMLHttpRequest();

                    //acciones cuando llegue el resultado
                    http.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {

                            document.getElementById(destino).insertAdjacentHTML("beforeend", this.responseText);


                            datos = document.querySelectorAll("#" + destino + " .col-sm-6.col-md-4.col-lg-3.my-4 .card").length;
                            if (datos % cantidad != 0 || (this.responseText) == "") {


                                ultimo_target++;
                                ultimo = 0;
                                limite = cantidad - datos % cantidad;
                                cargar();

                            }
                        }
                    };

                    //enviando peticion
                    http.open("POST", "Components/procesar.php", true);
                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    http.send("buscar=" + buscar + "&id=" + json_resultado[ultimo_target]._id.$oid + "&ultimo=" + ultimo + "&limite=" + limite);
                    ultimo = limite;
                    limite += limite;

                }
            }


            cargar();
            window.addEventListener("scroll", function() {

                if (document.documentElement.scrollHeight - document.documentElement.scrollTop === document.documentElement.clientHeight) {
                    cargar();
                }

            });
    </script>
    <?php              

require "Components/footer.php";?>