<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php' ;





$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";

$mail->Username = 'grupo03tpi@gmail.com';
$mail->Password = 'grupo032020';
$mail->setFrom('grupo03tpi@gmail.com');
$mail->addAddress('ao17006@ues.edu.sv');
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the body.';
$mail->MsgHTML("<p>Hola</p>"); 

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>