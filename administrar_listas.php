<?php 
$title="Administrar Listas";
require "Components/header.php";
require "Components/clases.php";


if(isset($_SESSION['id_usuario'])){
   $user=new Usuario($_SESSION['id_usuario']);
   $listas=$user->get_listas();
    
    

   echo "<div class='contenido'>";
echo "<div class='container'>";



echo '<div class="row">
            <div class="list-group col-4">';
            for ($i=0; $i < count($listas) ; $i++) {
                echo '<button type="button" class="list-group-item list-group-item-action list-group-item-secondary" 
                onclick="editarLista(\''.$listas[$i]->get_id().'\')">'.$listas[$i]->get_nombre().'</button>';
            
            }
        
            echo '</div>
            <div class="col-8 scroll" id="lista_activa">
            <div class="drag  mt-5">
            <section id="table" class="SortableContainer"></section>
            </div></div>
            </div></div>';



    ?>
    
    <script>
        function editarLista(id_lista){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   

                   let result = JSON.parse(this.responseText);
                    let lista = "";
                    for (let index = 0; index < (result.audios).length; index++) {
                        const element = result.audios[index];
                        lista = lista + '<div id= class="list-item"><div class = "item-content" value="'+  element.id +'"><span class = "order" > '+(index+1)+ '</span>' + element.titulo + '</div > </div>';
                    }

                    console.log(typeof lista);
                    document.getElementById('table').innerHTML=lista;
                }
            };
            xhttp.open("POST", "lista.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(JSON.stringify([{"crud":"find"},{
                "_id": {
                    "$oid": id_lista
                }
            }]));
        }
        
    </script>
    
    <?php
    require "Components/footer.php"; 
    }?>


    
