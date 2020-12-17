<?php
namespace Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php' ;

class MailSender{
    /**
     * Envia un email usando como remitente el correo de la aplicacion, devuelve bool segun caso de exito
     * 
     * $to: Correo de destino
     * 
     * $HTMlMessage: HTML a enviar (String)
     * 
     * $subject: Asunto
     * 
     * $Body: Cuerpo
     */
    public static function sendMail(String $to , String $HTMlMessage , String $subject , String $Body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        
        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        
        $mail->Username = 'grupo03tpi@gmail.com';
        $mail->Password = 'grupo032020';
        $mail->setFrom('grupo03tpi@gmail.com');
        
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body    = $Body;
        $mail->MsgHTML($HTMlMessage); 
        
        return $mail->send();
    } 

}

?>