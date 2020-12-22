<?php 
    use Utils\FilesAuth\File;
    require 'Components/header.php';
    $file="notfound.jpg";

    if( isset($_GET['file']) & isset($_GET['ext']) )
        $file=$_GET['file'] . "." . $_GET['ext'];//se le agrega la extension
    //en audi.html
    //                                  carpeta        nombre de archivo                extension     mimeType
    // <source src="load_file.php?file=uploaded_files/31e1ac969bc5da561928c96931290031&ext=mp3" type="audio/mp3">
  
    //Validar si tiene permiso (falta)
    if(TRUE)
    File::ServeFile($file , null, TRUE); //True es para servirlo como Streaming
?>