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

//valor del crud: puede ser delete,update, find
$crud=$data[0]['crud'];

//el id de la lista
$lista_id=$data[1]['_id']['$oid'];

//si crud es igual a find se retorna la lista 

    
        if($crud=='delete'){
                //eliminar el audio
        }else if($crud=='update'){

            //sobreescribir la lista, viene en formato json
        }
//siempre retorna la lista actualizada
$lista=new Lista($lista_id);
echo json_encode($lista);

?>