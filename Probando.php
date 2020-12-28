
<?php
use Repositories\AutorRepo;
use Repositories\GeneroRepo;
use Repositories\CategoriaRepo;
//require "Components/header.php";
require 'vendor/autoload.php' ;

echo "<br>";
//echo AutorRepo::CrearAutor("Prueba2");
echo var_dump(AutorRepo::ObtenerAutoresPorNombre("Motivacional"));
?>
<script>
    document.getElementsByTagName("nav")[0].style.display="none";
</script>

