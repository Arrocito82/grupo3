<?php
require '../vendor/autoload.php' ;
use MongoDB\Client as db;
$uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
$client =  new db($uri);
if( isset($_GET['buscar'])&&($_GET['buscar']=="categoria"||$_GET['buscar']=="genero"||$_GET['buscar']=="autor")){
    
    $target=ucwords(strtolower($_GET['buscar']));  
    
    $collection =$client->grupo03->$target;
    $consulta=$collection->find([]);
    //recuperando la lista del target filtro y conviertiendo a array
    $resultado=($consulta)->toArray();//categoria
    $json_resultado=json_encode($resultado);
    echo $json_resultado;
}?>