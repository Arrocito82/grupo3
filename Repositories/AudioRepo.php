<?php
namespace Repositories;
    use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Audio;
    use Models\Autor;
    use Models\Categoria;
    use Models\Genero;
   

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
        public static function ObtenerAudioesPorNombre(String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;
            //$Audioes = $collection->find(array('nombre' =>  $nombre));
            $Audioes = $collection->find(['nombre' =>  new \MongoDB\BSON\Regex('^Prueba', 'i')])->toArray();           
            $Audioes = array(); 
            foreach ($Audioes as $Audio) {
                # code...
                $Audio = new Audio($Audio['nombre'] , $Audio['_id']);
                array_push($Audioes , $Audio);
            }
            return $Audioes;
        }

        public static function EliminarAudio(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;

            $deleteResult = $collection->deleteOne(['_id' =>  new MongoDB\BSON\ObjectId($id)]);
            return $deleteResult->getDeletedCount();            
        }

        public static function ModificarAudio(String $id , String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Audio;

            $updateResult = $collection->updateOne(
                ['_id' =>  new MongoDB\BSON\ObjectId($id)],
                ['$set' => ['nombre' => $nombre]]
            );
            return $updateResult->getModifiedCount();            
        }
    }
?>