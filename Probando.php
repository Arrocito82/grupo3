
<?php
use Repositories\AutorRepo;
use Repositories\GeneroRepo;
use Repositories\CategoriaRepo;
use Repositories\AudioRepo;
use Repositories\ListasRepo;
//require "Components/header.php";
require 'vendor/autoload.php' ;

echo "<br>";
echo var_dump(ListasRepo::EliminarLista("5fd82ef75dc3d1359c7686e0"));


?>
<script>
    document.getElementsByTagName("nav")[0].style.display="none";
</script>

