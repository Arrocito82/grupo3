<?php 
    use Components\Alert;
    require 'Components/header.php';
    if(!isset($_GET['hjsd']))
        header("Location: index.php");
    if($_GET['hjsd']!="ghdsnd4456sxbas")
        header("Location: index.php");
        

    //$salida = system("git pull");
    //echo $salida;
    echo Alert::SimpleAlert(system("git pull") , "alert alert-success");
?>