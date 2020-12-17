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
}
 

?>