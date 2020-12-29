<?php
namespace Repositories;
    use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Audio;
    
    
    class AudioRepo{   

        public static function CrearAudio(String $url , String $titulo , String $id_usuario , array $id_autor , array $id_categoria , array $id_genero){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;

            $insertOneResult = $collection->insertOne([
                'url' => $url, 
                'titulo' => $titulo,
                'id_usuario' => $id_usuario,               
                'id_autor' => $id_autor,
                'id_categoria' => $id_categoria,
                'id_genero' => $id_genero,
                
            ]);
            
            return $insertOneResult;  //->getInsertedId();
        }


        public static function ObtenerAudio(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;
            $audioResult = $collection->findOne(array('_id' =>  new \MongoDB\BSON\ObjectId($id)));

            $Usuario = UsuarioRepo::ObtenerUsuario($audioResult['id_usuario']);

            $AutorsResult = AutorRepo::ObtenerAutores($audioResult['id_autor']);
            $CategoriasResult = CategoriaRepo::ObtenerCategorias($audioResult['id_categoria']);
            $GenerosResult = GeneroRepo::ObtenerGeneros($audioResult['id_genero']);

            return new Audio( $audioResult['_id'] , $audioResult['url'] , $audioResult['titulo'] , $Usuario , $AutorsResult , $CategoriasResult , $GenerosResult);
            
        }
        //$filtro = array('id_categoria'=>'hola', 'fdfd' => 'dsds')
        public static function ObtenerAudiosFiltro(array $filtro , array $opciones = []){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;

            $result = $collection->find($filtro,$opciones)->toArray();

            $AudiosResult = [];

            for($i = 0 ; $i < count($result) ; $i++){
                array_push($AudiosResult , AudioRepo::ObtenerAudio($result[$i]['_id']));
            }

            return $AudiosResult;

        }
        
        
    }
?>