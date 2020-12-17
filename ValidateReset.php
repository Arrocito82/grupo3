<?php 
   
   require "Components/header.php";
   
   use Utils\ResetPassword as Reset;

    if(!isset($_GET['token'])){
        header("Location: index.php");
    } 
    
    $userId = Reset::ValidateToken($_GET['token']);
    
    if($userId != "Invalido"){
        $_SESSION['userId'] =$userId;
        header("Location: SetNewPass.php");
        
    }
    printf('<div class="container">
                <div class="alert alert-danger" role="alert"> Este token es invalido o  ya fue usado</div>
            <div>');

?>