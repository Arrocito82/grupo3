<?php
    $title="Buscar";
    require "Components/header.php";
    use Repositories\AudioRepo;
    use Repositories\AutorRepo;
    use Components\SearchTable;


    if(isset($_POST['f'])){
                        
        $filtro =['titulo' =>  new \MongoDB\BSON\Regex(preg_quote($_POST['f']), 'i')];
        $options = ['limit' =>5];
        
        $canciones = AudioRepo::ObtenerAudiosFiltro($filtro ,$options);
        //var_dump($canciones[0]);
        $autores = AutorRepo::ObtenerAutoresPorNombre($_POST['f'] , $options);
        //var_dump($autores);
        $htmlResult = SearchTable::renderHTMLSearchResultTable($canciones , $autores);
        
        echo $htmlResult->audios;
        echo $htmlResult->autores;
    }
    else{
        echo '<div class="align-content-center"><form class="form-inline my-2 my-lg-0" Action="Buscar.php" method="post">
                    <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="f" size="40">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form></div>';
        echo "<script>
                document.getElementById('navSearch').style.display = 'none';
            </script>";
    }
?>

