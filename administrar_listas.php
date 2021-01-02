<?php 
$title="Administrar Listas";
use Repositories\UsuarioRepo;
require "Components/header.php";
require "Components/clases.php";


if(isset($_SESSION['id_usuario'])){
   
   $listas = UsuarioRepo::ObtenerSimpleListasUsuario($_SESSION['id_usuario']);
    
    

echo "<div class='contenido'>";
echo "<div class='container'>";



echo '<div class="row">
            <div class="list-group col-4">';
            for ($i=0; $i < count($listas) ; $i++) {
                echo '<button type="button" class="list-group-item list-group-item-action lista-nombre-item" 
                onclick="fetchLista(\''.$listas[$i]->_id.'\')">'.$listas[$i]->nombre.'</button>';
            
            }
         
            echo '</div>
          
            <ul class="draggable-list col-8 scroll"  id="draggable-list"></ul>
            </div></div>';



    ?>
    
    <script>
        let lista_activa=[];
        let index;
        let index_id;
        const draggable_list = document.getElementById('draggable-list');


        function fetchLista(id_lista){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   
                    // console.log(JSON.parse(this.responseText));
                   let result = JSON.parse(this.responseText);
                    draggable_list.innerHTML="";
                    lista_activa=[];
                    console.log(result.audios[0]);
                    for (let index = 0; index < (result.audios).length; index++) {
                        let listItem=document.createElement('li');
                        const element = result.audios[index];
                        
                        listItem.setAttribute('data-index', index);
                        //listItem.setAttribute('id', element.id);
                        
                        
                        listItem.innerHTML = `
                        <span class="number bg-light" >${index + 1}</span>
                        <div draggable="true" class="draggable" >
                            <p>${element.nombre}</p>
                            <i class="fas fa-grip-lines"></i>
                        </div>`;
                        lista_activa.push(listItem);
                        draggable_list.appendChild(listItem);                
                    }
                    addEventListeners();
                }
            };
            xhttp.open("POST", "crud_lista.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(JSON.stringify({"crud":"find",
                                        "lista_id":id_lista
                                        }));            
        }
        function dragStart() {
            index=this.closest('li').getAttribute('data-index');
            index_id=this.closest('li').getAttribute('id');
            console.log(index);
            console.log(index_id.toString());
            
        }


        function dragLeave() {
            this.classList.remove('over');
        }

        function dragOver(e) {
            e.preventDefault(); 
            
            this.classList.add('over');
              
        }

        function dragDrop() {
            end_index=+this.closest('li').getAttribute('data-index');
            end_index_id=+this.closest('li').getAttribute('id');
            
            this.classList.remove('over');
            this.classList.remove('drag');
        }

        function addEventListeners(){
            const draggables=document.querySelectorAll('.draggable');
            const listItems=document.querySelectorAll('.draggable-list li');
            draggables.forEach(draggable=>{
                draggable.addEventListener('dragstart',dragStart);
            });
            listItems.forEach(item=>{
                item.addEventListener('dragover',dragOver);
                item.addEventListener('drop',dragDrop);
                item.addEventListener('dragleave',dragLeave);

            });
        }


        
    </script>
    
    <?php
    require "Components/footer.php"; 
    }?>


    
