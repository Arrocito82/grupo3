<?php

require 'vendor/autoload.php';
use Repositories\ListasRepo;
$data = json_decode(file_get_contents('php://input'), true);



//valor del crud: puede ser delete,update, find
$crud=$data['crud'];

/*
estructura del json
 {
 'crud':'find',
 'lista_id':'**********'
 }
 
 {
 'crud':'delete',
 'lista_id':'**********',
 'audios_id':['audio1_id','audio2_id']
 }
 
 {
 'crud':'update',
 'lista_id':'**********',
 'audios_id':['audio1_id','audio2_id']
 }
 */


//si crud es igual a find se retorna la lista 

    
        if($crud=='find'){
                //siempre retorna la lista actualizada
                $lista_id=$data['lista_id'];
                $lista=ListasRepo::ObtenerLista($lista_id);
                echo json_encode($lista);
        }else if($crud=='delete'){
                //eliminar el audio
                
        }else if($crud=='update'){

            //sobreescribir la lista, viene en formato json
        }else if($crud=='add'){

            $modified=ListasRepo::AgregarAudio($data['lista_id'],$data['audio_id']);
            echo $modified;
        }


?>