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
  <form method="get" action="" enctype="multipart/form-data">
    <div class="form-group">
      <label for="titulo">Titulo:</label>
      <input class="form-control" type="text" name="titulo">
    </div>
    <div class="form-group">
      <label for="autor">Autor:</label>
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
    <div class="form-group">
      <label for="categoria">Categoria:</label>
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
    <div class="form-group">
      <label for="genero">Genero:</label>
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
    <div class="form-group">
      <label for="subir">Subir archivo:</label>
      <input class="form-control" type="file" name="uploadedFile" />
    </div>
    <input type="submit" name="uploadBtn" value="Upload" />
  </form>

<?php
echo "</div></div>";
}
?>