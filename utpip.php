<?php 
    if(!isset($_GET['hjsd']))
        header("Location: index.php");
    if($_GET['hjsd']!="ghdsnd4456sxbas")
        header("Location: index.php");
    
        echo shell_exec("sudo git pull");
?>