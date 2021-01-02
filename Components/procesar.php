<?php

/**
 * 
 * Esta pagina procesa las peticiones hechas por la pagina explorar, acepta el parametro
 * buscar con las opciones categoria, autor o genero 
 * 
 */

require '../vendor/autoload.php' ;
use Repositories\UsuarioRepo;
use Repositories\AudioRepo;

//cambiar a metodo post
if(isset($_POST['id_usuario'])){

    $usuario_lista=UsuarioRepo::ObtenerSimpleListasUsuario($_POST['id_usuario']);
    echo json_encode($usuario_lista);
    
}else if( isset($_POST['buscar'])&&isset($_POST['id'])&& isset($_POST['limite'])&&isset($_POST['ultimo'])){
        $limite=$_POST['limite'];
        $ultimo=$_POST['ultimo'];
        settype($limite,'integer');
        settype($ultimo,'integer');

        $target=($_POST['buscar']);//puede ser categorias, autores o generos
        $id_busqueda=$_POST['id'];
        
        $query=[
            $target.'.id'=>[
                                '$in'=>[$id_busqueda]
                            ]    
            ];
        
        
        $opciones=[
                    'limit' =>$limite
             ];
        $tmp=AudioRepo::ObtenerAudiosFiltro($query,$opciones);
        $audios=[];
        for ($i=$ultimo; $i <$limite&&$i<count($tmp) ; $i++) { 
            array_push($audios,$tmp[$i]);
        }
        
        echo json_encode($audios);
        

} ?>


