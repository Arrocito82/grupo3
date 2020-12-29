<?php
    $title="Buscar";
    require "Components/header.php";
    use Repositories\AudioRepo;
    use Repositories\AutorRepo;
    use Components\SearchTable;


    if(isset($_POST['f'])){
        echo $_POST['f'];
                
        $filtro =['titulo' =>  new \MongoDB\BSON\Regex(preg_quote($_POST['f']), 'i')];
        $options = ['limit' =>5];
        
        $canciones = AudioRepo::ObtenerAudiosFiltro($filtro ,$options);
        $autores = AutorRepo::ObtenerAutoresPorNombre($_POST['f'] , $options);

        $htmlResult = SearchTable::renderHTMLSearchTable($canciones , $autores);
        
        echo $htmlResult->audios;
        echo $htmlResult->autores;
    }
    else{
        echo '<form class="form-inline my-2 my-lg-0" Action="buscar.php" method="post">
                    <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="f" size="40">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>';
        echo "<script>
                document.getElementById('navSearch').style.display = 'none';
            </script>";
    }
?>

