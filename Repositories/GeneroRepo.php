<?php 
    namespace Repositories;
    use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Genero;

    class GeneroRepo{                   
        public static function CrearGenero(String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Genero;

            $insertOneResult = $collection->insertOne([
                'nombre' => $nombre,                
            ]);
            
            return $insertOneResult->getInsertedId();
        }


        public static function ObtenerGenero(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Genero;
            $genero = $collection->findOne(array('_id' =>  new \MongoDB\BSON\ObjectId($id)));

            $Genero = new Genero($genero['nombre'] , $genero['_id']);
            return $Genero;
        }
        public static function ObtenerGenerosPorNombre(String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Genero;
            $generos = $collection->find(array('nombre' =>  $nombre));
            $Generos = array(); 
            foreach ($generos as $genero) {
                # code...
                $Genero = new Genero($genero['nombre'] , $genero['_id']);
                array_push($Generos , $Genero);
            }
            return $Generos;
        }

        public static function EliminarGenero(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Genero;

            $deleteResult = $collection->deleteOne(['_id' =>  new MongoDB\BSON\ObjectId($id)]);
            return $deleteResult->getDeletedCount();            
        }

        public static function ModificarGenero(String $id , String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Genero;

            $updateResult = $collection->updateOne(
                ['_id' =>  new MongoDB\BSON\ObjectId($id)],
                ['$set' => ['nombre' => $nombre]]
            );
            return $updateResult->getModifiedCount();            
        }

        public static function ObtenerGeneros($ids){
            $GenerosResult = [];
            for($t = 0 ; $t < count($ids); $t++){
                array_push($GenerosResult , GeneroRepo::ObtenerGenero($ids[$t]));
            }
            return $GenerosResult;
        }

        public static function ObtenerTodosGeneros(){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Genero;

            $result = $collection->find([]);
            $result_gen = $result->toArray(); 
            $GenerosResult = [];
            for($i = 0 ; $i < count($result_gen); $i++){
                $genero = $result_gen[$i];
                array_push($GenerosResult ,  new Genero($genero['nombre'] , $genero['_id']));
            }
            return $GenerosResult;
        }
    }
?>