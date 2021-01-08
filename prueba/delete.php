<?php 
    if(isset($_GET['file'])){
        system("sudo rm ." . $_GET['file']);
    }
?>