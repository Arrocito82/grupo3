<?php
namespace Repositories;
    use MongoDB\Client as Mongo;
    use MongoDB\BSON\ObjectId as ID;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Lista;
use Models\SimpleAudio;
use Models\SimpleLista;
use MongoDB\Operation\FindAndModify;

class ListasRepo{
        public static function AgregarAudio(string $idLista , String $idAudio){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;
            $audio=AudioRepo::ObtenerSimpleAudio($idAudio);
            $result = $collection->updateOne(
                [ '_id' => new ID($idLista) ],
                [ '$push' => [ 'lista' => $audio ]]

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
            return $result->getModifiedCount();
        }
        
        public static function ModificarLista(string $idLista,string $fuente_id,int $destino){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;

            $tmp=$collection->updateOne(['_id' => new ID($idLista)],
            [ '$pull' => [ 'lista' => ['_id'=>['$in' =>[ $fuente_id]]]]]);
            $fuente=AudioRepo::ObtenerSimpleAudio($fuente_id);
            $result = $collection->updateOne(
                ['_id' => new ID($idLista)],
                ['$push'=> [
                    'lista'=> [
                       '$each'=> [$fuente],
                       '$position'=> $destino
                       ]
                       ]
                    
                ]
            );
            return $result->getModifiedCount();
           
        }
        public static function EliminarListas(){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;

            $result = $collection->updateMany(
            array(),
                array('$set' => array('lista' => array()))
            );
            return $result->getModifiedCount();
        }

        public static function EliminarAudios(String $idLista , array $idsAudio){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;

            $result = $collection->updateMany( 
                [ '_id' => new ID($idLista) ],
                [ '$pull' => [ 'lista' => ['_id'=>['$in' => $idsAudio]]]]
            );
            return $result->getModifiedCount();
        }  
        public static function EliminarAudio(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;

            $result = $collection->updateMany( 
                [],
                [ '$pull' => [ 'lista' => ['_id'=>['$in' => [$id]
                                                    ]
                                        ]
                            ]
                ]
            );
            return $result->getModifiedCount();
        } 
        
        public static function ModificarAudio($id){
            $updatedObject=AudioRepo::ObtenerSimpleAudio($id);
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;

            $result = $collection->updateMany([
                "lista._id"=> $id 
              ],
              [
                '$set'=> [
                  "lista.$"=> $updatedObject
                ]
              ]);
          return $result->getModifiedCount();
        
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

            $audios=[];
            foreach ($result['lista'] as $a) {
               array_push($audios,new SimpleAudio($a['_id'],$a['titulo']));
            }
            

            return  $audios;
            
        }
        
        public static function ObtenerSimpleLista(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Lista;
            $result = $collection->findOne(['_id' => new ID($id) ]);
            
            return new SimpleLista( $id , $result['nombre']);
        }

        
    }
?>