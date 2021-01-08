<?php
$title = "Audios";
$style = "public/css/upload.css";
require 'Components/header.php';
use Repositories\AutorRepo;
use Repositories\CategoriaRepo;
use Repositories\GeneroRepo;
use Repositories\AudioRepo;
use Components\Alert;
if(!(isset($_SESSION['userName']))){

    header("Location: index.php");
}

if(isset($_SESSION['message2'])){
    echo '<div class="alert alert-success">Audio Subido con Exito!!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div>' ;
    unset($_SESSION['message']);
    unset($_SESSION['message2']);
}

if(isset($_GET['datos'])){
  $data = json_decode(stripslashes($_GET['datos']));  
  echo $data->autoresids;
  $url ='uploaded_files/' . $data->md5 . $data->ext;
  $titulo = $data->titulo;
  $autores  = $data->autoresids;
  $categorias = $data->categoriasids;
  $generos = $data->generosids;
  return AudioRepo::CrearAudio($url, $titulo , $_SESSION['id_usuario'] , $autores , $categorias , $generos);
  die();
}


if (isset($_SESSION['id_usuario'])){
  $autor_resultado = AutorRepo::ObtenerTodosAutores();
  $categoria_resultado = CategoriaRepo::ObtenerTodasCategorias();
  $genero_resultado = GeneroRepo::ObtenerTodosGeneros();

//   echo "<div class='contenido'>";
  echo "<div class='container pt-3'>";
?>


<div class="row">

    <div class="card px-0 col-6">
        <div class="card-header">
            <h3>Subir Nuevo Audio</h3>
        </div>
        <div class="card-body">

            <div class="">
                <div>
                    <div class="form-group">
                        <label for="titulo">Titulo:</label>
                        <input id="titulo" class="form-control" type="text" name="titulo">
                    </div>
                    <div class="d-flex flex-row justify-content-around mb-5">
                        <div>
                            <a class="btn btn-success" data-toggle="modal" data-target="#ventanaAutor">
                                Ingresar autor
                            </a>
                        </div>
                        <div>
                            <a class="btn btn-success" data-toggle="modal" data-target="#ventanaCategoria">
                                Ingresar categoria
                            </a>
                        </div>
                        <div>
                            <a class="btn btn-success" data-toggle="modal" data-target="#ventanaGenero">
                                Ingresar genero
                            </a>
                        </div>
                    </div>
                </div>


                <form method="POST" action="upload.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="subir">Subir archivo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cargar</span>
                            </div>
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" name="uploadedFile" onchange="return validarExt()"/>
                                <label class="custom-file-label" for="uploadedFile">Elegir Audio</label>
                            </div>
                        </div>

                        <input style="visibility:hidden;" type="text" name="md5" id="md5"
                            value="<?= md5(time() . time())?>">
                    </div>
                    
                    
                        <input onclick="enviarDatos()" class="btn btn-primary btn-lg mb-3 mr-2" type="submit" name="uploadBtn" value="Upload" />
                        <div class=" justify-content-center d-none" id="cargando">
                        <div class="spinner-border" role="status" >
                            <span class="sr-only">Loading...</span>
                        </div>
                        </div>
                    
                </form>
            </div>
        </div>
    </div>

  



    <div class="card px-0 col-6">
        <div class="card-header">
            <h3>Info</h3>
        </div>
        <div class="card-body">
            <div class="" id="UpPreview">
                <div class="autores overflow-auto">
                    <table id="tablaAutores" class="">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Autores</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
                <div class="categorias overflow-auto">
                    <table id="tablaCategorias" class="">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Categorias</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="generos overflow-auto">
                    <table id="tablaGeneros" class="">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Genero</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Modal autor-->
<div class="modal" id="ventanaAutor" tabindex="-1" role="dialog" aria-labelledby="tituloAutorVentana"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="tituloAutorVentana">Ingresar un autor</h5>
                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control" name="autor">
                    <option value="0"> </option>
                    <?php
               for ($i=0; $i < count($autor_resultado); $i++) { 
                 $id = $autor_resultado[$i]->id;
                 $nombre = $autor_resultado[$i]->nombre;
                 ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                    <?php
               }
            ?>
                </select>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button onclick="newACG('autor')" class="btn btn-info" data-dismiss="modal" type="button">
                    Crear
                </button>
                <div>
                <button onclick="agregarAutor(event)" class="btn btn-success" data-dismiss="modal" type="button">
                    Aceptar
                </button>
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    Cerrar
                </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal Categoria-->
<div class="modal" id="ventanaCategoria" tabindex="-1" role="dialog" aria-labelledby="tituloCategoriaVentana"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="tituloAutorVentana">Ingresar un categoria</h5>
                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control" name="categoria">

                    <?php
               for ($i=0; $i < count($categoria_resultado); $i++) { 
                 $id = $categoria_resultado[$i]->id;
                 $nombre = $categoria_resultado[$i]->nombre;
                 ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                    <?php
               }
            ?>
                </select>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button onclick="newACG('categoria')" class="btn btn-info" data-dismiss="modal" type="button">
                    Crear
                </button>
                <div>
                <button onclick="agregarCategoria(event)" data-dismiss="modal" class="btn btn-success" type="button">
                    Aceptar
                </button>
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    Cerrar
                </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal Genero-->
<div class="modal" id="ventanaGenero" tabindex="-1" role="dialog" aria-labelledby="tituloGeneroVentana"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="tituloAutorVentana">Ingresar un genero</h5>
                <button class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control" name="genero">
                    <option value="0"> </option>
                    <?php
               for ($i=0; $i < count($genero_resultado); $i++) { 
                 $id = $genero_resultado[$i]->id;
                 $nombre = $genero_resultado[$i]->nombre;
                 ?>
                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                    <?php
               }
            ?>
                </select>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button onclick="newACG('genero')" class="btn btn-info" data-dismiss="modal" type="button">
                    Crear
                </button>
                <div>
                <button class="btn btn-success" onclick="agregarGenero(event)" data-dismiss="modal" type="button">
                    Aceptar
                </button>
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    Cerrar
                </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--modal crear-->
<div id="modalCrear"class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="mtCrear" class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div  class="modal-body">
        <p id="mbCrear">Modal body text goes here.</p>
        <input class='form-control' id="inputCrear"type="text">
      </div>
      <div class="modal-footer">
        <button onclick="send()" type="button" class="btn btn-primary">Crear</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php
echo "</div>";
}?>
<?php

$scripts = '<script src="/public/js/upload.js"></script>';
require 'Components/footer.php';
?>