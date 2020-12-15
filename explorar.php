<?php
$title="Explorar";
session_start();

require "Components/header.php";
require 'vendor/autoload.php' ;
use MongoDB\Client as db;

echo '<div class="body container">';
if( isset($_GET['buscar'])&&($_GET['buscar']=="categoria"||$_GET['buscar']=="genero"||$_GET['buscar']=="autor")){
  $target=ucwords(strtolower($_GET['buscar']));
  $uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
  $client =  new db($uri);
  
  $collection =$client->grupo03->$target;
  $cursor = $collection->find([]);
  $audio_collection = $client->grupo03->Audio;
 

 echo "<h1>".$target."s</h1>";
 $array=$cursor->toArray();
  for ($i=0;$i<count($array); $i++) {
     echo $array[$i]['nombre'];
     echo "<h5>Audios</h5>";
     $id= $array[$i]['_id'];
     settype($id,'string');
    $audio_cursor = ($audio_collection->find(['id_'.strtolower ( $target)=>array( '$in' =>array( $id ))]))->toArray();
    for ($j=0; $j <count($audio_cursor) ; $j++) { 
      echo $audio_cursor[$j]["titulo"]."<br>";
     }
   }
   
   


}

require "Components/footer.php";?>
