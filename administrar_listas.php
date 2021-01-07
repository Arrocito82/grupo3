<?php 
$title="Administrar Listas";
use Repositories\UsuarioRepo;
require "Components/header.php";
require "Components/clases.php";
if(!(isset($_SESSION['userName']))){

    header("Location: index.php");
}

if(isset($_SESSION['id_usuario'])){
   
   $listas = UsuarioRepo::ObtenerSimpleListasUsuario($_SESSION['id_usuario']);
    
    


echo "  <div class='container'style='min-height:60vh;'><h1 class='mx-0'>Mis Listas</h1>";



echo '      <div class="row">
                <div class="list-group col-4">';
                
                for ($i=0; $i <2 ; $i++) { 
                    echo '<button type="button" class="list-group-item list-group-item-action lista-nombre-item" 
                    onclick="fetchLista(\''.$listas[$i]->_id.'\')">'.$listas[$i]->nombre.'</button>';
                }
                    
                   
                
                
            
                echo '</div>
                <div class="col-8" >
                    <div style="display:none;" id="all_ids_div"  class="pl-2">
                        <input type="checkbox" id="all_ids" class="m-2 mr-0 p-0"><label for="all_ids" class="ml-2 pl-0">Seleccionar Todos</label>
                    </div>
                    <div class="scroll overflow-auto " style="max-height:65vh;" id="scroll_box">
                        <p id="mensaje" class="text-muted">Lista Vacia.</p>
                        
                        <ul class="draggable-list m-0"  id="draggable-list"></ul>
                    </div>
                    <div class="d-flex flex-row-reverse" id="controles">
                    </div>
                </div>
            </div></div>';



    ?>

<script src="public/js/administrar_listas.js"></script>

<?php
    require "Components/footer.php"; 
    }?>