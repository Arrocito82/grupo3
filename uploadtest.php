<?php
$title = "Audios";
require 'Components/header.php';
use Repositories\AutorRepo;
use Repositories\CategoriaRepo;
use Repositories\GeneroRepo;

if (isset($_SESSION['id_usuario'])){
  $autor_resultado = AutorRepo::ObtenerTodosAutores();
  $categoria_resultado = CategoriaRepo::ObtenerTodasCategorias();
  $genero_resultado = GeneroRepo::ObtenerTodosGeneros();

  echo "<div class='contenido'>";
  echo "<div class='container'>";
?>
  <form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
      <label for="titulo">Titulo:</label>
      <input class="form-control" type="text" name="titulo">
    </div>
    <div class="form-group">
      <a class="btn btn-success" data-toggle="modal" data-target="#ventanaAutor">
        Ingresar autor
      </a>
    </div>
    <div class="form-group">
      <a class="btn btn-success" data-toggle="modal" data-target="#ventanaCategoria">
        Ingresar categoria
      </a>
    </div>
    <div class="form-group">
      <a class="btn btn-success" data-toggle="modal" data-target="#ventanaGenero">
        Ingresar genero
      </a>
    </div>
    <div class="form-group">
      <label for="subir">Subir archivo:</label>
      <input class="form-control" type="file" name="uploadedFile" />
    </div>
    <input type="submit" name="uploadBtn" value="Upload" />
  </form>

  <!--Modal autor-->
  <div class="modal" id="ventanaAutor" tabindex="-1" role="dialog" aria-labelledby="tituloAutorVentana" aria-hidden="true">
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
        <div class="modal-footer">
          <button class="btn btn-warning" type="button" data-dismiss="modal">
            Cerrar
          </button>
          <button class="btn btn-success" type="button">
            Aceptar
          </button>
        </div>
      </div>
    </div>
  </div>

  <!--Modal Categoria-->
  <div class="modal" id="ventanaCategoria" tabindex="-1" role="dialog" aria-labelledby="tituloCategoriaVentana" aria-hidden="true">
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
            <option value="0"> </option>
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
        <div class="modal-footer">
          <button class="btn btn-warning" type="button" data-dismiss="modal">
            Cerrar
          </button>
          <button class="btn btn-success" type="button">
            Aceptar
          </button>
        </div>
      </div>
    </div>
  </div>

  <!--Modal Genero-->
  <div class="modal" id="ventanaGenero" tabindex="-1" role="dialog" aria-labelledby="tituloGeneroVentana" aria-hidden="true">
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
        <div class="modal-footer">
          <button class="btn btn-warning" type="button" data-dismiss="modal">
            Cerrar
          </button>
          <button class="btn btn-success" type="button">
            Aceptar
          </button>
        </div>
      </div>
    </div>
  </div>

<?php
echo "</div></div>";
}
require 'Components/footer.php';
?>