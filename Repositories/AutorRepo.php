<?php 
    use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Autor;
    namespace Repositories;

    class AutorRepo{                   
        public static function CrearAutor(Strign $nombre){
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
            $autor = $collection->findOne(array('_id' =>  new MongoDB\BSON\ObjectId($id)));

            $Autor = new Autor($autor['nombre'] , $autor['_id']);
            return $Autor;
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
    }
?>