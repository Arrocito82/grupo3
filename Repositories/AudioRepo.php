<?php
namespace Repositories;

use ErrorException;
use Exception;
use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Audio;
    use Models\SimpleAudio;
use MongoDB\BSON\ObjectId;

class AudioRepo{   

        public static function CrearAudio(String $url , String $titulo , String $id_usuario , array $id_autor , array $id_categoria , array $id_genero){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;

            $autores=AutorRepo::ObtenerAutores($id_autor);
            $categorias=CategoriaRepo::ObtenerCategorias($id_categoria);
            $generos=GeneroRepo::ObtenerGeneros($id_genero);
            $insertOneResult = $collection->insertOne([
                'url' => $url, 
                'titulo' => $titulo,
                'id_usuario' => $id_usuario,               
                'autores' => $autores,
                'categorias' => $categorias,
                'generos' => $generos,
                
            ]);
            
            return $insertOneResult->getInsertedId();
        }
        
        public static function EliminarAudio(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;

            $deleteResult = $collection->deleteOne(['_id' =>  new \MongoDB\BSON\ObjectId($id)]);
            $delete_safe=ListasRepo::EliminarAudio($id);
            return $delete_safe+$deleteResult->getDeletedCount();            
            // return $deleteResult->getDeletedCount();            
        }

        public static function ModificarAudio(String $id , String $titulo){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;

            $updateResult = $collection->updateOne(
                ['_id' =>  new \MongoDB\BSON\ObjectId($id)],
                ['$set' => ['titulo' => $titulo]]
            );
            $update_safe=ListasRepo::ModificarAudio($id);
             
            return $update_safe+$updateResult->getModifiedCount();            
            // return $updateResult->getModifiedCount();            
        }

        public static function ObtenerAudio(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;
            $audioResult = $collection->findOne(array('_id' =>  new \MongoDB\BSON\ObjectId($id)));

            $Usuario = UsuarioRepo::ObtenerUsuario($audioResult['id_usuario']);

           

            return new Audio( $audioResult['_id'] , $audioResult['url'] , $audioResult['titulo'] , $Usuario , $audioResult['autores'] , $audioResult['categorias'] , $audioResult['generos']);
            
        }
        public static function ObtenerSimpleAudio(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;
            $audioResult = $collection->findOne(array('_id' =>  new \MongoDB\BSON\ObjectId($id)),array('projection' => ['titulo'=>1]));
            return new SimpleAudio( $id , $audioResult['titulo']);
            
        }
        public static function ObtenerSimpleAudios(array $ids){
            $audios=[];
            $simple_audios=[];
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;
            foreach ($ids as $id) {
                array_push($audios,new \MongoDB\BSON\ObjectId($id));
            }
            $audioResult = $collection->find(['_id' => ['$in'=> $audios ]],['projection' => ['titulo'=>1,'_id.$oid'=>1]]);
            foreach ($audioResult as $k) {
                $id=$k['_id'];
                settype($id,'string');
                array_push($simple_audios,new SimpleAudio( $id,$k['titulo']));
            } 
            return $simple_audios;

        }
        //AudioRepo::ObtenerAudiosFiltro(["categorias.id"=>['$in'=>['5fef8f1ab883756d8ad0d3c3']]]
        //AudioRepo::ObtenerAudiosFiltro("usuario_id"=>'5fef8f1ab883756d8ad0d3c3')
        public static function ObtenerAudiosFiltro(array $filtro , array $opciones = []){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;

            $result = $collection->find($filtro,$opciones)->toArray();

            
            return $result;

        }
    }
        
    
?>