<?php

$title="Explorar";
require "Components/header.php";
use Repositories\AutorRepo;
use Repositories\CategoriaRepo;
use Repositories\GeneroRepo;


if(isset($_SESSION['id_usuario'])){
if(isset($_GET['buscar'])&&($_GET['buscar']=="categorias"||$_GET['buscar']=="generos"||$_GET['buscar']=="autores")){



    if($_GET['buscar']=="categorias"){
        //$consulta=CategoriaRepo::ObtenerTodasCategorias();
        $consulta=CategoriaRepo::ObtenerCategorias(['5fef8f1ab883756d8ad0d3c3','5fdbd81ba2aa16d0b4bc65f6']);
    }else if($_GET['buscar']=="generos"){
        $consulta=GeneroRepo::ObtenerTodosGeneros(); 
    }else if($_GET['buscar']=="autores"){
        $consulta=AutorRepo::ObtenerTodosAutores();
    }
    $target=$_GET['buscar'];
    $resultado = $consulta;
    $json_resultado=json_encode($resultado);
   
    
    
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
let dropDown,result;
console.log(json_resultado);

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

dropDownMenu();

function cargar(){
    
    if( ultimo_target < json_resultado.length) {
                    //ultimo
                    //id
                    var http = new XMLHttpRequest();

                    //acciones cuando llegue el resultado
                    http.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {

                            audios=this.responseText;
                            dropDown = `
                            <div class="btn-group dropright btn-block">
                                <button type="button" class="btn btn-primary">Agregar a Favoritos</button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">`;
                                for (let index = 0; index<result.length; index++) {
                                    const element=result[index];
                                    dropDown+=`<div class="dropdown-item" onclick='agregar_lista("${element._id}")'>${element.nombre}</div>`; 
                                    
                                }
                                
                            dropDown +=`</div></div>`;
                            document.getElementById(destino).insertAdjacentHTML("beforeend",
                            audios );
             
                         
                        datos=document.querySelectorAll("#"+destino+" .col-sm-6.col-md-4.col-lg-3.my-4 .card").length;
                        if(datos%cantidad!=0||(this.responseText)=="[]"){
                           
                            
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

cargar();
window.addEventListener("scroll", function() {
    
    if(document.documentElement.scrollHeight - document.documentElement.scrollTop === document.documentElement.clientHeight){
      cargar();
    }

});


</script>
    <?php }}             

require "Components/footer.php";?>
