<?php 
    session_start();
    if(isset($_SESSION['userName'])){
        unset($_SESSION['userName']);
        unset($_SESSION['password']);
    }
    header("Location: index.php")
?>