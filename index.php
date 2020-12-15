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
    
    
   
    <div class="carousel-item cropped ">
      <img id="img1" src="public/imagenes/pexels-budgeron-bach-5157178.jpg" class="d-block w-100 " alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h2>2 slide label</h2>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
      </div>
    </div>
    <div class="carousel-item cropped " >
      <img id="img2" src="public/imagenes/pexels-brett-sayles-2479312.jpg" class="d-block w-100 " alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h2>First slide label</h2>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
      </div>
    </div>
    <div class="carousel-item active cropped ">
      <img id="img3" src="public/imagenes/pexels-stas-knop-5939401.jpg" class="d-block w-100 " alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h2>3 slide label</h2>
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

<div class="body container">
<!-- footer -->
<?php 
echo "<p>";
for ($i=0; $i <100 ; $i++) { 
  echo "hallo<br>";
}echo "</p>";


require "Components/footer.php";?>