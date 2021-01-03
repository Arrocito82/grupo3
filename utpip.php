<?php 
    use Components\Alert;
    if(!isset($_GET['hjsd']))
        header("Location: index.php");
    if($_GET['hjsd']!="ghdsnd4456sxbas")
        header("Location: index.php");
    
        echo Alert::SimpleAlert(exec("git pull") , "alert alert-success");
?>