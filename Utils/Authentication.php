<?php
require 'vendor/autoload.php' ;

use MongoDB\Client as Mongo;

class Login  //implements IAuthentication
{
    public static  function autentificar(String $userName ,String $password){
        $client = new Mongo('mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority');
        $count = count($client->grupo03->Usuario->find(['nombre'=>$userName,'clave'=>$password])->toArray());
        if($count>0) return "Logged";
        return "ErroLog";
        
    }
}
 

?>