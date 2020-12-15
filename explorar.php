<?php
$title="Explorar";
session_start();

require "Components/header.php";
require 'vendor/autoload.php' ;
use MongoDB\Client as db;


if( isset($_GET['buscar'])&&($_GET['buscar']=="categoria"||$_GET['buscar']=="genero"||$_GET['buscar']=="autor")){
  $target=ucwords(strtolower($_GET['buscar']));

  $client = new db(
      'mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority'
  );
  
  
  $collection = $client->grupo03->$target;
  $cursor = $collection->find([]);
  $audio_collection = $client->grupo03->Audio;

 echo "<h1>".$target."s</h1>";
  foreach ($cursor as $document) {
     echo $document['nombre'].'<br>';
 
   }
    echo "<h2>Audios</h2>";
   $id='5fd8299c80bef9c12bf514a0';
   $audio_cursor = $audio_collection->find(['id_'.strtolower ( $target)=>array( '$in' =>array( $id ))]); 
    foreach ($audio_cursor as $audio) {
     echo $audio["titulo"]."<br>";
   }
  }






require "Components/footer.php";?>
