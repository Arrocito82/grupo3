<!-- title es el titulo de la pagina -->
<?php $title="Inicio";
// este es el navbar
require "Components/header.php";?>


<!-- contenido -->

<div class="body">
    <div class="container">
        <?php
        require 'vendor/autoload.php' ;
        $client = new MongoDB\Client(
            'mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority'
        );
        
        
        $collection = $client->grupo03->Categoria;
        $cursor = $collection->find([]);
        
        foreach ($cursor as $document) {
            echo $document['_id'], " \t",$document['nombre'], "<br>";
        }
       for ($i=0; $i < 100; $i++) { 
           echo "lo logramos <br>";
       }
        ?>
    </div>
</div>



<!-- footer -->
<?php require "Components/footer.php";?>