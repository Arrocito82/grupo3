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
   
    
    
   echo '<div class="container contenido">'; 
   
    echo"<h1>".$target."</h1>"; 
   
    $destino="audios";
    echo '<div class="row" id="'.$destino.'"></div></div>'; 
 ?>
   

<script>
//jshint esversion: 6




let ultima_posicion = 0;
let destino="<?php echo $destino;?>";
let id_usuario="<?php if(isset($_SESSION['id_usuario'])){echo $id_usuario;}?>"
let cantidad=12;
let json_resultado=<?php echo $json_resultado; ?>;
let buscar="<?php echo $target;?>", limite=cantidad,ultimo=0,ultimo_target=0;
let cargando = false;
let result;

function agregar_lista(id,audio){
console.log(id,audio);
}
function dropDownMenu(){
    
                    var http = new XMLHttpRequest();

                    //acciones cuando llegue el resultado
                    http.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            result=JSON.parse(this.responseText);
                            
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
                                            <a href="#" class="btn btn-primary btn-block">Reproducir</a>
                                            ${dropDown}
                                        </div>
                                    </div>
                                </div>`;
                                 
                                 document.getElementById(destino).insertAdjacentHTML("beforeend",audio);
                            });
                            
             
                         
                        datos=document.querySelectorAll("#"+destino+" .col-sm-6.col-md-4.col-lg-3.my-4 .card").length;
                        
                        if(datos%cantidad!=0||audios.length==0){
                            
                            
                            ultimo_target++;ultimo=0;limite=cantidad-datos%cantidad;
                            //console.log(ultimo_target);console.log(audios);
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


window.addEventListener("scroll", function() {
    
    if(document.documentElement.scrollHeight - document.documentElement.scrollTop === document.documentElement.clientHeight){
      cargar();
    }

});
dropDownMenu();cargar();

</script>
    <?php }}             

require "Components/footer.php";?>
