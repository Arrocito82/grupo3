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
 'crud':'recuperar',
 'audio_id':'**********'
 }
 {
 'crud':'find',
 'usuario_id':'**********'
 }
 
 {
 'crud':'delete',
 'audio_id':'audio1_id'
 }
 
 {
 'crud':'update',
 'audio_id':'audio1_id'
 'titulo':'audio1_id',
 
 }
 */


//si crud es igual a find se retorna la lista 
        //$lista_id=$data['lista_id'];
    
        if($crud=='find'){
               
                
                $lista=AudioRepo::ObtenerAudiosFiltro(['id_usuario'=>$data['usuario_id']],[]);
                echo json_encode($lista);
        }else if($crud=='recuperar'){
               
                
                $lista=AudioRepo::ObtenerAudio($data['audio_id']);
                echo json_encode($lista);
        }      
        // }else if($crud=='delete'){
               
        //     $modified= ListasRepo::EliminarAudios($lista_id,$data['audios_id']);
        //     echo $modified;
        // }else if($crud=='update'){

            
        //     $modified= ListasRepo::ModificarLista($lista_id,$data['fuente_id'],$data['destino']);
        //     echo $modified;
                
               
            
        // }else if($crud=='add'){

        //     $modified=ListasRepo::AgregarAudio($lista_id,$data['audio_id']);
        //     echo $modified;
        // }


?>