<?php
namespace Utils; 
use MongoDB\Client as Mongo;
use Utils\DBConnection\DBConnection as Con;
use Utils\MailSender;

class NewUser{
    public function RegisterNewUser(String $userName , String $fullName , String $password , String $email){

        $Client = new Mongo(Con::getConnectionString());
        $TempUsersCollection = $Client->grupo03->TempUsers;

        $newToken = md5(time() . $userName . $password);
        $result = $TempUsersCollection->insertOne([
            'login'     => $userName,
            'email'     => $email,
            'nombre'    => $fullName,
            'clave'     => $password,
            'tempToken' => $newToken, //Genera un token
        ]);

        if($result->getInsertedCount() > 0){
            $HtmlMessage = NewUser::getRegisterHtmlMessage($newToken , $fullName);
            $Body = NewUser::getRegisterBody();
            return MailSender::sendMail( $email ,  $HtmlMessage ,  "Nuevo Registro en " ,  $Body);            
        }
        return FALSE;
    }

    public function ValidateNewUser(String $token){

        $Client = new Mongo(Con::getConnectionString());
        $TempUsersCollection = $Client->grupo03->TempUsers;

        $result = $TempUsersCollection->find(['tempToken'=>$token ])->toArray();

        if(count($result) < 1){
            return FALSE;
        }
       
        $insertResult = $Client->grupo03->Usuario->insertOne([
            'login'     => $result[0]['login'],
            'email'     => $result[0]['email'],
            'nombre'    => $result[0]['nombre'],
            'clave'     => $result[0]['clave'],
        ]);
        
        if($insertResult->getInsertedCount() > 0){
            $deleteResult = $TempUsersCollection->deleteOne(['tempToken' => $token]);
            return $deleteResult->getDeletedCount();
        }
        
        return TRUE;
    }

    public function getRegisterHtmlMessage(String $token , String $fullName){
        $html ='<main>
                    <p>Bienvenido ' . $fullName . '</p>
                    <p>Para verificar tu registro has click en el siguiente enlace</p>
                    <a href="http://localhost/validate.php?token=' . $token . '">Verificar</a>
                    <p>Si no te has registrado ingora este mail</p>
                </main>';
        //Se debe cambiar por uno con estilos
        return $html;
    }
    public function getRegisterBody(){
        return 'Nuevo registro'; //Se debe cambiar
    }
}
