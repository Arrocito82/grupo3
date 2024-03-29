<?php
    $title="Buscar";
    require "Components/header.php";
    use Repositories\AudioRepo;
    use Repositories\AutorRepo;
    use Components\SearchTable;
    use Components\Alert;

    if(!(isset($_SESSION['userName']))){

        header("Location: index.php");
    }
    echo '<div class="container" style="min-height:calc(100vh - 16rem);">';
    if(isset($_GET['buscar'])){
                        
        
        $filtro= [ 'autores.nombre'=>['$in' => [$_GET['buscar']]]];
        $options = ['limit' =>5];
        
        $canciones = AudioRepo::ObtenerAudiosFiltro($filtro ,$options);
        
        
        $htmlResult = SearchTable::renderHTMLSearchResultTable($canciones,[],$id_usuario);
        if(count($canciones)>0){
            echo $htmlResult->audios;
        }
        
        if(count($canciones)==0){
            echo Alert::SimpleAlert('No se encontraron resultados.','alert alert-danger ');
        }
    }else if(isset($_POST['f'])){
                        
        $filtro =['titulo' =>  new \MongoDB\BSON\Regex(preg_quote($_POST['f']), 'i')];
        $options = ['limit' =>5];
        
        $canciones = AudioRepo::ObtenerAudiosFiltro($filtro ,$options);
        //var_dump($canciones[0]);
        $autores = AutorRepo::ObtenerAutoresPorNombre($_POST['f'] , $options);
        //var_dump($autores);
        $htmlResult = SearchTable::renderHTMLSearchResultTable($canciones, $autores,$id_usuario);
        if(count($canciones)>0){
            echo $htmlResult->audios;
        }
        if(count($autores)>0){
            echo $htmlResult->autores;
        }
        if(count($canciones)==0 & count($autores)==0){
            echo Alert::SimpleAlert('No se encontraron resultados.','alert alert-danger ');
        }
    }
    else{
        echo '<div class="align-content-center px-5"><form class="form-inline my-2 my-lg-0" Action="Buscar.php" method="post">
                    <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="f" size="40">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form></div>
               ';
        echo "<script>
                document.getElementById('navSearch').style.display = 'none';
            </script>";
    }
    echo ' <div class="container fixed-bottom" id="agregar_mensaje_div"></div></div>';
?>

    <script>
        function agregar_lista(id_lista, id_audio) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (+this.responseText > 0) {
                        document.getElementById('agregar_mensaje_div').insertAdjacentHTML('beforeend', `
                    <div class="alert alert-success" role="alert" style="text-align:center;" id="agregar_mensaje">
                        Audio agregado exitosamente!!.
                    
                </div>`);

                        setTimeout(() => {
                            $('.alert').alert('close');
                        }, 2000);
                    }

                }
            };
            xhttp.open("POST", "crud_lista.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(JSON.stringify({
                "crud": "add",
                "lista_id": id_lista,
                "audio_id": id_audio
            }));
        }

        function reproducir(id, event) {

            let element = event.path[0];
            if (element.parentElement.children[2].classList.contains("alert")) {
                return 0;
            }

            let xhttp = new XMLHttpRequest();
            consulta = JSON.stringify({
                'crud': 'recuperar',
                'audio_id': id
            });
            xhttp.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    result = JSON.parse(this.responseText);


                    element.insertAdjacentHTML('afterend', `<div class="alert alert-light fade show flex flex-column d-flex justify-content-between mx-0 px-0 py-0 mt-2" role="alert" 
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
    <?php require 'Components/footer.php'?>