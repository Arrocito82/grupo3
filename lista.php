<?php
//tiene recibir un json con el id
    //si se recibe un audio
        //eliminar audio
        //retornar nueva lista actualizada

    //si se recibe una lista de audios
        //sobreescribir lista
        //retornar id de la lista modificada 
        


$data = json_decode(file_get_contents('php://input'), true);
require 'vendor/autoload.php' ;
require "Components/clases.php";
$crud=$data[0]['crud'];
$lista_id=$data[1]['_id']['$oid'];
if($crud=='find'){
    $lista=new Lista($lista_id);
    echo json_encode($lista);
}


?>