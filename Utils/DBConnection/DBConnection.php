<?php 
namespace Utils\DBConnection;
class DBConnection{
    /**
     * Devuelve el Connection String de la base MongoDB
     */
    public static function getConnectionString(){
        return 'mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
    }
}


?>