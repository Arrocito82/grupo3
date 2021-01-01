<?php
 namespace Components;
 use Utils\ArrayUtils\ArrayUtils;

 class SearchTable{

    public static function renderHTMLSearchResultTable(array $Audios , array $Autores){
        $result = self::renderAudios($Audios);
        $autoresResult = self::renderAutores($Autores);

        return (object)['audios' => $result , 'autores' => $autoresResult];
    }
    private static function renderAudios(array $Audios){
        $result = '<div class="row" id="audios">

                        <div class="container-fluid mt-4">
                            <div class="bg-secondary text-white col-sm-12 px-3 py-3 rounded-lg">
                                <h2>Canciones </h2>
                            </div>
                        </div>';

        foreach ($Audios as $audio) {
        $autores = ArrayUtils::ObjectLinearString($audio->Autores, "nombre");
        $generos = ArrayUtils::ObjectLinearString($audio->Generos, "nombre");
        $categorias = ArrayUtils::ObjectLinearString($audio->Categorias , "nombre");
        
        $result= $result ."<div class='col-sm-6 col-md-4 col-lg-3 my-4'>
                                <div class='card'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>{$audio->titulo}</h5>
                                        <p class='card-text'> Autor:  {$autores}.<br>Generos: {$generos} .<br>Categoria: {$categorias}<br>{$audio->usuario->nombre}<br></p>
                                        <a href='#' class='btn btn-primary btn-block'>Reproducir</a>
                                    </div>
                                </div>
                            </div>";
        }
        $result .="</div>";
        return $result;
    }

    private static function renderAutores(array $Autores){
        $result = '<div class="row" id="autores">
                        <div class="container-fluid mt-4">
                            <div class="bg-secondary text-white col-sm-12 px-3 py-3 rounded-lg">
                                <h2>Autores</h2>
                             </div>
                        </div>';

        foreach ($Autores as $autor) {
                
        $result= $result ."<div class='col-sm-6 col-md-4 col-lg-3 my-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$autor->nombre}</h5>
                                    <p class='card-text'>
                                        <a href='' class='btn btn-primary btn-block'>Ver mas</a>
                                    </p> 
                                </div>
                            </div>
                        </div>";
                   
        }
        $result .=  "</div>";
        return $result;
    }

   
 }