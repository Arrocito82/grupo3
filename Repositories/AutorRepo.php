<?php 
    namespace Repositories;
    use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Autor;

    class AutorRepo{                   
        public static function CrearAutor(String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Autor;

            $insertOneResult = $collection->insertOne([
                'nombre' => $nombre,                
            ]);
            
            return $insertOneResult->getInsertedId();
        }


        public static function ObtenerAutor(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Autor;
            $autor = $collection->findOne(array('_id' =>  new \MongoDB\BSON\ObjectId($id)));

            $Autor = new Autor($autor['nombre'] , $autor['_id']);
            return $Autor;
        }
        public static function ObtenerAutoresPorNombre(String $nombre , array $options = []){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Autor;
            //$autores = $collection->find(array('nombre' =>  $nombre));
            $autores = $collection->find(['nombre' =>  new \MongoDB\BSON\Regex('^'.$nombre, 'i')] , $options)->toArray();           
            $Autores = array(); 
            foreach ($autores as $autor) {
                # code...
                $Autor = new Autor($autor['nombre'] , $autor['_id']);
                array_push($Autores , $Autor);
            }
            return $Autores;
        }

        public static function EliminarAutor(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Autor;

            $deleteResult = $collection->deleteOne(['_id' =>  new MongoDB\BSON\ObjectId($id)]);
            return $deleteResult->getDeletedCount();            
        }

        public static function ModificarAutor(String $id , String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Autor;

            $updateResult = $collection->updateOne(
                ['_id' =>  new MongoDB\BSON\ObjectId($id)],
                ['$set' => ['nombre' => $nombre]]
            );
            return $updateResult->getModifiedCount();            
        }

        public static function ObtenerAutores($ids){
            $AutorsResult = [];
            for($i = 0 ; $i < count($ids); $i++){
                array_push($AutorsResult , AutorRepo::ObtenerAutor($ids[$i]));
            }
            return $AutorsResult;
        }

        public static function ObtenerTodosAutores(){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Autor;

            $result = $collection->find([]);
            $result_aut = $result->toArray(); 
            $AutorsResult = [];
            for($i = 0 ; $i < count($result_aut); $i++){
                $autor = $result_aut[$i];
                array_push($AutorsResult ,  new Autor($autor['nombre'] , $autor['_id']));
            }
            return $AutorsResult;
        }

        
    }
?>