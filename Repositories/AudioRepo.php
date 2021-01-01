<?php
namespace Repositories;
    use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Audio;
    
    
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


        public static function ObtenerAudio(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;
            $audioResult = $collection->findOne(array('_id' =>  new \MongoDB\BSON\ObjectId($id)));

            $Usuario = UsuarioRepo::ObtenerUsuario($audioResult['id_usuario']);

           

            return new Audio( $audioResult['_id'] , $audioResult['url'] , $audioResult['titulo'] , $Usuario , $audioResult['autores'] , $audioResult['categorias'] , $audioResult['generos']);
            
        }
        //AudioRepo::ObtenerAudiosFiltro(["categorias.id"=>['$in'=>['5fef8f1ab883756d8ad0d3c3']]]
        public static function ObtenerAudiosFiltro(array $filtro , array $opciones = [],int $ultimo=0){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;

            $result = $collection->find($filtro,$opciones)->toArray();

            
            return $result;

        }
        
        
    }
?>