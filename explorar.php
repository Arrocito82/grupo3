<?php

$title="Explorar";
require "Components/header.php";
use Repositories\AutorRepo;
use Repositories\CategoriaRepo;
use Repositories\GeneroRepo;


if(isset($_SESSION['id_usuario'])){
if(isset($_GET['buscar'])&&($_GET['buscar']=="categorias"||$_GET['buscar']=="generos"||$_GET['buscar']=="autores")){



    if($_GET['buscar']=="categorias"){
        $consulta=CategoriaRepo::ObtenerTodasCategorias();
        
    }else if($_GET['buscar']=="generos"){
        $consulta=GeneroRepo::ObtenerTodosGeneros(); 
    }else if($_GET['buscar']=="autores"){
        $consulta=AutorRepo::ObtenerTodosAutores();
    }
    $target=$_GET['buscar'];
    
    $json_resultado=json_encode($consulta);
   
    
    
   echo '<div class="container">'; 
   
    echo"<h1 >".ucfirst($target)."</h1>"; 
   
    
    echo '<div class="row" id="audios"></div></div>'; 
 ?>
   

<script>
//jshint esversion: 6





let destino="audios",first_time=true;
let id_usuario="<?php if(isset($_SESSION['id_usuario'])){echo $id_usuario;}?>"
let cantidad=12;
let json_resultado=<?php echo $json_resultado; ?>;
let buscar="<?php echo $target;?>", limite=cantidad,ultimo=0,ultimo_target=0;
let cargando = false;
let result;

function agregar_lista(id_lista,id_audio){
    var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   
                    // console.log(JSON.parse(this.responseText));
                   console.log(this.responseText);
                    
                }
            };
            xhttp.open("POST", "crud_lista.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(JSON.stringify({"crud":"add",
                                        "lista_id":id_lista,
                                        "audio_id":id_audio
                                        }));      
}
function dropDownMenu(){
    
                    var http = new XMLHttpRequest();

                    //acciones cuando llegue el resultado
                    http.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            result=JSON.parse(this.responseText);
                            cargar();
                            window.addEventListener("scroll", function() {
    
                                if(document.documentElement.scrollHeight - document.documentElement.scrollTop === document.documentElement.clientHeight){
                                cargar();
                                }

                            });
                        }}

                    http.open("POST", "Components/procesar.php", true);
                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    http.send(`id_usuario=${id_usuario}`);
                    
                    
        }



function cargar(){
    
    if( ultimo_target < json_resultado.length) {
                    //ultimo
                    //id

                    var http = new XMLHttpRequest();

                    //acciones cuando llegue el resultado
                    http.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {

                            audios=JSON.parse(this.responseText);
                            if(first_time==true){
                                first_time=false;
                                if(audios.length!=0){
                                target_title=`
                                <div class="card w-100 mx-3 text-white bg-secondary mt-3">
                                <div class="card-body">
                                    <h4 class="card-title  ">${json_resultado[ultimo_target].nombre}</h4>
                                </div>
                                </div>
                                `;
                                document.getElementById(destino).insertAdjacentHTML("beforeend",target_title);
                                }
                            }
                            

                             audios.forEach(element => {
                                let autores='',generos= '',categorias='';
                                
                                if(element.categorias){
                                    categorias='Categorias:';
                                    
                                    for (let x = 0; x < (element.categorias).length; x++) {
                                        
                                        categorias+=` ${element.categorias[x].nombre}`;
                                        if((element.categorias).length-1==x){
                                            categorias+='.</br>';
                                        }else{
                                            categorias+=', ';
                                        }
                                    }
                                    
                                    
                                } 
                               if(element.generos){
                                    generos='Generos:';
                                    
                                    for (let x = 0; x < (element.generos).length; x++) {
                                        
                                        generos+=` ${element.generos[x].nombre}`;
                                        if((element.generos).length-1==x){
                                            generos+='.</br>';
                                        }else{
                                            generos+=', ';
                                        }
                                    }
                                    
                                    
                                } 
                               if(element.autores){
                                    autores='Autores:';
                                    
                                    for (let x = 0; x < (element.autores).length; x++) {
                                        
                                        autores+=` ${element.autores[x].nombre}`;
                                        if((element.autores).length-1==x){
                                            autores+='.</br>';
                                        }else{
                                            autores+=', ';
                                        }
                                    }
                                    
                                    
                                } 
                               
                                let dropDown = `
                            <div class="btn-group dropright btn-block">
                                <button type="button" class="btn btn-primary">Agregar a Favoritos</button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">`;
                                for (let index = 0; index<result.length; index++) {
                                    const lista=result[index];
                                    dropDown+=`<div class="dropdown-item" onclick="agregar_lista('${lista._id}','${(element._id).$oid}')">${lista.nombre}</div>`; 
                                    
                                }
                                
                            dropDown +=`</div></div>`;
                                let audio=` 
                                <div class="col-sm-6 col-md-4 col-lg-3 my-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">${element.titulo}</h5>
                                            <p class="card-text">
                                                ${autores}
                                                ${generos}
                                                ${categorias}
                                            </p>
                                            <a onclick="reproducir('${element._id.$oid}' ,event)" class="btn btn-primary btn-block">Reproducir</a>
                                            ${dropDown}
                                        </div>
                                    </div>
                                </div>`;
                                 
                                 document.getElementById(destino).insertAdjacentHTML("beforeend",audio);
                            });
                            
             
                         
                        datos=document.querySelectorAll("#"+destino+" .col-sm-6.col-md-4.col-lg-3.my-4 .card").length;
                        
                        if(datos%cantidad!=0||audios.length==0){
                            
                            first_time=true;
                            ultimo_target++;ultimo=0;limite=cantidad-datos%cantidad;
                            
                            cargar(); 
                           
                        }
                        }
                    };

                    //enviando peticion
                    http.open("POST", "Components/procesar.php", true);
                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    http.send("buscar="+buscar+"&id="+json_resultado[ultimo_target].id+"&ultimo="+ultimo+"&limite="+limite);
                    ultimo=limite;
                    limite+=limite;
                    
        }
}
dropDownMenu();

function reproducir(id , event) {
   
    let element = event.path[0];
    if(element.parentElement.children[3].classList.contains("alert")){
    return 0;}
       
            let xhttp = new XMLHttpRequest();
            consulta=JSON.stringify({
                        'crud':'recuperar',
                        'audio_id':id
                        });
            xhttp.onreadystatechange = function() {
                
                if (this.readyState == 4 && this.status == 200) {
                    result=JSON.parse(this.responseText);
                    
                       
                    element.insertAdjacentHTML('afterend',`<div class="alert alert-light fade show flex flex-column d-flex justify-content-between mx-0 px-0 py-0 mt-2" role="alert" 
                    style="
                    width: 253px;
                    position: relative;
                    left: -20px;">
                  
                  <div class="d-flex justify-content-center">
                        <audio controls id="audio_controls"                        ">
                        <source src="${result[0]}" type="audio/ogg">
                        <source src="${result[0]}" type="audio/wav">
                        <source src="${result[0]}" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio>
                  </div>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="
                  width: 32px;
    height: 32px;
    background: red;
    justify-self: center;
    align-self: center;
    justify-content: center;
    align-items: center;
    border-radius: 50px;"
                  >
                  <span aria-hidden="true" style="position: relative;bottom: 3px;">&times;</span>
                  </button></div>`);
                        

                }
            };
            xhttp.open("POST", "crud_audio.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(consulta);

           
            
      }

</script>
    <?php }}             

require "Components/footer.php";?>
