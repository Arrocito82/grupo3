<?php
namespace Utils;
use MongoDB\Client as Mongo;
use MongoDB\BSON\ObjectID as ID;
use Utils\DBConnection\DBConnection as Con;
use Utils\MailSender;
class ResetPassword{

    public static function SolicitarResetPass(String $email){
        $Client = new Mongo(Con::getConnectionString());
        $UsuarioCollection =$Client->grupo03->Usuario;

        $result = $UsuarioCollection->find(['email'=>$email])->toArray();

        if(count($result) < 1){
            return FALSE;    
        }
        $token = md5(time() .$email);
        
        $PassResetCollection=$Client->grupo03->PassResetTemp;

        $insertResult = $PassResetCollection->insertOne([
            'userId'    => $result[0]['_id'],
            'tempToken' => $token,
        ]);
        if($insertResult->getInsertedCount() >= 1){
            
            $htmlString='<p>Para recuperar contraseña usa el siguiente enlace</p>
                         <a href="localhost/ValidateReset.php?token='.$token.'">Recupera Contraseña</a>';
    
            return MailSender::sendMail($email , $htmlString , "Recuperacion de contraseña" , "Recuperar");
            
        }
        return FALSE;



    }

    public static function ResetPass(String $password , String $userId){
        $Client = new Mongo(Con::getConnectionString());
        $UsuarioCollection =$Client->grupo03->Usuario;
        
        
        $updateResult = $UsuarioCollection->updateOne(
            [ '_id' => new ID($userId) ],
            [ '$set' => [ 'clave' => $password ]]
        ); 
       
        if($updateResult->getModifiedCount() > 0){
            return TRUE;
        }
        return FALSE;
    }
    public static function ValidateToken(String $token){
        $Client = new Mongo(Con::getConnectionString());
        $ResetCollection =$Client->grupo03->PassResetTemp;
        $result = $ResetCollection->find([
            'tempToken' => $token,
        ])->toArray();

        if(count($result) < 1){
           return "Invalido"; 
        }
        $ResetCollection->deleteOne(['tempToken' => $token]);

        return $result[0]['userId'];
    }
}