<?php

if(!isset($_GET['datos'])){
    echo 'null';
    die();
}
require 'vendor/autoload.php';
use Repositories\AutorRepo;
use Repositories\CategoriaRepo;
use Repositories\GeneroRepo;

$data = json_decode(stripslashes($_GET['datos']));

$nombre = $data->nombre;
$tipo = $data->tipo;
$result = "NaN";
if($tipo == 'autor')
    $result= AutorRepo::CrearAutor($nombre);
if($tipo =='categoria')
    $result= CategoriaRepo::CrearCategoria($nombre);
if($tipo == 'genero')
    $result= GeneroRepo::CrearGenero($nombre);

echo $result;
?>