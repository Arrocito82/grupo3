
<?php
use Repositories\AutorRepo;
use Repositories\GeneroRepo;
use Repositories\CategoriaRepo;
use Repositories\AudioRepo;
//require "Components/header.php";
require 'vendor/autoload.php' ;

echo "<br>";
//echo AutorRepo::CrearAutor("Prueba2");
echo var_dump(AutorRepo::ObtenerAutoresPorNombre("Motivacional"));
echo var_dump(AudioRepo::ObtenerAudio("5fdc015b1740361c4075c399"));
?>
<script>
    document.getElementsByTagName("nav")[0].style.display="none";
</script>

