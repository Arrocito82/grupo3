<?php
namespace Repositories;
    use MongoDB\Client as Mongo;
    use MongoDB\BSON\ObjectId as ID;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Lista;
    use Models\SimpleLista;
   

    class ListasRepo{
        public static function AgregarAudio(string $idLista , String $idAudio){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;
            
            $result = $collection->updateOne(
                [ '_id' => new ID($idLista) ],
                [ '$push' => [ 'lista' => $idAudio ]]

            );
            return $result->getModifiedCount();
        }

        public static function EliminarLista(string $idLista){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;

            $result = $collection->updateOne(
                ['_id' => new ID($idLista)],
                ['$set' => ['lista' => array()]]
            );
            return $result;
        }

        public static function EliminarAudios(String $idLista , array $idsAudio){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;

            $result = $collection->updateOne(
                [ '_id' => new ID($idLista) ],
                [ '$pull' => [ 'lista' => ['$in' => $idsAudio]]]
            );
            return $result;
        }  
        public static function CrearLista(String $nombre){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;

            $result = $collection->insertOne([
                'nombre' => $nombre
                ]);
            return $result->getInsertedId();

        }
        public static function ObtenerLista(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;

            $result = $collection->findOne(['_id' => new ID($id) ]);

            $lista = $result['lista'];


            $Audios = [];
            for($i = 0 ; $i < count($lista) ; $i++){
                array_push($Audios , AudioRepo::ObtenerAudio($lista[$i]));
            }
            return new Lista($result['_id'] , $result['nombre'] , $Audios);
        }
        
        public static function ObtenerSimpleLista(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;
            $result = $collection->findOne(['_id' => new ID($id) ]);
            return new SimpleLista($result['_id'] , $result['nombre']);
        }

        // public static function ObtenerListasDeUsuario(String $idUsuario){
        //     $Client = new Mongo(Connection::getConnectionString());
        //     $collection = $Client->grupo03->Usuario;

        //     $result = $collection->findOne(['_id' => new ID($idUsuario)]);

        //     return $result['listas'];            
        // }
    }
?>