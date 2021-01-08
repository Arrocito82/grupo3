<!-- title es el titulo de la pagina -->

<?php
$title="audafreemp3 | Reproducir audios | Descargar | Mp3";
// este es el navbar
require "Components/header.php";



?>

    <!-- contenido -->

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active cropped ">
                <img id="img3" src="public/imagenes/pexels-stas-knop-5939401.jpg" class="d-block w-100 " alt="auriculares-con-cable-negro-y-azul">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="h1">Libertad</h2>
                    <p class="h3">Escucha tus audios sin copyright <i class="far fa-copyright"></i>preferidos cuantas veces quieras.</p>
                </div>
            </div>


            <div class="carousel-item cropped ">
                <img id="img2" src="public/imagenes/pexels-brett-sayles-2479312.jpg" class=" d-block w-100 " alt="foto-actuacion-musica-amigos">
                <div class="carousel-caption d-none d-md-block">
                <h2 class="h1">Comparte</h2>
                    <p class="h3">Escucha el ritmo y las voces que mueve al mundo.</p>
                </div>
            </div>
            <div class="carousel-item cropped ">

                <img id="img1" src="public/imagenes/pexels-budgeron-bach-5157178.jpg" class="d-block w-100 " alt="foto-actividad-adecuación-afición">
                <div class="carousel-caption d-none d-md-block">
                <h2 class="h1">Libertad</h2>
                    <p class="h3">Escucha tus audios favoritos donde quiera que vayas.</p>
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
    </div>
    <div class="container-fluid">
    

    <section class="index-section">
        <div class="row my-5">
        <i class="fas fa-cloud-upload-alt icon-section"></i>
            <div>
                <h2 class="titulo-section" >Agregar Audios</h2>
                <h4>Puedes almacenar tus audios sin copyright <i class="far fa-copyright"></i> favoritos y acceder a ellos desde cualquier lugar.</h4>
            </div>
            <hr>
        </div>
        <div class="row my-5">
            <i class="fas fa-headphones icon-section "></i>
            <div>
                <h2 class="titulo-section">Reproducir</h2>
                <h4>Puedes escuchar audios de entrevistas, audiolibros, musica y mucho mas. Agrega tus audios favoritos a tu lista de <em>favoritos</em> y <em>ver mas tarde</em></h4>
            </div>
            <hr>
        </div> 
        <div class="row my-5">
            <i class="fas fa-search icon-section"></i>
            <div>
                <h2 class="titulo-section">Explorar</h2>
                <h4>Explora los audios de las diferentes <em>Autores</em>, <em>Categorias</em> y <em>Generos</em>.
                    Ademas, puedes buscar tus audios preferidos, usando la barra de busqueda.
                </h4>
            </div>
            
        </div>
    </section>
</div>





   

<?php
require "Components/footer.php";?>
