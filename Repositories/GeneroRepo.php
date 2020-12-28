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
            echo "hola";
            return $insertOneResult->getInsertedId();
        }


        public static function ObtenerGenero(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Genero;
            $genero = $collection->findOne(array('_id' =>  new MongoDB\BSON\ObjectId($id)));

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

        public static function EliminarAutor(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Genero;

            $deleteResult = $collection->deleteOne(['_id' =>  new MongoDB\BSON\ObjectId($id)]);
            return $deleteResult->getDeletedCount();            
        }

        public static function ModificarAutor(String $id , String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Genero;

            $updateResult = $collection->updateOne(
                ['_id' =>  new MongoDB\BSON\ObjectId($id)],
                ['$set' => ['nombre' => $nombre]]
            );
            return $updateResult->getModifiedCount();            
        }
    }
?>