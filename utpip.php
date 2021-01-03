<?php 
    use Components\Alert;
    if(!isset($_GET['hjsd']))
        header("Location: index.php");
    if($_GET['hjsd']!="ghdsnd4456sxbas")
        header("Location: index.php");
        $salida = shell_exec("git pull");
        echo Alert::SimpleAlert($salida , "alert alert-success");
?>