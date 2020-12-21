
<?php
require '../vendor/autoload.php' ;
require "clases.php";
use MongoDB\Client as db;
$uri='mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority';
$client =  new db($uri);

//cambiar a metodo post
if( isset($_POST['buscar'])&&isset($_POST['id'])){
 
    if( isset($_POST['limite'])&&isset($_POST['ultimo'])){
        $limite=$_POST['limite'];
        $ultimo=$_POST['ultimo'];
        settype($limite,'integer');
        settype($ultimo,'integer');

    $target=($_POST['buscar']);
    $id_busqueda=$_POST['id'];
    $collection =$client->grupo03->$target;
    $audio_collection = $client->grupo03->Audio;

    //recuperando la lista del target filtro y conviertiendo a array
    $target_array=$collection->findOne(array("_id"=> new MongoDB\BSON\ObjectId($id_busqueda)));
   


            
                if($ultimo==0){
                    echo '
                    <div class="container-fluid mt-5">
                    <div  class="bg-secondary text-white col-sm-12 px-3 py-5 rounded-lg">
                        <h1 class="display-4">'.$target_array['nombre'].'</h1>
                        
                    </div>
                    </div>';
                                        
                }
                $id= $target_array['_id'];
                
                settype($id,'string');
                $audio_cursor = ($audio_collection->find(['id_'.strtolower ( $target)=>array( '$in' =>array( $id ))],["limit"=>$limite]))->toArray();
                //if($ultimo==0){echo '<div class="row">';}

                    //recorriendo los audios para ver cuales son de este elemento de la lista del target
                    for ($j=$ultimo; $j <count($audio_cursor) ; $j++) { 
                        
                        $tmp = new Audio($audio_cursor[$j]["_id"]);
                        ?>


                        <!--impriendo tarjeta de la cancion  -->
                        <div class="col-sm-6 col-md-4 col-lg-3 my-4">
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
                                    <a href="#" class="btn btn-outline-primary">Reproducir</a>
                                </div>
                            </div>
                        </div>


                    <?php }//cierre del for audio
                // if($limite==count($audio_cursor)){echo'</div>';}               
            }
}?>

