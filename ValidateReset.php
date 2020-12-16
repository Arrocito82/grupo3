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
    printf('Este token ya fue usado');

?>