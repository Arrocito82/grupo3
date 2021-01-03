<?php

require 'vendor/autoload.php';

use Repositories\AudioRepo;
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
        $lista_id=$data['lista_id'];
    
        if($crud=='find'){
                //siempre retorna la lista actualizada
                
                $lista=ListasRepo::ObtenerLista($lista_id);
                // echo json_encode($lista);
                echo var_dump($lista) ;
        }else if($crud=='delete'){
               
            $modified= ListasRepo::EliminarAudios($lista_id,$data['audios_id']);
            echo $modified;
        }else if($crud=='update'){

            
            $modified= ListasRepo::ModificarLista($lista_id,$data['audios_id']);
            echo $modified;
            
        }else if($crud=='add'){

            $modified=ListasRepo::AgregarAudio($lista_id,$data['audio_id']);
            echo $modified;
        }


?>