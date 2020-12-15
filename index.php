<!-- title es el titulo de la pagina -->
<?php

$title="Inicio";
// este es el navbar
session_start();


require "Components/header.php";


?>

<!-- contenido -->

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="public/imagenes/pexels-stas-knop-5939401.jpg" class="d-block w-100 cropped " alt="...">
    </div>
    <div class="carousel-item">
      <img src="public/imagenes/pexels-budgeron-bach-5157178.jpg" class="d-block w-100 cropped " alt="...">
    </div>
    <div class="carousel-item">
      <img src="public/imagenes/pexels-brett-sayles-2479312.jpg" class="d-block w-100 cropped " alt="...">
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


<!-- footer -->
<?php 
echo "<p>";
for ($i=0; $i <100 ; $i++) { 
  echo "hallo<br>";
}echo "</p>";


require "Components/footer.php";?>