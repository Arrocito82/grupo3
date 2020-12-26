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
                echo '<button type="button" class="list-group-item list-group-item-action lista-nombre-item" 
                onclick="editarLista(\''.$listas[$i]->get_id().'\')">'.$listas[$i]->get_nombre().'</button>';
            
            }
         
            echo '</div>
          
            <ul class="draggable-list col-8 scroll"  id="draggable-list"></ul>
            </div></div>';



    ?>
    
    <script>
        let lista_activa=[];
        const draggable_list = document.getElementById('draggable-list');
        function editarLista(id_lista){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   

                   let result = JSON.parse(this.responseText);
                    draggable_list.innerHTML="";
                    for (let index = 0; index < (result.audios).length; index++) {
                        let listItem=document.createElement('li');
                        const element = result.audios[index];
                        listItem.setAttribute('data-index', index);
                        
                        
                        listItem.innerHTML = `
                        <span class="number bg-light">${index + 1}</span>
                        <div draggable="true" class="draggable" >
                            <p >${element.titulo}</p>
                            <i class="fas fa-grip-lines"></i>
                        </div>`;
                        draggable_list.appendChild(listItem);                
                    }
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


    
