<?php 
    session_start();
    if(isset($_SESSION['userName'])){
        unset($_SESSION['userName']);
        unset($_SESSION['password']);
        unset($_SESSION['id_usuario']);
    }
    header("Location: index.php")
?>