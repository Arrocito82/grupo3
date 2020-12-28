
<?php


$title="Explorar";
require "Components/header.php";
require "Components/clases.php";
use MongoDB\Client as db;
$uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
$client =  new db($uri);

echo '<div class="body container">'; 
if( isset($_GET['buscar'])&&($_GET['buscar']=="categoria"||$_GET['buscar']=="genero"||$_GET['buscar']=="autor")){
 
  
    $target=ucwords(strtolower($_GET['buscar']));
    
     if($target=="Autor"){echo "<h1>".$target."es</h1>";}else{
        echo "<h1>".$target."s</h1>";
     }
    $collection =$client->grupo03->$target;
    $audio_collection = $client->grupo03->Audio;

    //recuperando la lista del target filtro y conviertiendo a array
    $target_array=($collection->find([]))->toArray();


            for ($i=0;$i<count($target_array); $i++) {
                echo '<h5>'.$target_array[$i]['nombre'].'</h5>';
                $id= $target_array[$i]['_id'];
                settype($id,'string');
                $audio_cursor = ($audio_collection->find(['id_'.strtolower ( $target)=>array( '$in' =>array( $id ))]))->toArray();
                echo '<div class="row">';

                    //recorriendo los audios para ver cuales son de este elemento de la lista del target
                    for ($j=0; $j <count($audio_cursor) ; $j++) { 
                        
                        $tmp = new Audio($audio_cursor[$j]["_id"]);
                        ?>


                        <!--impriendo tarjeta de la cancion  -->
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $tmp->get_titulo();?></h5>
                                    <p class="card-text">
                                        Autor:  <?php 
                                        $autor=$tmp->get_autores();
                                        for ($x=0; $x <count($autor) ; $x++) {
                                            if($x>0){
                                                echo ", ";
                                            }
                                            echo $autor[$x]->get_nombre();
                                            
                                        }
                                        echo ".";
                                        unset($x);
                                        echo "<br>";?>
                                        Genero: <?php 
                                        $genero=$tmp->get_generos();
                                        for ($x=0; $x <count($genero) ; $x++) { 
                                            if($x>0){
                                                echo ", ";
                                            }
                                            echo $genero[$x]->get_nombre();
                                            
                                        }
                                        echo ".";
                                        unset($x);
                                        echo "<br>";?>
                                        Categoria: <?php 
                                        $categoria=$tmp->get_categorias();
                                        for ($x=0; $x <count($categoria) ; $x++) { 
                                            if($x>0){
                                                echo ", ";
                                            }
                                            echo $categoria[$x]->get_nombre();
                                            
                                        }
                                        echo ".";
                                        unset($x);
                                        echo "<br>";?>
                                        Propietario: <?php echo ($tmp->get_usuario())->get_login().".<br>";?> 
                        
                                    </p>
                                    <a href="#" class="btn btn-primary">Reproducir</a>
                                </div>
                            </div>
                        </div>


                    <?php }//cierre del for audio
                    echo'</div>';                  
            }
    }else{

        $target=['Genero','Categoria','Autor'];
        $title=['Generos','Categorias','Autores'];
      
        for ($k=0; $k < 3; $k++) { 
           
        
    
    echo "<h2 class='mt-5'>".$title[$k] ."</h2>";
    $string=$target[$k];
    settype($string,'string');
    $collection =$client->grupo03->$string;
    $audio_collection = $client->grupo03->Audio;

    //recuperando la lista del target filtro y conviertiendo a array
    $target_array=($collection->find([]))->toArray();


            for ($i=0;$i<count($target_array); $i++) {
                echo '<h4 class="mt-3">'.$target_array[$i]['nombre'].'</h4>';
                $id= $target_array[$i]['_id'];
                settype($id,'string');
                $audio_cursor = ($audio_collection->find(['id_'.strtolower ( $string)=>array( '$in' =>array( $id ))]))->toArray();
                echo '<div class="row">';

                    //recorriendo los audios para ver cuales son de este elemento de la lista del target
                    for ($j=0; $j <count($audio_cursor) ; $j++) { 
                        
                        $tmp = new Audio($audio_cursor[$j]["_id"]);
                        ?>


                        <!--impriendo tarjeta de la cancion  -->
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $tmp->get_titulo();?></h5>
                                    <p class="card-text">
                                        Autor:  <?php 
                                        $autor=$tmp->get_autores();
                                        for ($x=0; $x <count($autor) ; $x++) {
                                            if($x>0){
                                                echo ", ";
                                            }
                                            echo $autor[$x]->get_nombre();
                                            
                                        }
                                        echo ".";
                                        unset($x);
                                        echo "<br>";?>
                                        Genero: <?php 
                                        $genero=$tmp->get_generos();
                                        for ($x=0; $x <count($genero) ; $x++) { 
                                            if($x>0){
                                                echo ", ";
                                            }
                                            echo $genero[$x]->get_nombre();
                                            
                                        }
                                        echo ".";
                                        unset($x);
                                        echo "<br>";?>
                                        Categoria: <?php 
                                        $categoria=$tmp->get_categorias();
                                        for ($x=0; $x <count($categoria) ; $x++) { 
                                            if($x>0){
                                                echo ", ";
                                            }
                                            echo $categoria[$x]->get_nombre();
                                            
                                        }
                                        echo ".";
                                        unset($x);
                                        echo "<br>";?>
                                        Propietario: <?php echo ($tmp->get_usuario())->get_login().".<br>";?> 
                        
                                    </p>
                                    <a href="#" class="btn btn-primary">Reproducir</a>
                                </div>
                            </div>
                        </div>


                    <?php }//cierre del for audio
                    echo'</div>';        
            }
    }


}
    require "Components/footer.php";
    ?>
