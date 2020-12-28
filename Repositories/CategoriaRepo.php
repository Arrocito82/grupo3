<?php 
    namespace Repositories;
    use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Categoria;

    class CategoriaRepo{                   
        public static function CrearCategoria(String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Categoria;

            $insertOneResult = $collection->insertOne([
                'nombre' => $nombre,                
            ]);
             "hola"
            return $insertOneResult->getInsertedId();
        }


        public static function ObtenerCategoria(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Categoria;
            $categoria = $collection->findOne(array('_id' =>  new MongoDB\BSON\ObjectId($id)));

            $Categoria = new Categoria($categoria['nombre'] , $categoria['_id']);
            return $Categoria;
        }
        public static function ObtenerCategoriasPorNombre(String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Categoria;
            $categorias = $collection->find(array('nombre' =>  $nombre));
            $Categorias = array(); 
            foreach ($categorias as $categoria) {
                # code...
                $Categoria = new Categoria($categoria['nombre'] , $categoria['_id']);
                array_push($Categorias , $Categoria);
            }
            return $Categorias;
        }

        public static function EliminarCategoria(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Categoria;

            $deleteResult = $collection->deleteOne(['_id' =>  new MongoDB\BSON\ObjectId($id)]);
            return $deleteResult->getDeletedCount();            
        }

        public static function ModificarCategoria(String $id , String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Categoria;

            $updateResult = $collection->updateOne(
                ['_id' =>  new MongoDB\BSON\ObjectId($id)],
                ['$set' => ['nombre' => $nombre]]
            );
            return $updateResult->getModifiedCount();            
        }
    }
?>