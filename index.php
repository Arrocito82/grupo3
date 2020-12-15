<!-- title es el titulo de la pagina -->
<?php

$title="Inicio";
// este es el navbar
session_start();

if(isset($_SESSION['userName']))
    $User =$_SESSION['userName'];
require "Components/header.php";

use MongoDB\Client as db;
?>

<!-- contenido -->

<div class="body">

    <div class="container">
        <?php
        require 'vendor/autoload.php' ;
        $client = new db(
            'mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority'
        );
        
        
        $collection = $client->grupo03->Categoria;

        //$result = $collection->insertOne( [ 'nombre' => 'bailable' ] );
        
        //echo "Inserted with Object ID '{$result->getInsertedId()}'";
        //$cursor = $collection->find(['nombre' => 'bailable']);
        $cursor = $collection->find([]);
        
        foreach ($cursor as $document) {
            echo $document['_id'], " \t",$document['nombre'], "<br>";
        }
        ?>
    </div>
</div>



<!-- footer -->
<?php require "Components/footer.php";?>