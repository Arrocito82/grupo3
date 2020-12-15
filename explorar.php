<?php

$path="";
$title="Explorar";
require "Components/header.php";
use MongoDB\Client as db;
$uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
$client =  new db($uri);
if( isset($_GET['buscar'])&&($_GET['buscar']=="categoria"||$_GET['buscar']=="genero"||$_GET['buscar']=="autor")){
 
  echo '<div class="body container">';
  echo "<h1>".$title ."</h1>";
  $target=ucwords(strtolower($_GET['buscar']));
  
  
  $collection =$client->grupo03->$target;
  $cursor = $collection->find([]);
  $audio_collection = $client->grupo03->Audio;
 

 echo "<h2>".$target."s</h2>";
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
}else{
  $title="Buscar";
 
 echo "<div class='body'><div class='container my-5'> <h2>".$title ."</h2> ";?>
   
  <form>
    
    <div class="form-row">
      <div class="form-group col-md-10">
       
        <input type="text" class="form-control" name="buscar_textbox" >
      </div>
      <button type="submit" class="btn btn-outline-success col-md-2 form-group">Buscar</button>
    </div>
  
    <div>
          <div class="form-check form-check-inline p-1">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="categoria">
            <label class="form-check-label" for="inlineCheckbox1">Categoria</label>
        </div>
        <div class="form-check form-check-inline p-1">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="autor">
            <label class="form-check-label" for="inlineCheckbox2">Autor</label>
        </div>
        <div class="form-check form-check-inline p-1">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="genero">
            <label class="form-check-label" for="inlineCheckbox3">Género</label>      
        </div>
        <div class="form-check form-check-inline p-1">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="todos" checked>
            <label class="form-check-label" for="inlineCheckbox3">Todos</label>      
        </div>
    </div>
  </form>
</div>


<?php
}
require "Components/footer.php";?>
