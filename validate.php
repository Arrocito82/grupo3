<?php
use Utils\NewUser;
require 'vendor/autoload.php';
require "Components/header.php";


$result = FALSE;
if(isset($_GET["token"])){
    $result = NewUser::ValidateNewUser($_GET["token"]);
    
}
if($result){
    echo '<div class="alert alert-success" role="alert">
           Se ha verificado tu correo, ya puedes iniciar session
           <a class="btn btn-primary" href="/">Ir al Inicio</a>           
          </div>';
}
else{
    echo '<div class="alert alert-danger" role="alert">
            Token no Valido o ya fue utilizado
         </div>';
}



?>
<script>
    document.getElementsByTagName('nav')[0].style.display ="none";
</script>
