<?php

$title="Inicio";
// este es el navbar
if(isset($_SESSION['userName']))
    Header("Location: index.php");


use Utils\NewUser;
use Components\Alert;
require 'vendor/autoload.php' ;
require "Components/header.php";

?>
<div>

    <?php 
     if(isset($_POST['userName']) & isset($_POST['password']) & isset($_POST['email']) & isset($_POST['fullName'])){
        $userName = $_POST['userName'];
        $fullName = $_POST['fullName'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $result = NewUser::RegisterNewUser($userName , $fullName , $password , $email);

        
        $alert = Alert::SimpleAlert('Este correo ya esta siendo usado, o es invalido' , 'alert alert-danger');

        if($result){            
            $alert =Alert::SimpleAlert('Se ha enviado un codigo de validacion al correo' , 'alert alert-success');
        }
        echo $alert;
        header("Refresh:5; url=login.php");
        die();
     }
     ?>

</div>
<div class="container w-50 form-container">

    <form action="Register.php" method="post">
    <div class="form-group">
        <label for="userName">Usuario</label>
        <input type="text" class="form-control" name="userName" id="userName" aria-describedby="userHelp" placeholder="Enter user" required>
        <small id="userHelp" class="form-text text-muted">Nombre de usuario en la web</small>
    </div>
    <div class="form-group">
        <label for="fullName">Nombre Completo</label>
        <input type="text" class="form-control" name="fullName" id="fullName" aria-describedby="userHelp" placeholder="Enter user" required>
        <small id="userHelp" class="form-text text-muted">Nombre completo (Sera visible por otros)</small>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="userHelp" placeholder="Enter user" required>
        <small id="userHelp" class="form-text text-muted">Se enviara una clave de verificacion</small>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>



<script>
document.getElementById("registerA").style.display ="none";
</script>
