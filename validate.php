<?php
use Utils\NewUser;
use Components\Alert;
require "Components/header.php";


$result = FALSE;
if(isset($_GET["token"])){
    $result = NewUser::ValidateNewUser($_GET["token"]);    
}
$message = Alert::SimpleAlert('Token no Valido o ya fue utilizado' , 'alert alert-danger');
if($result){
    $message = Alert::SimpleAlert('Se ha verificado tu correo, ya puedes iniciar session','alert alert-success');
    $message = $message . '<a class="btn btn-primary" href="/">Ir al Inicio</a>';                    
}
echo '<div class="container mt-4">' . $message . '</div>';



?>
<script>
    //document.getElementsByTagName('nav')[0].style.display ="none";
</script>
