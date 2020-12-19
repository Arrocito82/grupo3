
<?php
require 'vendor/autoload.php' ;
require "Components/clases.php";
use MongoDB\Client as db;
$uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
$client =  new db($uri);


if( isset($_GET['buscar'])&&isset($_GET['id'])&&($_GET['buscar']=="categoria"||$_GET['buscar']=="genero"||$_GET['buscar']=="autor")){
 
    if( isset($_GET['limite'])&&isset($_GET['ultimo'])){
        $limite=$_GET['limite'];
        $ultimo=$_GET['ultimo'];
        settype($limite,'integer');
        settype($ultimo,'integer');

    $target=ucwords(strtolower($_GET['buscar']));
    $id_busqueda=$_GET['id'];
    $collection =$client->grupo03->$target;
    $audio_collection = $client->grupo03->Audio;

    //recuperando la lista del target filtro y conviertiendo a array
    $target_array=$collection->findOne(array("_id"=> new MongoDB\BSON\ObjectId($id_busqueda)));


            
                if($ultimo==0){
                    echo '<h5>'.$target_array['nombre'].'</h5>';
                }
                $id= $target_array['_id'];
                
                settype($id,'string');
                $audio_cursor = ($audio_collection->find(['id_'.strtolower ( $target)=>array( '$in' =>array( $id ))],["limit"=>$limite]))->toArray();
                if($ultimo==0){echo '<div class="row">';}

                    //recorriendo los audios para ver cuales son de este elemento de la lista del target
                    for ($j=$ultimo; $j <count($audio_cursor) ; $j++) { 
                        
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
                    if($limite==count($audio_cursor)){echo'</div>';}               
            }
}?>
<script src="Components/prueba.js"></script>
