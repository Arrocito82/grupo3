<?php 
$title="Administrar Listas";
use Repositories\UsuarioRepo;
require "Components/header.php";
require "Components/clases.php";


if(isset($_SESSION['id_usuario'])){
   
   $listas = UsuarioRepo::ObtenerSimpleListasUsuario($_SESSION['id_usuario']);
    
    


echo "  <div class='container'><h1 class='mx-0'>Mis Listas</h1>";



echo '      <div class="row">
                <div class="list-group col-4">';
                
                for ($i=0; $i <2 ; $i++) { 
                    echo '<button type="button" class="list-group-item list-group-item-action lista-nombre-item" 
                    onclick="fetchLista(\''.$listas[$i]->_id.'\')">'.$listas[$i]->nombre.'</button>';
                }
                    
                   
                
                
            
                echo '</div>
                <div class="col-8" >

                <div class="scroll overflow-auto border border-secondary rounded-sm" style="max-height:65vh;">
                    <ul class="draggable-list m-0"  id="draggable-list"></ul>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button onclick="actualizar()" type="button" class="btn btn-outline-success my-2 ">Actualizar</button>
                    <button type="button" class="btn btn-outline-danger my-2 mr-1" onclick="eliminar()">Eliminar</button>
                    <button type="button" class="btn btn-outline-secondary my-2 mr-1" onclick="reset()">Cancelar</button>
                    
                </div>
                </div>
        </div>';



    ?>
    
    <script>
        let lista_activa=[];
        let fuente,destino,current_list;
        const draggable_list = document.getElementById('draggable-list');

        
        function fetchLista(id_lista){
            current_list=id_lista;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   
                    // console.log(JSON.parse(this.responseText));
                   let result = JSON.parse(this.responseText);
                    draggable_list.innerHTML="";
                    
                    
                    for (let index = 0; index < result.length; index++) {
                        let listItem=document.createElement('li');
                        const element = result[index];
                        
                        listItem.setAttribute('data-index', index);
                        listItem.setAttribute('draggable', true);
                        
                        listItem.classList.add('text-left');
                        listItem.id=`${element._id}`;
                        listItem.innerHTML = `
                            <input type="checkbox"  id="delete_ids" value="${element._id}" style="margin:1.5rem 0 1.5rem 1rem;">
                            <div class="draggable">
                                <p>${element.titulo}</p>
                                <i class="fas fa-grip-lines"></i>
                            </div>`;
                        
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
        document.querySelectorAll('button.list-group-item')[0].click();
        function reset(){
            fetchLista(current_list);
        }

        function actualizar() {
            var xhttp = new XMLHttpRequest();
            var list_aux = document.querySelectorAll("#draggable-list li");
            let ids_lista=[];
            
            for (let index = 0; index < list_aux.length; index++) {
                const element = list_aux[index];
                ids_lista[index]=element.getAttribute('id');
            }
            let consulta=JSON.stringify({
                "crud": "update",
                'lista_id': current_list,
                'audios_id':ids_lista
            });
            
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };


            xhttp.open("POST", "crud_lista.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");

            xhttp.send(consulta);
        } 
        function eliminar() {
            var xhttp = new XMLHttpRequest();
            var list_aux = document.querySelectorAll("#delete_ids");
            let ids_lista=[];
            
            list_aux.forEach(element => {
                if(element.checked){
                    ids_lista.push(element.value);
                }
            });
          
                
            let consulta=JSON.stringify({
                "crud": "delete",
                'lista_id': current_list,
                'audios_id':ids_lista
            });
            
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    reset();
                    console.log(this.responseText);
                }
            };


            xhttp.open("POST", "crud_lista.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");

            xhttp.send(consulta);
        }
        function dragStart() {
            index=+this.closest('li').getAttribute('data-index');
            
        }


        function dragLeave() {
            this.classList.remove('over');
            
            
        }

        function dragOver(e) {
            e.preventDefault(); 
            
            this.classList.add('over');
            
        }

        function dragDrop() {
            
            this.classList.remove('over');
            this.classList.remove('drag');
            end_index=+this.closest('li').getAttribute('data-index');
            
            mover();
            
        }

        function mover(){

            var list = document.querySelector("#draggable-list");
         
            list.insertBefore(list.childNodes[index], list.childNodes[end_index]);
            
            
            var list_aux = document.querySelectorAll("#draggable-list li");
            
            for (let i = 0; i < list_aux.length; i++) {
                var attr = document.createAttribute("data-index");
                attr.value =i;
                list_aux [i].removeAttribute("data-index");;
                list_aux [i].setAttributeNode(attr);
                
            }
               
        }

        
        function addEventListeners(){
            
            let listItems=document.querySelectorAll('.draggable-list li');
            
            listItems.forEach(item=>{
                item.addEventListener('dragover',dragOver);
                item.addEventListener('drop',dragDrop);
                item.addEventListener('dragleave',dragLeave);
                item.addEventListener('dragstart',dragStart);

            });
        }

        

        
    </script>
    
    <?php
    require "Components/footer.php"; 
    }?>


    
