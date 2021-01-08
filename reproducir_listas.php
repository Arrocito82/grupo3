<?php 
$title="Administrar Listas";
use Repositories\UsuarioRepo;
require "Components/header.php";

if(!(isset($_SESSION['userName']))){

    header("Location: index.php");
}

if(isset($_SESSION['id_usuario'])){
   
   $listas = UsuarioRepo::ObtenerSimpleListasUsuario($_SESSION['id_usuario']);
    
    


echo "  <div class='container' style='min-height:60vh;'>

<div class='row'>
    <h1 class='mx-0 col-md-6 col-sm-12'>Mis Listas</h1>
    <div  id='reproducir_lista'  class='mt-auto mb-1 col-md-6 col-sm-12 h-75 ' style='display:none;'>
    
    <button type='button' class='btn btn-primary ' onclick='reproducirTodos();'> <i class='fas fa-play'></i> Reproducir Lista</button>
    </div>
</div>";



echo '      <div class="row">
                <div class="list-group col-4" id="listas-selector"> ';
                
                for ($i=0; $i <2 ; $i++) { 
                    echo '<button type="button" class="list-group-item list-group-item-action lista-nombre-item" 
                    onclick="fetchLista(\''.$listas[$i]->_id.'\')">'.$listas[$i]->nombre.'</button>';
                }
                    
                   
                
                
            
                echo '<div class="bg-light d-block rounded p-2 mt-1" id="audio_controls_div" >
                <audio controls id="audio_controls" class="w-100" preload="auto">
                <source src="" type="audio/ogg">
                <source src="" type="audio/wav">
                <source src="" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
                </div></div>
                <div class="col-8" >
                    
                    <div class="scroll overflow-auto " style="max-height:65vh;" id="scroll_box">
                        <p id="mensaje" class="text-muted">Lista Vacia.</p>
                        
                        <ul class="draggable-list m-0"  id="draggable-list"></ul>
                    </div>
                    <div class="d-flex flex-row-reverse" id="controles">
                    </div>
                </div>
            </div></div>';



    ?>


<script src="public/js/reproducir_listas.js"></script>

<?php
    require "Components/footer.php"; 
    }?>