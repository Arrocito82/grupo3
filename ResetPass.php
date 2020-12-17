<?php $title="Recuperar contraseña";


require "Components/header.php";

use Utils\ResetPassword as Reset;



if(isset($_POST['email'])){
    $result = Reset::SolicitarResetPass($_POST['email']);
    if($result){
        print('<div class="alert alert-success" role="alert">
        Se ha enviado un correo de recuperacion
            </div>');
            header("refresh:3; index.php");
        }
    else{    
    print('<div class="alert alert-danger" role="alert">
    Correo Invalido
        </div>');
    }
}
    
?>


<div class="container">

    <form action="ResetPass.php" method="post">
        <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">Ingresa tu email</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


