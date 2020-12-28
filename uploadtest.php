<?php
$title = "Audios";
require 'Components/header.php';
use MongoDB\Client as Mongo;
use Utils\DBConnection\DBConnection as Con;
$client = new Mongo(Con::getConnectionString());

if (isset($_SESSION['id_usuario'])){
  $autor_collection =$client->grupo03->Autor;
  $autor_consulta=$autor_collection->find([]);
  $autor_resultado=($autor_consulta)->toArray();//autores

  $categoria_collection =$client->grupo03->Categoria;
  $categoria_consulta=$categoria_collection->find([]);
  $categoria_resultado=($categoria_consulta)->toArray();//categorias

  $genero_collection =$client->grupo03->Genero;
  $genero_consulta=$genero_collection->find([]);
  $genero_resultado=($genero_consulta)->toArray();//generos

  echo "<div class='contenido'>";
  echo "<div class='container'>";
?>
  <form method="get" action="upload.php" enctype="multipart/form-data">
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
             $id = $autor_resultado[$i]['_id'];
             $nombre = $autor_resultado[$i]['nombre'];
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
             $id = $categoria_resultado[$i]['_id'];
             $nombre = $categoria_resultado[$i]['nombre'];
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
             $id = $genero_resultado[$i]['_id'];
             $nombre = $genero_resultado[$i]['nombre'];
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
    <input class="btn btn-default" type="submit" name="uploadBtn" value="Upload" />
  </form>

<?php
echo "</div></div>";
}
?>
