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

                    <div class="scroll overflow-auto " style="max-height:65vh;" id="scroll_box">
                        <p id="mensaje" class="text-muted">Lista Vacia.</p>
                        <ul class="draggable-list m-0"  id="draggable-list"></ul>
                    </div>
                    <div class="d-flex flex-row-reverse" id="controles">
                    </div>
                </div>
            </div>';



    ?>
    
    <script>
        let lista_activa=[];
        let fuente_id,current_list,index,end_index;
        const draggable_list = document.getElementById('draggable-list');
        const p= document.querySelector('#scroll_box p');
        
        function fetchLista(id_lista){
            current_list=id_lista;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   
                    // console.log(JSON.parse(this.responseText));
                   let result = JSON.parse(this.responseText);
                    draggable_list.innerHTML="";
                    p.style.display='none';
                    if(result.length>0){
                            for (let e = 0; e < result.length; e++) {
                                let listItem=document.createElement('li');
                                const element = result[e];
                                
                                listItem.setAttribute('data-e', e);
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
                            
                            document.getElementById('controles').innerHTML=`<button type="button" class="btn btn-outline-danger my-2 mr-1" onclick="eliminar()">Eliminar</button>
                            <button type="button" class="btn btn-outline-secondary my-2 mr-1" onclick="reset()">Cancelar</button>`;
                            document.getElementById('scroll_box').classList.add('border');
                            document.getElementById('scroll_box').classList.add('border-secondary');
                            document.getElementById('scroll_box').classList.add('rounded-sm');
                            
                    }else{
                        document.getElementById('controles').innerHTML='';
                        p.style.display='block';
                        document.getElementById('scroll_box').classList.remove('border');
                        document.getElementById('scroll_box').classList.remove('border-secondary');
                        document.getElementById('scroll_box').classList.remove('rounded-sm');
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
            let xhttp = new XMLHttpRequest();
            
            let consulta=JSON.stringify({
                "crud": "update",
                'lista_id': current_list,
                'fuente_id':fuente_id,
                'destino':end_index
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
            let xhttp = new XMLHttpRequest();
            let list_aux = document.querySelectorAll("#delete_ids");
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
            fuente_id=this.closest('li').getAttribute('id');
            console.log(fuente_id);
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
            actualizar();
            
            
        }

        function mover(){

            let list = document.querySelector("#draggable-list");
         
            list.insertBefore(list.childNodes[index], list.childNodes[end_index]);
            
            
            let list_aux = document.querySelectorAll("#draggable-list li");
            
            for (let i = 0; i < list_aux.length; i++) {
                let attr = document.createAttribute("data-index");
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


    
