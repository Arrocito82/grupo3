<?php 
    namespace Repositories;
    use MongoDB\Client as Mongo;
    use Utils\DBConnection\DBConnection as Connection;
    use Models\Usuario;
    class UsuarioRepo{                   
        public static function ObtenerUsuario(String $id){
            $Client = new Mongo(Connection::getConnectionString());
            $collection = $Client->grupo03->Usuario;

            
            $usuario = $collection->findOne(array('_id' =>  new \MongoDB\BSON\ObjectId($id)));

            $Usuario = new Usuario( $usuario['_id'] , $usuario['nombre']);
            return $Usuario;

        }
    }
?>