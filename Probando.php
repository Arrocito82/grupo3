<?php
use Repositories\AutorRepo;
require "Components/header.php";

echo "<br>";
//echo AutorRepo::CrearAutor("Prueba2");
echo var_dump(AutorRepo::ObtenerAutoresPorNombre("Prueba"));
?>
<script>
    document.getElementsByTagName("nav")[0].style.display="none";
</script>

