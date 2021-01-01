<?php
    namespace Repositories;
    use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Usuario;
    use Repositories\ListasRepo;
    class UsuarioRepo{                   
        public static function ObtenerUsuario(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Usuario;

            
            $usuario = $collection->findOne(array('_id' =>  new \MongoDB\BSON\ObjectId($id)));
            $listas=[];
            foreach($usuario['listas'] as $lista){
                array_push($listas,ListasRepo::ObtenerLista($lista));
            }
            $Usuario = new Usuario( $usuario['_id'] , $usuario['nombre'], $listas);
            return $Usuario;

        }
        public static function ObtenerListasUsuario(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Usuario;

            
            $usuario = $collection->findOne(array('_id' =>  new \MongoDB\BSON\ObjectId($id)));
            $listas=[];
            foreach($usuario['listas'] as $lista){
                array_push($listas,ListasRepo::ObtenerLista($lista));
            }
            $Usuario = new Usuario( $usuario['_id'] , $usuario['nombre'], $listas);
            return $Usuario->listas;

        }
    }
?>