<!-- title es el titulo de la pagina -->
<?php
$title="Inicio";
// este es el navbar
require "Components/header.php";
use MongoDB\Client as db;
$uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
$client =  new db($uri);
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




<!-- Explorar -->

<!-- categorias -->

 <?php 
 $collection =$client->grupo03->Categoria;
 $cursor = $collection->find([]);

echo "<div class='container my-5'> <h2 class='py-3'>Categorias</h2>";
echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">';
$array=$cursor->toArray();
 for ($i=0;$i<count($array); $i++) {
   echo'<div class="col mb-4">
      <div class="card h-100">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'.$array[$i]['nombre'].'</h5>
          <p class="card-text"> This content is a little bit longer.</p>
        </div>
      </div>
    </div>';
  } 
  echo '</div></div>';
unset($i);

//<!-- Autor -->

 $collection =$client->grupo03->Autor;
 $cursor = $collection->find([]);

echo "<div class='container my-5'> <h2 class='py-3'>Autor</h2>";
echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">';
$array=$cursor->toArray();
 for ($i=0;$i<count($array); $i++) {
   echo
    ' 
    <div class="col mb-4">
      <div class="card h-100">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'.$array[$i]['nombre'].'</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
      </div>
    </div>';
  }
  
  echo '</div></div>';
  unset($i);

//<!-- Genero -->

 $collection =$client->grupo03->Genero;
 $cursor = $collection->find([]);

echo "<div class='container my-5'> <h2 class='py-3'>Genero</h2>";
echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">';
$array=$cursor->toArray();
 for ($i=0;$i<count($array); $i++) {
   echo
    ' 
    <div class="col mb-4">
      <div class="card h-100">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'.$array[$i]['nombre'].'</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
      </div>
    </div>';
  } echo '</div></div>';
  unset($i);



require "Components/footer.php";?>