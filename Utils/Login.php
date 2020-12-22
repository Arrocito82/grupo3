<?php
namespace Utils;

require 'vendor/autoload.php' ;

use MongoDB\Client as Mongo;
use Utils\DBConnection\DBConnection as Con;

class Login  implements IAuthentication
{   
    /**
     * Devuelve "Logged" si el inicio de sesion es exitoso, caso contrario devuelve "ErrorLog"
     * 
     * $userName: Nombre de usuario
     * 
     * $password: Contraseña de usuario
     */
    public static function autentificar(String $userName ,String $password){
        $Client = new Mongo(Con::getConnectionString());
        $count = count($Client->grupo03->Usuario->find(['login'=>$userName,'clave'=>$password])->toArray());
        if($count>0) return "Logged";
        return "ErroLog";
        
    }
    
    public static function recuperar_id(String $userName ,String $password){
        $Client = new Mongo(Con::getConnectionString());
        $consulta=$Client->grupo03->Usuario->findOne(['login'=>$userName,'clave'=>$password]);
        $id=$consulta['_id'];
        return $id;
    }
}
 

?>